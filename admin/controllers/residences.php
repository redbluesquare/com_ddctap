<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Residences Controller
 */
class DdcbookitControllersResidences extends DdcbookitControllersDefault
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
		
		if($this->data['table']=='residences')
		{
			$task = $jinput->get('task', "", 'STR' );
			if($task=='residence.add')
			{
// 				$app = JFactory::getApplication();
//     			$viewName     = $app->input->getWord('view', 'Residences');
// 				$modelName  = $app->input->get('models', 'Residence'); 
//   				$app->input->set('view', $viewName);
//   				$app->input->set('layout', 'edit');
     
//     			//display view
//     			return parent::execute();
    			
    			$app = JFactory::getApplication();
    			$link=  JRoute::_('index.php?option=com_ddcbookit&view=residences&layout=edit&task=residence.add',FALSE);
    			 
    			$app->redirect($link,true);
			}
			if($task=="residence.save")
			{
				$modelName  = $app->input->get('models', 'residences');
				$modelName  = 'DdcbookitModels'.ucwords($modelName);
				$model = new $modelName();

				if( $row = $model->store() )
				{
					$return['success'] = true;
					$msg = JText::_('COM_DDCBOOKIT_SAVE_SUCCESS');
				}else{
					$return['msg'] = JText::_('COM_DDCBOOKIT_SAVE_FAILURE');
				}
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddcbookit&view=residences',FALSE);
				
				$mainframes->redirect($link,true);
			}
			if($task=="residence.cancel")
			{
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddcbookit&view=residences',FALSE);
				
				$mainframes->redirect($link,true);
			}
		}
	}
		
}