<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapViewsDdctapoptionsHtml extends JViewHtml
{
	protected $data;
	protected $form;
	protected $params;
	protected $state;
	
  function render()
  {
    $app = JFactory::getApplication();
    $layout = $app->input->get('layout');
    $modelOption = new DdctapModelsDdctapoptions();
    $formOption = new DdctapModelsDdctapoption();
 
    switch($layout) {

     	case "default":
     		default:
			$this->items = $modelOption->listItems();
			$this->addToolbar();
			// Set the submenu
			DdctapHelpersDdctap::addSubmenu('options');
    	break;

    	case "edit":
    		$this->form = $formOption->getForm();
    		$this->item = $modelOption->getItem();
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
        JToolBarHelper::deleteList('', 'ddctapoptions.delete');
        JToolBarHelper::editList('ddctapoption.edit');
        JToolBarHelper::addNew('ddctapoption.add');
               
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
    	JToolBarHelper::save('ddctapoption.save');
    	JToolBarHelper::cancel('ddctapoption.cancel', $isNew ? 'JTOOLBAR_CANCEL': 'JTOOLBAR_CLOSE');
    }
}