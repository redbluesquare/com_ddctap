<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Apartments Controller
 */
class DdctapControllersDdctapoptions extends DdctapControllersDefault
{
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$jinput = JFactory::getApplication()->input;
		$this->data = $jinput->get('jform', array(),'array');
		
		
		if($this->data['table']=='ddctapoptions')
		{
			$task = $jinput->get('task', "", 'STR' );
			if($task=='ddctapoption.add')
			{
// 				$app = JFactory::getApplication();
//     			$viewName     = $app->input->getWord('view', 'Apartments');
// 				$modelName  = $app->input->get('models', 'Apartment'); 
//   				$app->input->set('view', $viewName);
//   				$app->input->set('layout', 'edit');
     
//     			//display view
//     			return parent::execute();
    			
    			$app = JFactory::getApplication();
    			$link=  JRoute::_('index.php?option=com_ddctap&view=ddctapoptions&layout=edit&task=ddctapoption.add',FALSE);
    			
    			$app->redirect($link,true);
    			
			}
			if($task=="ddctapoption.save")
			{
				$modelName  = $app->input->get('models', 'ddctapoptions');
				$modelName  = 'DdctapModels'.ucwords($modelName);
				$model = new $modelName();

				if( $row = $model->store() )
				{
					$return['success'] = true;
					$msg = JText::_('COM_DDCTAP_SAVE_SUCCESS');
				}else{
					$return['msg'] = JText::_('COM_DDCTAP_SAVE_FAILURE');
				}
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddctap&view=ddctapoptions',FALSE);
				
				$mainframes->redirect($link,true);
			}
			if($task=="ddctapoption.cancel")
			{
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddctap&view=ddctapoptions',FALSE);
				
				$mainframes->redirect($link,true);
			}
		}
	}
		
}