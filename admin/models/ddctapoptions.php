<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapModelsDdctapoptions extends DdctapModelsDefault
{

  /**
  * Protected fields
  **/
  var $_user_id    	= null;
  var $_cat_id		    	= null;
  var $_pagination  		= null;
  var $_published   		= 1;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
	
  	$jinput = JFactory::getApplication()->input;
  	$task = $jinput->get('task', "", 'STR' );
  	
  	//If no User ID is set to current logged in user
  	$this->_option_id = $app->input->get('option_id', null);
	$this->_cat_id = $app->input->get('id', null);
  	  	
    parent::__construct();       
  }
	
   protected function _buildQuery()
  {
 	
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select("o.*");
    $query->from("#__ddctap_options as o");
    
    return $query;
    
  }
  
  protected function _buildWhere(&$query)
  {
	if($this->_option_id!=null)
	{
		$query->where("o.ddctap_option_id = '".(int)$this->_option_id."'");
	}
  	

   return $query;
  }

}