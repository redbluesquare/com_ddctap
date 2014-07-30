<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Apartments Controller
 */
class DdctapControllersPROFILEs extends DdctapControllersDefault
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
		
		
		if($this->data['table']=='profile')
		{
			$task = $jinput->get('task', "", 'STR' );
			if($task=='profile.add')
			{
// 				$app = JFactory::getApplication();
//     			$viewName     = $app->input->getWord('view', 'Apartments');
// 				$modelName  = $app->input->get('models', 'Apartment'); 
//   				$app->input->set('view', $viewName);
//   				$app->input->set('layout', 'edit');
     
//     			//display view
//     			return parent::execute();
    			
    			$app = JFactory::getApplication();
    			$link=  JRoute::_('index.php?option=com_ddctap&view=profiles&layout=edit&task=profile.add',FALSE);
    			
    			$app->redirect($link,true);
    			
			}
			if($task=="profile.save")
			{
				$modelName  = $app->input->get('models', 'profiles');
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
				$link=  JRoute::_('index.php?option=com_ddctap&view=profiles',FALSE);
				
				$mainframes->redirect($link,true);
			}
			if($task=="profile.cancel")
			{
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddctap&view=profiles',FALSE);
				
				$mainframes->redirect($link,true);
			}
		}
	}
		
}