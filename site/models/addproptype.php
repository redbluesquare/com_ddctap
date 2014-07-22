<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class DdcbookitModelsAddproptype extends JModelForm
{
	var $form    		  = null;
	var $_user_id 		  = null;

	function __construct()
	{

		parent::__construct();
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		$form = $this->loadForm('com_ddcbookit.addproptype', 'addproptype', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}

	public function getInput()
	{
		parent::__construct();
	}
}
