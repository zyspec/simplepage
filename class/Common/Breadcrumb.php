<?php

namespace XoopsModules\Simplepage\Common;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
/**
 * Breadcrumb Class
 *
 * @package  XoopsModules\Simplepage\Common
 * @copyright  {@link https://github.com/Xoops The XOOPS Project}
 * @license  {@link https://www.fsf.org/copyleft/gpl.html GNU public license}
 * @author  lucio <lucio.rota@gmail.com>
 * @author  XOOPS Module Dev Team {@link https://xoops.org XOOPS}
 * @since  0.4.0
 *
 * Example:
 * $breadcrumb = new Simplepage\Breadcrumb();
 * $breadcrumb->addLink( 'bread 1', 'index1.php' );
 * $breadcrumb->addLink( 'bread 2', '' );
 * $breadcrumb->addLink( 'bread 3', 'index3.php' );
 * echo $breadcrumb->render();
 */
defined('XOOPS_ROOT_PATH') || die('XOOPS Root Path not defined');

/**
 * Class Breadcrumb
 */
class Breadcrumb
{
    public $dirname;
    private $bread = [];

    public function __construct()
    {
        $this->dirname = basename(dirname(__DIR__, 2));
    }

    /**
     * Add link to breadcrumb
     *
     * @param null|string $title
     * @param null|string $link
     *
     * @return void
     */
    public function addLink(?string $title = '', ?string $link = ''): void
    {
        if ('' !== $title || '' !== $link) {
            $this->bread[] = [
                'link' => $link,
                'title' => $title,
            ];
        }
    }

    /**
     * Render Simplepage BreadCrumb
     *
     * @return false|mixed|string HTML rendered text
     */
    public function render()
    {
        if (!isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])) {
            require_once $GLOBALS['xoops']->path('class/theme.php');
            $GLOBALS['xoTheme'] = new \xos_opal_Theme();
        }

        require_once $GLOBALS['xoops']->path('class/template.php');
        $breadcrumbTpl = new \XoopsTpl();
        $breadcrumbTpl->assign('breadcrumb', $this->bread);
        $html = $breadcrumbTpl->fetch('db:' . $this->dirname . '_common_breadcrumb.tpl');
        unset($breadcrumbTpl);

        return $html;
    }
}
