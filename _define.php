<?php
/**
 * @brief stacker, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugin
 *
 * @author Jean-Claude Dubacq, Franck Paul and contributors
 *
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */
if (!defined('DC_RC_PATH')) {
    return;
}

$this->registerModule(
    'Stacker',
    'Manages a bunch of transforming functions that can modify the entries text before display',
    'Jean-Christophe Dubacq, Franck Paul and contributors',
    '0.6',
    [
        'requires'    => [['core', '2.24']],
        'permissions' => dcCore::app()->auth->makePermissions([
            dcAuth::PERMISSION_USAGE,
            dcAuth::PERMISSION_CONTENT_ADMIN,
        ]),
        'type'     => 'plugin',
        'priority' => 10001,
        'support'    => 'https://forum.dotclear.org/viewforum.php?id=16',
        'details'    => 'https://plugins.dotaddict.org/dc2/details/' . basename(__DIR__),
    ]
);
