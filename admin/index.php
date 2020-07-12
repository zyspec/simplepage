<?php
/**
 * 管理首页
 *
 * @copyright	xoops.com.cn
 * @author		bitshine <bitshine@gmail.com>
 * @since		1.00
 * @version		$Id$
 * @package		simplepage
 */


require_once('../../../include/cp_header.php');
include_once(XOOPS_ROOT_PATH."/Frameworks/art/functions.admin.php");
require_once('../include/functions.php');
require_once('../include/vars.php');
xoops_cp_header();
loadModuleAdminMenu(0);
//include('../include/admin_header_tpl.php');
echo <<<EOT
<!--header-->
<div>
<!--<img src="../images/simplepage_slogo.jpg" style="float: left;" />-->
<div style="clear: both;"></div>
</div>
<br />
EOT;

echo _AD_SIMPLEPAGE_NOTE;

xoops_cp_footer();

?>