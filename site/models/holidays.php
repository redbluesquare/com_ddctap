<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapModelsHolidays extends DdctapModelsDefault
{

  /**
  * Protected fields
  **/
  var $_holiday_id    		= null;
  var $_cat_id		    = null;
  var $_pagination  	= null;
  var $_published   	= 1;
  var $_user_id     	= null;
  var $_formdata		= null;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
  	//If no User ID is set to current logged in user
  	$this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$app = JFactory::getApplication();
  	$this->_holiday_id = $app->input->get('holiday_id', null);
  	$this->_residence_id = $app->input->get('residence_id', null);
  	$this->_cat_id = $app->input->get('id', null);
  	$jinput = JFactory::getApplication()->input;
	$this->_formdata    = $jinput->get('jform', array(),'array');
  	  	
    parent::__construct();       
  }
    
	
  /**
  * Builds the query to be used by the product model
  * @return   object  Query object
  *
  *
  */
  protected function _buildQuery()
  {
 	
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('hol.*');
    $query->from('#__ddcbookit_holidayplanner as hol');
    
    return $query;
    
  }

  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  *
  */
  protected function _buildWhere(&$query)
  {


  	if($this->_holiday_id!=null)
  	{
  		$query->where('hol.ddcbookit_holiday_id = "'.(int)$this->_holiday_id.'"');
  	}
   return $query;
  }
  
}