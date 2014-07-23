<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class DdctapHelpersStyle
{
	public static function load()
	{
		$document = JFactory::getDocument();

		//stylesheets
		//$document->addStylesheet(JURI::base().'components/com_ddcbookit/assets/css/style.css');

		//javascripts
		$document->addScript(JURI::base().'components/com_ddctap/assets/js/ddctap.js');

	}
}