<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

class DdctapViewsHolidaysHtml extends JViewHtml
{
	protected $data;
	protected $form;
	protected $params;
	protected $state;
	/**
	 * Method to display the view.
	 *
	 * @param   string	The template file to include
	 * @since   1.6
	 */
	function render()
  {
    $app = JFactory::getApplication();
    //$layout = $this->getLayout();
    
    $layout = $app->input->get('layout');
    
    //retrieve task list from model
 	$holsModel = new DdctapModelsHolidays();
    $holformModel = new DdctapModelsHoliday();
    
    switch($layout) {
    	case "requestholiday":
    		default:
    		$this->form = $holformModel->getForm();
    		$this->holiday = $holsModel->listItems();

    	break;
    	case "approveholiday":

    		$this->form = $holformModel->getForm();
    		$this->holiday = $holsModel->getItem();
    	break;
    	case "status":
    		$this->holiday = $holsModel->listItems();
    	
    		break;
    }
 
    //display
    return parent::render();
  } 
}