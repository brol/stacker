<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of stacker, a plugin for Dotclear 2.
# 
# Copyright (c) 2010 Jean-Claude Dubacq, Franck Paul and contributors
# carnet.franck.paul@gmail.com
# 
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------
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
