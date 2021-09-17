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

use \Xmf\Database\Tables;
use \XoopsModules\Simplepage\{
    Common,
};

/**
 * Class Migrate synchronize existing tables with target schema
 *
 * @package  \XoopsModules\Simplepage\Common
 *
 * @copyright  &copy; 2016 {@link https://xoops.org XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  Richard Griffith <richard@geekwright.com>
 * @link  https://github.com/XoopsModules25x/simplepage  Simplepage Repository
 */
class Migrate extends \Xmf\Database\Migrate
{
    private $renameTables;
    private $renameColumns;
    private $moduleDirName;

    /**
     * Migrate constructor
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function __construct(?Configurator $configurator = null)
    {
        if (null !== $configurator) {
            $this->renameTables  = $configurator->renameTables;
            $this->renameColumns = $configurator->renameColumns;
            $this->moduleDirName = basename(dirname(__DIR__, 2));
            parent::__construct($this->moduleDirName);
        }
    }

    /**
     * change table prefix if needed
     *
     * @deprecated
     * @return bool
     */
    private function changePrefix(): bool
    {
        return $this->renameTable();
    }

    /**
     * Renames modules dB tables on a module update.
     *
     * The list of dB tables to be renamed are imported
     * using the module {@see Configurator}. This method renames the
     * tables based on the values in the 'renameTables' array.
     *
     * @return bool
     */
    private function renameTable(): bool
    {
        $success = true;
        foreach ($this->renameTables as $oldName => $newName) {
            if ($this->tableHandler->useTable($oldName) && !$this->tableHandler->useTable($newName)) {
                $success = $success && $this->tableHandler->renameTable($oldName, $newName);
            }
        }
        return $success;
    }

    /**
     * Rename dB column in table if needed.
     *
     * @return bool success if table column is changed (or did not exist), false if failed to rename
     */
    private function renameColumn(): bool
    {
        $success = true;
        /**
         * @var  string  $table name of the table containing the column to rename
         * @var  string[]  $columns in the form ['from' => 'OldColumnName', 'to' => 'NewColumnName>']
         */
        foreach ($this->renameColumns as $table => $columns) {
            if ($this->tableHandler->useTable($table)) { // table exists, otherwise ignore column rename
                $attributes = $this->tableHandler->getColumnAttributes($table, $columns['from']);
                if (false !== $attributes) { // means column exists, so try and rename it
                    $success = $success && $this->tableHandler->alterColumn($table, $columns['from'], $attributes, $columns['to']);
                }
            }
        }
        return $success;
    }

    /**
     * Perform any upfront actions before synchronizing the schema
     *
     * __Some typical uses include:__
     *  - table and column renames
     *  - data conversions
     *
     * @return bool
     */
    protected function preSyncActions(): bool
    {
        // change rename any tables necessary
        /**
         * @var string $table
         * @var string[] $columns
         */
        $tblSuccess = $this->renameTable();

        // rename columns AFTER renaming tables
        $colSuccess = $this->renameColumn();

        return $tblSuccess && $colSuccess;
    }
}
