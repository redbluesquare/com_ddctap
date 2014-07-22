<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 

class DdcbookitViewsApartmentsHtml extends JViewHtml
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
	public function display($tpl = null)
	{
		// Get the view data.
	
		$this->form		= $this->get('Data');
		$this->form		= $this->get('Form');
		$this->form		= $this->get('Params');
		$this->form		= $this->get('State');
	
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
	
		// get the Data
		$form = $this->get('Form');
		$item = $this->get('Item');
	
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Assign the Data
		$this->form = $form;
		$this->item = $item;
	
		parent::display($tpl);
	}
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $this->getLayout();
    
    //retrieve task list from model
    $apartmentsModel = new DdcbookitModelsApartments();
    $addapartmentModel = new DdcbookitModelsAddapartment();
    $servicesModel = new DdcbookitModelsServices();
    $residenceModel = new DdcbookitModelsResidence();
    $profileModel = new DdcbookitModelsProfile();
    $rimodel = new DdcbookitModelsResidenceimage();
    $bookModel = new DdcbookitModelsBooking();
 
    switch($layout) {
     	case "apartments":
     		$pathway = $app->getPathway();
     		$pathway->addItem('apartments', '');
     		$this->apartmentsModel=$apartmentsModel;
     		$this->booking = $bookModel->listItems();
     		$this->services = $servicesModel->listItems();
        	$this->residence = $residenceModel->getItem();
     		$this->apartments = $apartmentsModel->listItems();
        	$this->resimage = $rimodel->listItems();
    		$this->_resImgView = DdcbookitHelpersView::load('Apartments', '_resimg', 'phtml');
      	break;
    	case "residence":
    		default:
    		$this->booking = $bookModel->listItems();
    		$this->apartments = $apartmentsModel->listItems();
    		$this->profile = $profileModel->getItem();
    		$this->residence = $residenceModel->listItems();
    		$this->_resListView = DdcbookitHelpersView::load('Apartments','_resentry','phtml');
    	break;
    	case "apartmentbook":
    		$this->residence = $residenceModel->getItem();
    		$this->apartments = $apartmentsModel->getItem();
    		$this->services = $servicesModel->listItems();
    		$this->apartform = null;
    		$apartmentsModel->hit();
    	break;
    	case "booksummary":
    		$this->booking = $bookModel->getItem();

    		break;
    }
 
    //display
    return parent::render();
  } 
}