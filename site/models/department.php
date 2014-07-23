<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapModelsDepartment extends DdctapModelsDefault
{

  /**
  * Protected fields
  **/
  var $_holiday_id    	= null;
  var $_cat_id		    	= null;
  var $_pagination  		= null;
  var $_published   		= 1;
  var $_user_id     		= null;
  var $_formdata			= null;
  var $_ppl					= null;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
  	//If no User ID is set to current logged in user
  	$this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$app = JFactory::getApplication();
   	$this->_ppl = $app->input->get('ppl', null);
  	$this->_holiday_id = $app->input->get('holiday_id', null);
  	$this->_cat_id = $app->input->get('id', null);	
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
    $query->from('#__ddctap_holidayplanner as hol');
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
//   	if($this->_residence_id!=null)
//   	{
//   		$query->where('residence.ddcbookit_residence_id = "'.$this->_residence_id.'"');
//   	}
//   	if($this->_published!=null)
//   	{
//   		$query->where('residence.state = "'.$this->_published.'"');
//   	}

//   return $query;
  }
}