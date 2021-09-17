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
 * Statistics plugin for XOOPS modules
 *
 * @package  XoopsModules\Simplepage\Common
 * @copyright  {@link https://github.com/Xoops The XOOPS Project}
 * @license  {@link https://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU GPL 2 or later}
 * @author  Michael Beck <mambax7@gmail.com>
 */

trait ModuleStats
{
    /**
     *
     * @param \XoopsModules\Simplepage\Common\Configurator $configurator
     * @param array $moduleStats
     *
     * @return array
     */
    public static function getModuleStats(Configurator $configurator, array $moduleStats): array
    {
        if (0 < count($configurator->moduleStats)) {
            foreach (array_keys($configurator->moduleStats) as $i) {
                $moduleStats[$i] = $configurator->moduleStats[$i];
            }
        }

        return $moduleStats;
    }
}
