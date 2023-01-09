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

if (!defined('DC_CONTEXT_ADMIN')) { exit; }

dcCore::app()->addBehavior('pluginsToolsTabs',array('stackerBehaviors','displayPluginsPanel'));
