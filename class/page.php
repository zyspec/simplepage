<?php
/**
 * Class Page and PageHandler
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 * @subpackage
 */

defined('FRAMEWORKS_ART_FUNCTIONS_INI') || require(XOOPS_ROOT_PATH.'/Frameworks/art/functions.ini.php');
load_object();

Class SimplepagePage extends ArtObject {

	/**
	 * construtor
	 */
	function SimplepagePage() {
		$this->artObject();
		$this->initVar('pageName', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('pageId', XOBJ_DTYPE_INT, NULL, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('content', XOBJ_DTYPE_TXTAREA, NULL, true);	
		$this->initVar('templateId', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('isDisplayTitle', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('commentable', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('isPublished', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('created', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('updated', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('updaterUid', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('weight', XOBJ_DTYPE_INT, NULL, true);
	}
	
	function created() {
		if ($this->getVar('created') == 0) {
			return '-';
		} else {
			return formatTimeStamp($this->getVar('created'), 'y-m-d H:m');
		}
	}
	
	function updated() {
		if ($this->getVar('updated') == 0) {
			return '-';
		} else {
			return formatTimeStamp($this->getVar('updated'), 'y-m-d H:m');
		}
	}
	
	function updater($realname = 0) {
		global $xoopsUser;
		return $xoopsUser->getUnameFromId($this->getVar('updaterUid'), $realname);
	}

}

Class SimplepagePageHandler extends ArtObjectHandler {

	/**
	 * constructor
	 *
	 * @param object $db
	 * @return SimplepagePageHandler
	 */
	function SimplepagePageHandler(&$db) {
		$this->ArtObjectHandler($db, 'simplepage_page', 'SimplepagePage', 'pageId', 'title');
	}

	//重载getAll()方法，提供载入链接对象的功能
    function &getAll($criteria = null, $tags = null, $asObject = true, $loadLinkedClass = false, $loadClasses = array()) {
	 	$rows = parent::getAll($criteria, $tags, $asObject);
	 	if ($loadLinkedClass && !empty($loadClasses)) {
	 		foreach ($loadClasses as $loadClass) {
	 			$this->_assembleLinkedData($rows, $asObject, $loadClass);
	 		}
	 	}
		return $rows;
	}

	/**
	 * get list of SimplepageRelationship
	 * @param object	$criteria {@link CriteriaElement} to match
	 * @param array		$tags 	variables to fetch
	 * @return array	associative array of serverecord_id as key,$tags as value
	 */
	function getList($criteria = null,$tag="") {
	  	$ret=array();
        if(empty($tag) && isset($this->identifierName)){
        	$tag=$this->identifierName;
        }
        if(empty($tag)){
        	return $ret;
        }
        $obj=& $this->create(false);
        if(!in_array($tag,array_keys($obj->getVars()))){
        	return $ret;
        }

        $limit = 0;
        $start = 0;
        $sql = 'SELECT '.$this->keyName.', '.$tag;
        $sql .= ' FROM '.$this->table;
        if (isset($criteria) && is_subclass_of($criteria, 'criteriaelement')) {
            $sql .= ' '.$criteria->renderWhere();
            if ($criteria->getSort() != '') {
                $sql .= ' ORDER BY '.$criteria->getSort().' '.$criteria->getOrder();
            }
            $limit = $criteria->getLimit();
            $start = $criteria->getStart();
        }
        $result = $this->db->query($sql, $limit, $start);
        if (!$result) {
            return $ret;
        }

        while ($myrow = $this->db->fetchArray($result)) {
            $obj->assignVars($myrow);
            $ret[$myrow[$this->keyName]] = $obj->getVar($tag);
        }
        return $ret;
    }

	/**
	 * 装配链接对象的数据到相应的属性中。
	 * 需要在类的构造函数定义相应的属性。
	 * 返回引用数组。
	 *
	 * @param array $rows
	 * @param bool $asObject
	 * @param string $linkedClassName
	 * @param string $linkedPrimaryKey
	 */
	function _assembleLinkedData(&$rows, $asObject, $linkedClassName) {
	 	if ($rows) {
	 		$linkedObjectHandle =& xoops_getmodulehandler($linkedClassName);
	 		$linkedPrimaryKey = $linkedObjectHandle->keyName;
	 		foreach ($rows as $key => $row) {
	 			if ($asObject) {
	 				$linkedObject = $linkedObjectHandle->get($row->getVar($linkedPrimaryKey));
	 				$rows[$key]->setVar($linkedObject, $linkedObject);
	 			} else {
	 				$linkedObject = $linkedObjectHandle->get($row[$linkedPrimaryKey]);
	 				$rows[$key][$linkedClassName] = $linkedObject->getValues();
	 			}
	 		}
	 	}
	}

}
?>