<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Apartments Controller
 */
class DdcbookitControllersPrices extends DdcbookitControllersDefault
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
		
		
		if($this->data['table']=='prices')
		{
			$task = $jinput->get('task', "", 'STR' );
			if($task=='price.add')
			{
// 				$app = JFactory::getApplication();
//     			$viewName = $app->input->getWord('view', 'Prices');
// 				$modelName = $app->input->get('models', 'prices'); 
//   			$app->input->set('view', $viewName);
//   			$app->input->set('layout', 'edit');
     
//     			//display view
//     			return parent::execute();
    			
    			$app = JFactory::getApplication();
    			$link=  JRoute::_('index.php?option=com_ddcbookit&view=prices&layout=edit&task=price.add',FALSE);
    			
    			$app->redirect($link,true);
    			
			}
			if($task=="price.save")
			{
				$modelName  = $app->input->get('models', 'prices');
				$modelName  = 'DdcbookitModels'.ucwords($modelName);
				$model = new $modelName();

				if( $row = $model->storeprice() )
				{
					$return['success'] = true;
					$msg = JText::_('COM_DDCBOOKIT_SAVE_SUCCESS');
				}else{
					$return['msg'] = JText::_('COM_DDCBOOKIT_SAVE_FAILURE');
				}
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddcbookit&view=prices',FALSE);
				
				$mainframes->redirect($link,true);
			}
			if($task=="price.cancel")
			{
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddcbookit&view=prices',FALSE);
				
				$mainframes->redirect($link,true);
			}
		}
	}
		
}