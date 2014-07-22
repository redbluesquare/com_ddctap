<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcbookitModelsApartments extends DdcbookitModelsDefault
{

  /**
  * Protected fields
  **/
  var $_apartment_id    		= null;
  var $_residence_id			= null;
  var $_cat_id		    = null;
  var $_pagination  	= null;
  var $_published   	= 1;
  var $_user_id     	= null;
  var $_bookdate		= null;
  var $_checkin		= null;
  var $_checkout	= null;
  var $_formdata		= null;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
  	//If no User ID is set to current logged in user
  	$this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$app = JFactory::getApplication();
  	$this->_apartment_id = $app->input->get('apartment_id', null);
  	$this->_residence_id = $app->input->get('residence_id', null);
  	$this->_checkin = $app->input->get('datecheckin', null);
  	$this->_checkout = $app->input->get('datecheckout', null);
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

    $query->select('apartment.*');
    $query->from('#__ddcbookit_apartments as apartment');
    $query->select('proptype.proptype_title,proptype.ddcbookit_proptype_id');
    $query->leftJoin('#__ddcbookit_proptypes as proptype on proptype.ddcbookit_proptype_id=apartment.proptype_title');
    $query->select('residence.residence_name as res_name,residence.ddcbookit_residence_id');
    $query->leftJoin('#__ddcbookit_residences as residence on residence.ddcbookit_residence_id=apartment.residence_name');
    
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


  	if($this->_apartment_id!=null)
  	{
  		$query->where('apartment.ddcbookit_apartments_id = "'.(int)$this->_apartment_id.'"');
  	}
   return $query;
  }
}