<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

class DdcbookitModelsAddapartment extends JModelForm
{
	var $form    		  = null;
	var $_user_id 		  = null;

	function __construct()
	{

		parent::__construct();
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		//$profileModel = new DevcloudModelsProfile();
		//$profile = $profileModel->getItem();
		//if($profile->group_id==8){
			// Get the form.
			$form = $this->loadForm('com_ddcbookit.addapartment', 'addapartment', array('control' => 'jform', 'load_data' => $loadData));
			if (empty($form))
			{
				return false;
			}
			return $form;
		//}
		//else{ return false;}
	}

	public function getInput()
	{
		parent::__construct();
	}
}
