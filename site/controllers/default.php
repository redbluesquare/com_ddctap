 <?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapControllersDefault extends JControllerBase
{
  public function execute()
  {

    // Get the application
    $app = JFactory::getApplication();
 	
    $params = JComponentHelper::getParams('com_ddctap');
    if ($params->get('required_account') == 1)
    {
    	$user = JFactory::getUser();
    	if ($user->get('guest'))
    	{
    		$app->redirect('index.php',JText::_('COM_DDCTAP_ACCOUNT_REQUIRED_MSG'));
    	}
    }
    
    // Get the document object.
    $document     = JFactory::getDocument();
 
    $viewName     = $app->input->getWord('view', 'Department');
    $viewFormat   = $document->getType();
    $layoutName   = $app->input->getWord('layout', 'default');
 
    $app->input->set('view', $viewName);
 
    // Register the layout paths for the view
    $paths = new SplPriorityQueue;
    $paths->insert(JPATH_COMPONENT . '/views/' . $viewName . '/tmpl', 'normal');

    $viewClass  = 'DdctapViews' . ucfirst($viewName) . ucfirst($viewFormat);
    $modelClass = 'DdctapModels' . ucfirst($viewName);
 
    if (false === class_exists($modelClass))
    {
      $modelClass = 'DdctapModelsDefault';
    }
 
    $view = new $viewClass(new $modelClass, $paths);

    $view->setLayout($layoutName);

    // Render our view.
    echo $view->render();
 
    return true;
  }

}