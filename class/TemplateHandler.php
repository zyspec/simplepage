<?php

namespace XoopsModules\Simplepage;

/**
 * TemplateHandler Class
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @package		\Simplepage
 * @subpackage 	class
 */
class TemplateHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     *
     * @param  \XoopsDatabase  $db
     */
    function __construct(&$db) {
        parent::__construct($db, 'simplepage_template', Template::class, 'template_id', 'title');
    }

    /**
     * Overload getAll() method, providing the function of loading the linked object
     *
     * @param  null|\CriteriaElement  $criteria
     * @param  null|array  $fields
     * @param  null|bool  $asObject
     * @param  null|bool  $loadLinkedClass
     * @param  null|array  $loadClasses
     * @return  mixed[]
     */
    public function &getAll($criteria = null, $fields = null, $asObject = true, $loadLinkedClass = false, $loadClasses = array())
    {
        $rows = parent::getAll($criteria, $fields, $asObject);
        if ($loadLinkedClass && !empty($loadClasses)) {
            foreach ($loadClasses as $loadClass) {
                $this->assembleLinkedData($rows, $asObject, $loadClass);
            }
        }

        return $rows;
    }

    /**
     * Get list of Simplepage Relationships
     *
     * @deprecated
     * @param  null|\CriteriaElement  $criteria  {@link \CriteriaElement} to match
     * @param  null|string  $field  variables to fetch
     * @return  array  associative array of serverecord_id as key,$tags as value
     */
    public function getLinkedList($criteria = null, $field = "")
    {
        $ret = array();
        if (empty($field) && isset($this->identifierName)) {
            $field=$this->identifierName;
        }
        if (empty($field)) {
            return $ret;
        }
        $obj = $this->create(false);
        if (!in_array($field, array_keys($obj->getVars()))) {
            return $ret;
        }

        $limit = 0;
        $start = 0;
        $sql = 'SELECT ' . $this->keyName . ', ' . $field;
        $sql .= ' FROM ' . $this->table;
        if (isset($criteria) && $criteria instanceof \CriteriaElement) {
            $sql .= ' '.$criteria->renderWhere();
            if ('' != $criteria->getSort()) {
                $sql .= ' ORDER BY ' . $criteria->getSort() . ' ' . $criteria->getOrder();
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
            $ret[$myrow[$this->keyName]] = $obj->getVar($field);
        }
        return $ret;
    }

    /**
     * Assemble the data of the link object to the corresponding properties.
     *
     * The corresponding attributes need to be defined in the constructor of the class.
     * Returns an array of references ($rows pass-by-reference)
     *
     * @param  array  $rows
     * @param  bool  $asObject
     * @param  string  $linkedClassName
     * @return  void
     */
    protected function assembleLinkedData(&$rows, $asObject, $linkedClassName)
    {
        if ($rows) {
            $linkedObjectHandler = xoops_getmodulehandler($linkedClassName);
            $linkedPrimaryKey = $linkedObjectHandler->keyName;
            foreach ($rows as $key => $row) {
                if ($asObject) {
                    $linkedObject = $linkedObjectHandler->get($row->getVar($linkedPrimaryKey));
                    $rows[$key]->setVar($linkedObject, $linkedObject);
                } else {
                    $linkedObject = $linkedObjectHandler->get($row[$linkedPrimaryKey]);
                    $rows[$key][$linkedClassName] = $linkedObject->getValues();
                }
            }
        }
    }
}

