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

if (!defined('DC_RC_PATH')) {return;}

dcCore::app()->addBehavior('initStacker',array('tplStacker','initStacker'));

// load main class
require_once(dirname(__FILE__).'/class.stacker.php');
dcCore::app()->stacker = new dcStacker(dcCore::app());
dcCore::app()->callBehavior('initStacker');
dcCore::app()->blog->settings->addNameSpace('stacker');
if (dcCore::app()->blog->settings->stacker->stacker_disabled) {
	$disabled = explode(',',dcCore::app()->blog->settings->stacker->stacker_disabled);
	foreach ($disabled as $entry) {
		dcCore::app()->stacker->disable($entry);
	}
}
uasort(dcCore::app()->stacker->stack,array("dcStacker", "sort"));
dcCore::app()->stacker->sorted = true;

class tplStacker
{
	static $frenchtypo=array(
                             '/ :/',
                             '/ ;/',
                             '/ !/',
                             '/ \?/',
                             '/« /',
                             '/ »/',
                             '/\'/',
	);
	static $frenchtypox=array(
                              '&nbsp;:',
                              '&thinsp;;',
                              '&thinsp;!',
                              '&thinsp;?',
                              '«&nbsp;',
                              '&nbsp;»',
                              '&rsquo;',
	);
	public static function initStacker() {
		dcCore::app()->stacker->addFilter('TestStackerFilter',
                                  'tplStacker',  // Class
                                  'SwedishA',    // Function
                                  'textonly',    // Context
                                  100,           // Priority
                                  'stacker',     // Origin
                                  __('Test replacing Dotclear with Dotcleår'),
                                  '/Dotclear/'   // Trigger
		);
		dcCore::app()->stacker->addFilter('FrenchTypography',
                                  'tplStacker',         // Class
                                  'FrenchTypography',   // Function
                                  'textonly',           // Type
                                  100,                  // Priority
                                  'stacker',            // Origin
                                  __('Changes spacing for French punctuation'),
                                  '/[:«»!?;\']/');
	}

	public static function SwedishA($rs,$text,$stack,$elements) {
		return (preg_replace('/Dotclear/', 'Dotcleår',$text));
	}

	public static function FrenchTypography($rs,$text,$stack,$elements) {

		if ((isset($elements['pre']) && $elements['pre']>0) || (isset($elements['code']) && $elements['code']>0)) {
			return $text;
		}

		if (dcCore::app()->plugins->moduleExists('dctranslations') && dcCore::app()->ctx->posts) {
			$lang = dcCore::app()->ctx->posts->getLang();
		} elseif (dcCore::app()->ctx->posts && dcCore::app()->ctx->posts->post_lang) {
			$lang = dcCore::app()->ctx->posts->post_lang;
		} else {
			// unknown context
			$lang = dcCore::app()->blog->settings->system->lang;
		}
		if ($lang != 'fr') {
			return $text;
		}
		$newcontent = preg_replace(tplStacker::$frenchtypo,tplStacker::$frenchtypox,$text);
		return $newcontent;
	}
}
