<?php

namespace XoopsModules\Simplepage;

/**
 * Class Menuitem and MenuitemHandler
 *
 * @package  \Simplepage
 * @subpackage  class
 * @copyright  xoops.com.cn
 * @author  bitshine <bitshine@gmail.com>
 */
class MenuItemHandler extends \XoopsPersistableObjectHandler
{
    /**
     * constructor
     *
     * @param \XoopsDatabase $db
     * @return \XoopsModules\Simplepage\MenuItemHandler
     */
    function __construct(&$db)
    {
        parent::__construct($db, 'simplepage_menuitem', MenuItem::class, 'menuitemId', 'title');
    }
}
