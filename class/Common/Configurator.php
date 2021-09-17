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
 * Configurator Class
 *
 * @package  XoopsModules\Simplepage\Common
 * @copyright  {@link https://github.com/Xoops The XOOPS Project}
 * @license   {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @author  XOOPS Module Dev Team (https://xoops.org)
 * @since  1.05
 */

/**
 * Class Configurator
 *
 * @package  XoopsModules\Simplepage\Common
 */
class Configurator
{
    public $name;
    public $paths = [];
    public $uploadFolders = [];
    public $copyBlankFiles = [];
    public $copyTestFolders = [];
    public $templateFolders = [];
    public $oldFiles = [];
    public $oldFolders = [];
    public $renameTables = [];
    public $renameColumns = [];
    public $moduleStats = [];
    public $modCopyright;

    /**
     * Configurator constructor.
     */
    public function __construct()
    {
        $config = include dirname(__DIR__, 2) . '/config/config.php';

        $this->name            = $config->name;
        $this->paths           = $config->paths;
        $this->uploadFolders   = $config->uploadFolders;
        $this->copyBlankFiles  = $config->copyBlankFiles;
        $this->copyTestFolders = $config->copyTestFolders;
        $this->templateFolders = $config->templateFolders;
        $this->oldFiles        = $config->oldFiles;
        $this->oldFolders      = $config->oldFolders;
        $this->renameTables    = $config->renameTables;
        $this->renameColumns   = $config->renameColumns;
        $this->moduleStats     = $config->moduleStats;
        $this->modCopyright    = $config->modCopyright;
    }
}