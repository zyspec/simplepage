<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * @package  XoopsModules\Simplepage
 *
 * @copyright  {@link https://github.com/Xoops The XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2}
 * @author  XOOPS Module Dev Team (https://xoops.org) (https://www.xoops.ir)
 * @since  0.4.0
 */
defined('XOOPS_ROOT_PATH') || die('Restricted access');

/**
 * Class SimplepageCorePreload
 */
class SimplepageCorePreload extends \XoopsPreloadItem
{
    // to add PSR-4 autoloader

    /**
     * @param $args
     */
    public static function eventCoreIncludeCommonEnd($args)
    {
        include __DIR__ . '/autoloader.php';
    }
}
