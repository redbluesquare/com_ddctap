<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');
 
/**
 * Apartments Controller
 */
class DdcbookitControllersProptypes extends DdcbookitControllersDefault
{

	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$jinput = JFactory::getApplication()->input;
		$this->data = $jinput->get('jform', array(),'array');
		
		
	if($this->data['table']=='proptypes')
		{
			$task = $jinput->get('task', "", 'STR' );
			if($task=='proptype.add')
			{
// 				$app = JFactory::getApplication();
//     			$viewName     = $app->input->getWord('view', 'Proptypes');
// 				$modelName  = $app->input->get('models', 'Proptypes'); 
//   				$app->input->set('view', $viewName);
//   				$app->input->set('layout', 'edit');
     
//     			//display view
//     			return parent::execute();
    			
    			$mainframes = JFactory::getApplication();
    			$link=  JRoute::_('index.php?option=com_ddcbookit&view=proptypes&layout=edit&task=proptype.add',FALSE);
    			
    			$mainframes->redirect($link,true);
			}
			if($task=="proptype.save")
			{
				$modelName  = $app->input->get('models', 'proptypes');
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
				$link=  JRoute::_('index.php?option=com_ddcbookit&view=proptypes',FALSE);
				
				$mainframes->redirect($link,true);
			}
			if($task=="proptype.cancel")
			{
				$mainframes = JFactory::getApplication();
				$link=  JRoute::_('index.php?option=com_ddcbookit&view=proptypes',FALSE);
				
				$mainframes->redirect($link,true);
			}
		}
	}
		
}