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
 *
 * @package  \XoopsModules\Simplepage\Common
 * @copyright  {@link https://github.com/Xoops The XOOPS Project}
 * @license  {@link http://www.fsf.org/copyleft/gpl.html GNU public license}
 * @author  mamba <mambax7@gmail.com>
 */

use Xmf\Module\Helper;
//use XoopsModules\Simplepage\Helper;

require dirname(__DIR__, 2) . '/preloads/autoloader.php';

/**
 * Trait to manage file manipulation
 *
 * @package  XoopsModules\Simplepage\Common
 */
trait FilesManagement
{
    /**
     * Function responsible for checking if a directory exists, we can also write in and create an index.php file.
     *
     * @param  string  $folder  The full path of the directory to check
     * @return  bool
     */
    public static function createFolder(string $folder): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }
        $status = true;
        try {
            if (!file_exists($folder)) {
                if (!is_dir($folder) && !mkdir($folder) && !is_dir($folder)) {
                    $status = false;
                    throw new \RuntimeException(sprintf('Unable to create the %s directory', $folder));
                }

                $tmpstat = file_put_contents($folder . '/index.php', "<?php\n\nheader('HTTP/1.0 404 Not Found');\n");
                $status = false !== $tmpstat ? true : false;
            }
        } catch (\Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n", '<br>';
            $status = false;
        }
        return $status;
    }

    /**
     * Copy a file to a folder.
     *
     * @param  string  $file
     * @param  string  $folder
     * @return  bool
     */
    public static function copyFile(string $file, string $folder): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }
        return copy($file, $folder);
    }

    /**
     * Recursive copy from one location to another.
     *
     * @param  string  $src
     * @param  string  $dst
     * @return  void
     */
    public static function recurseCopy(string $src, string $dst): void
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return;
        }
        $dir = opendir($src);
        //        @mkdir($dst);
        if (!mkdir($dst) && !is_dir($dst)) {
            while (false !== ($file = readdir($dir))) {
                if (('.' !== $file) && ('..' !== $file)) {
                    if (is_dir($src . '/' . $file)) {
                        self::recurseCopy($src . '/' . $file, $dst . '/' . $file);
                    } else {
                        copy($src . '/' . $file, $dst . '/' . $file);
                    }
                }
            }
        }
        closedir($dir);
    }

    /**
     * Remove files and (sub)directories from file system.
     *
     * @uses  \Xmf\Module\Helper::getHelper()
     * @uses  \Xmf\Module\Helper::isUserAdmin()
     *
     * @param  string  $src  source directory to delete
     * @return  bool  true on success
     */
    public static function deleteDirectory(string $src): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }

        $success = true;
        // remove old files
        $dirInfo = new \SplFileInfo($src);
        // validate is a directory
        if ($dirInfo->isDir()) {
            $fileList = array_diff(scandir($src, SCANDIR_SORT_NONE), ['..', '.']);
            foreach ($fileList as $k => $v) {
                $fileInfo = new \SplFileInfo("{$src}/{$v}");
                if ($fileInfo->isDir()) {
                    // recursively handle subdirectories
                    if (!($success = self::deleteDirectory($fileInfo->getRealPath()))) {
                        break;
                    }
                } else {
                    // delete the file
                    if (!($success = unlink($fileInfo->getRealPath()))) {
                        break;
                    }
                }
            }
            // now delete this (sub)directory if all the files are gone
            if ($success) {
                $success = rmdir($dirInfo->getRealPath());
            }
        } else {
            // input is not a valid directory
            $success = false;
        }

        return $success;
    }

    /**
     * Recursively remove directory(ies) from file system.
     *
     * @todo  Currently won't remove directories with hidden files, should it?
     * @param  string  $src  directory to remove (delete)
     * @return  bool  true on success
     */
    public static function rrmdir(string $src): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }

        // If source is not a directory stop processing.
        if (!is_dir($src)) {
            return false;
        }

        $success = true;

        // Open the source directory to read in files
        $iterator = new \DirectoryIterator($src);
        foreach ($iterator as $fObj) {
            if ($fObj->isFile()) {
                $filename = $fObj->getPathname();
                $fObj = null; // clear this iterator object to close the file
                if (!unlink($filename)) {
                    return false; // couldn't delete the file
                }
            } elseif (!$fObj->isDot() && $fObj->isDir()) {
                // Try recursively on directory
                self::rrmdir($fObj->getPathname());
            }
        }
        $iterator = null;   // clear iterator Obj to close file/directory
        return rmdir($src); // remove the directory & return results
    }

    /**
     * Recursively move files from one directory to another.
     *
     * @param  string  $src  Source of files being moved
     * @param  string  $dest  Destination of files being moved
     * @return  bool  true on success
     */
    public static function rmove(string $src, string $dest): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }

        // If source is not a directory stop processing
        if (!is_dir($src)) {
            return false;
        }

        // If the destination directory does not exist and could not be created stop processing
        if (!is_dir($dest) && !mkdir($dest) && !is_dir($dest)) {
            return false;
        }

        // Open the source directory to read in files
        $iterator = new \DirectoryIterator($src);
        foreach ($iterator as $fObj) {
            if ($fObj->isFile()) {
                rename($fObj->getPathname(), "{$dest}/" . $fObj->getFilename());
            } elseif (!$fObj->isDot() && $fObj->isDir()) {
                // Try recursively on directory
                static::rmove($fObj->getPathname(), "{$dest}/" . $fObj->getFilename());
                //                rmdir($fObj->getPath()); // now delete the directory
            }
        }
        $iterator = null;   // clear iterator Obj to close file/directory
        return rmdir($src); // remove the directory & return results
    }

    /**
     * Recursively copy directories and files from one directory to another.
     *
     *
     * @uses  \Xmf\Module\Helper::getHelper()
     * @uses  \Xmf\Module\Helper::isUserAdmin()
     *
     * @param  string  $src  Source of files being moved
     * @param  string  $dest  Destination of files being moved
     * @return  bool  true on success
     */
    public static function rcopy(string $src, string $dest): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }

        // If source is not a directory stop processing
        if (!is_dir($src)) {
            return false;
        }

        // If the destination directory does not exist and could not be created stop processing
        if (!is_dir($dest) && !mkdir($dest) && !is_dir($dest)) {
            return false;
        }

        // Open the source directory to read in files
        $iterator = new \DirectoryIterator($src);
        foreach ($iterator as $fObj) {
            if ($fObj->isFile()) {
                copy($fObj->getPathname(), "{$dest}/" . $fObj->getFilename());
            } elseif (!$fObj->isDot() && $fObj->isDir()) {
                self::rcopy($fObj->getPathname(), "{$dest}/" . $fObj->getFilename());
            }
        }

        return true;
    }

    /**
     * Create module's upload directories (folders).
     *
     * The list of folders (directories) to be created are imported
     * using the module {@see Configurator}. This method creates the
     * 'uploadFolders' and 'copyTestFolders'.
     *
     * @uses  XoopsModules\Simplepage\Common\Configurator
     *
     * @return  bool
     */
    public static function createUpdateFolders(): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }

        $configurator  = new Configurator();
        $status        = true;

        //  ---  CREATE FOLDERS & index.php FILES ---------------
        if (count($configurator->uploadFolders) > 0) {
            foreach (array_keys($configurator->uploadFolders) as $i) {
                $status = $status && static::createFolder($configurator->uploadFolders[$i]);
            }
        }
        //  ---  COPY blank.gif FILES ---------------
        if (count($configurator->copyBlankFiles) > 0) {
            $file = dirname(__DIR__, 2) . '/assets/images/blank.gif';
            foreach (array_keys($configurator->copyBlankFiles) as $i) {
                $dest = $configurator->copyBlankFiles[$i] . '/blank.gif';
                $status = $status && self::copyFile($file, $dest);
            }
        }

        //  ---  COPY test folder files ---------------
        if (count($configurator->copyTestFolders) > 0) {
            //$file =  dirname(__DIR__) . '/testdata/images/';
            foreach (array_keys($configurator->copyTestFolders) as $i) {
                $src = $configurator->copyTestFolders[$i][0];
                $dest = $configurator->copyTestFolders[$i][1];
                $status = $status && self::rcopy($src, $dest);
            }
        }
        return $status;
    }

    /**
     * Delete/Remove old files.
     *
     * The list of files to be removed are imported using the
     * module {@see Configurator}. This method uses the
     * 'oldFiles' parameters.
     *
     * @uses  XoopsModules\Simplepage\Common\Configurator
     *
     * @return  bool
     */
    public static function deleteOldFiles(): bool
    {
        // Only continue if user is a 'system' Admin
        if (!static::isSystemAdmin()) {
            return false;
        }

        $configurator = new Configurator();
        $success      = true;
        if (isset($configurator->oldFiles) && is_array($configurator->oldFiles)) {
            $modPath = $configurator->paths['modPath'];
            foreach ($configurator->oldFiles as $oldFile) {
                if (is_file($modPath . $oldFile)) {
                    $success = $success && unlink($modPath . $oldFile);
                }
            }
        }
        return $success;
    }

    /**
     * Determine if user is a 'system' Admin.
     *
     * @return bool
     */
    private static function isSystemAdmin(): bool
    {
        return (isset($GLOBALS['xoopsUser']) && ($GLOBALS['xoopsUser'] instanceof \XoopsUser) || $GLOBALS['xoopsUser']->isAdmin());
    }
}
