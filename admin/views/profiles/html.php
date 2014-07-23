<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapViewsProfilesHtml extends JViewHtml
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
    $layout = $app->input->get('layout');
    $modelProfile = new DdctapModelsProfiles();
    $formProfile = new DdctapModelsProfile();
 
    switch($layout) {

     	case "default":
     		default:
			$this->items = $modelProfile->listItems();
			$this->addToolbar();
			// Set the submenu
			DdctapHelpersDdctap::addSubmenu('profiles');
    	break;

    	case "edit":
    		$this->form = $formProfile->getForm();
    		$this->item = $modelProfile->getItem();
    		$this->addUpdToolbar();
    	break;
    		
    }
    
    $this->sidebar = JHtmlSidebar::render();
    //display
    return parent::render();
  }
   protected function addToolbar()
    {
        $canDo  = DdctapHelpersDdctap::getActions();

        // Get the toolbar object instance
        $bar = JToolBar::getInstance('toolbar');

        JToolBarHelper::title(JText::_('COM_DDCTAP_MANAGER_PROFILES_EDIT'));
        JToolBarHelper::deleteList('', 'residences.delete');
        JToolBarHelper::editList('residence.edit');
        JToolBarHelper::addNew('profile.add');
               
        if ($canDo->get('core.admin'))
        {
            JToolbarHelper::preferences('com_ddctap');
        }
    }
    protected function addUpdToolBar()
    {
    	$input = JFactory::getApplication()->input;
    	$input->set('hidemainmenu', true);
    	$isNew = (isset($this->items->ddctap_userext_id));
    	JToolBarHelper::title($isNew ? JText::_('COM_DDCTAP_MANAGER_PROFILE_NEW'): JText::_('COM_DDCTAP_MANAGER_PROFILE_EDIT'));
    	JToolBarHelper::save('profile.save');
    	JToolBarHelper::cancel('profile.cancel', $isNew ? 'JTOOLBAR_CANCEL': 'JTOOLBAR_CLOSE');
    }
}