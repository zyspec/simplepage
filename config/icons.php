<?php

/**
 * Object with array of HTML image elements
 * 
 * @return object
 */

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$moduleDirName = basename(dirname(__DIR__));

return (object)[
    'name'    => mb_strtoupper($moduleDirName) . ' IconConfigurator',
    'icons'   => [
        '0'       => "<img src='" . $pathIcon16 . "/0.png' alt='"        . 0        . "' style='vertical-align:middle'>",
        '1'       => "<img src='" . $pathIcon16 . "/1.png' alt='"        . 1        . "' style='vertical-align:middle'>",
        'add'     => "<img src='" . $pathIcon16 . "/add.png' alt='"      . _ADD     . "' style='vertical-align:middle'>",
        'clone'   => "<img src='" . $pathIcon16 . "/editcopy.png' alt='" . _CLONE   . "' style='vertical-align:middle'>",
        'delete'  => "<img src='" . $pathIcon16 . "/delete.png' alt='"   . _DELETE  . "' style='vertical-align:middle'>",
        'edit'    => "<img src='" . $pathIcon16 . "/edit.png'  alt="     . _EDIT    . "' style='vertical-align:middle'>",
        'pdf'     => "<img src='" . $pathIcon16 . "/pdf.png' alt='"      . _CLONE   . "' style='vertical-align:middle'>",
        'preview' => "<img src='" . $pathIcon16 . "/view.png' alt='"     . _PREVIEW . "' style='vertical-align:middle'>",
        'print'   => "<img src='" . $pathIcon16 . "/printer.png' alt='"  . _CLONE   . "' style='vertical-align:middle'>",
    ],
];
