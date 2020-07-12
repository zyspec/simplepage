<?php
/**
 * Class Template and TemplateHandler
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		monkeyking
 * @subpackage 	simplepage
 */

defined('FRAMEWORKS_ART_FUNCTIONS_INI') || require(XOOPS_ROOT_PATH.'/Frameworks/art/functions.ini.php');
load_object();

Class SimplepageTemplate extends ArtObject {

	/**
	 * construtor
	 */
	function SimplepageTemplate() {
		$this->artObject();
		$this->initVar('template_id', XOBJ_DTYPE_INT, NULL, false);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, NULL, true);
		$this->initVar('content', XOBJ_DTYPE_TXTAREA, NULL, true);
		$this->initVar('updated', XOBJ_DTYPE_INT, NULL, true);
		$this->initVar('author_id', XOBJ_DTYPE_INT, NULL, true);
	}

	function render() {
	}
}

Class SimplepageTemplateHandler extends ArtObjectHandler {

	/**
	 * constructor
	 *
	 * @param object $db
	 * @return SimplepageTemplateHandler
	 */
	function SimplepageTemplateHandler(&$db) {
		$this->ArtObjectHandler($db, 'simplepage_template', 'SimplepageTemplate', 'template_id', 'title');
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