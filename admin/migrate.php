<?php
/* ------------------------------------------------------------------------
                XOOPS - PHP Content Management System
                  Copyright (c) 2000-2016 XOOPS.org
                       <https://xoops.org/>
  ------------------------------------------------------------------------
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  You may not change or alter any portion of this comment or credits
  of supporting developers from this source code or any supporting
  source code which is considered copyrighted (c) material of the
  original comment or credit authors.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA
  ------------------------------------------------------------------------*/
/**
 * XOOPS Project Migration Script
 *
 * @package \XoopsModules\Simplepage
 * @author  Kazumi Ono (aka onokazu)
 * @link http://www.myweb.ne.jp
 * @link https://xoops.org
 * @link http://jp.xoops.org
 */

use Xmf\Request;
use XoopsModules\Simplepage\{
    Common\Configurator,
    Common\Migrate,
    Constants,
    Helper
};

/**
 * @var  \Xmf\Module\Admin  $adminObject  defined in ./admin/admin_header.php
 * @var  string  $moduleDirNameUpper
 * @var  Helper  $helper
 */
require_once __DIR__ . '/admin_header.php';

// only allow admins to perform migration
if (!$helper->isUserAdmin()) {
    redirect_header(XOOPS_URL . '/index.php', Constants::REDIRECT_DELAY_MEDIUM, _NOPERM);
}

xoops_cp_header();

$adminObject->displayNavigation(basename(__FILE__));
$showSql    = constant('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SHOW_SQL');
$showDoMig  = constant('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_DO_MIGRATION');
$showSchema = constant('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_WRITE_SCHEMA');
echo <<<EOF
<form method="post" class="form-inline">
<div class="form-group inline">
<input name="show" class="btn btn-default" type="submit" value="{$showSql}">
</div>
<div class="form-group inline">
<input name="migrate" class="btn btn-default" type="submit" value="{$showDoMig}">
</div>
<div class="form-group inline">
<input name="schema" class="btn btn-default" type="submit" value="{$showSchema}">
</div>
</form>
EOF;

$configurator = new Configurator();
$migrator     = new Migrate($configurator);

$op        = Request::getCmd('op', 'show');
$opShow    = Request::getCmd('show', null, 'POST');
$opMigrate = Request::getCmd('migrate', null, 'POST');
$opSchema  = Request::getCmd('schema', null, 'POST');

$op = Request::hasVar('show', 'POST') ? 'show' : $op;
$op = Request::hasVar('migrate', 'POST') ? 'migrate' : $op;
$op = Request::hasVar('schema', 'POST') ? 'schema' : $op;

$message = '';

switch ($op) {
    default:
    case 'show':
        $queue = $migrator->getSynchronizeDDL();
        if (!empty($queue)) {
            echo "<pre>\n";
            foreach ($queue as $line) {
                echo $line . ";\n";
            }
            echo "</pre>\n";
        }
        break;
    case 'migrate':
        $migrator->synchronizeSchema();
        $message = constant('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SCHEMA_UPDATED');
        break;
    case 'schema':
        $msg     = constant('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_WARNING');
        $confirm = constant('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_CONFIRM');
        xoops_confirm(['op' => 'confirmwrite'], 'migrate.php', $msg, $confirm);
        break;
    case 'confirmwrite':
        if ($GLOBALS['xoopsSecurity']->check()) {
            $migrator->saveCurrentSchema();
            $message = constant('CO_' . $moduleDirNameUpper . '_' . 'MIGRATE_SCHEMA_WRITTEN');
        }
        break;
}

echo "<div>$message</div>";

require_once __DIR__ . '/admin_footer.php';
