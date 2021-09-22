<?php
/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @package  XoopsModules\Simplepage
 * @subpackage  admin
 * @copyright  &copy; 2000-2021 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  XOOPS Module Dev Team (https://xoops.org)
 * @link  https://github.com/XoopsModules25x/simplepage  Simplepage Repository
 */

use Xmf\Module\Admin;

require_once dirname(__DIR__) . '/include/common.php';

/**
 * Vars defined via the include/common.php above
 *
 * @var  string  $moduleDirName
 * @var  string  $moduleDirNameUpper
 * @var  string  $pathIcon32
 */

echo "<div class='adminfooter'>\n"
    . "  <div class='center'>\n"
    . sprintf("<a href='%s' rel='external'><img src='%s' alt='%s' title='%s'></a>",
        constant('CO_' . $moduleDirNameUpper . '_AUTHORLINK'),
        $pathIcon32 . '/' . constant('CO_' . $moduleDirNameUpper . '_AUTHORIMAGENAME'),
        constant('CO_' . $moduleDirNameUpper . '_AUTHORIMAGEALT'),
        constant('CO_' . $moduleDirNameUpper . '_AUTHORIMAGETITLE')
    )
    . "</div>\n"
    . "<div class='center smallsmall italic pad5'>"
    . constant('CO_' . $moduleDirNameUpper . '_MAINTENANCETEXT') . "\n"
    . sprintf(" <a class='tooltip' rel='external' href='%s' title='%s'>%s</a>",
        constant('CO_' . $moduleDirNameUpper . '_MAINTENANCELINK'),
        constant('CO_' . $moduleDirNameUpper . '_MAINTENANCETITLE')) . "\n"
    . constant('CO_' . $moduleDirNameUpper . '_MAINTENANCELINKTEXT')
    . "  </div>\n"
    . "</div>\n";

xoops_cp_footer();