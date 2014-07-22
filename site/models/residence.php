<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcbookitModelsResidence extends DdcbookitModelsDefault
{

  /**
  * Protected fields
  **/
  var $_apartment_id    	= null;
  var $_residence_id		= null;
  var $_cat_id		    	= null;
  var $_pagination  		= null;
  var $_published   		= 1;
  var $_user_id     		= null;
  var $_bookdate			= null;
  var $_checkin				= null;
  var $_checkout			= null;
  var $_formdata			= null;
  var $_ppl					= null;
  var $_proptype			= null;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
  	//If no User ID is set to current logged in user
  	$this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$app = JFactory::getApplication();
   	$this->_ppl = $app->input->get('ppl', null);
  	$this->_residence_id = $app->input->get('residence_id', null);
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

    $query->select('residence.*');
    $query->from('#__ddcbookit_residences as residence');
	$query->select('apartment.residence_name as residence_id');
	$query->select('apartment.ddcbookit_apartments_id as apart_id');
	$query->select('apartment.min_stay');
	$query->select('COUNT(apartment.ddcbookit_apartments_id) as num_of_aparts');
	$query->select('apartment.default_price as apartment_price');
	$query->select('(apartment.max_adults+apartment.max_kids) as max_guests');
	$query->leftJoin('#__ddcbookit_apartments as apartment on apartment.residence_name = residence.ddcbookit_residence_id');
	$query->select('price.price');
	$query->leftJoin('#__ddcbookit_apartment_prices as price on apartment.residence_name = price.residence_id And apartment.proptype_title = price.proptype_id');
	$query->group('residence.ddcbookit_residence_id');
	$query->order('price.price ASC');
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
  	if($this->_residence_id!=null)
  	{
  		$query->where('residence.ddcbookit_residence_id = "'.$this->_residence_id.'"');
  	}
  	if($this->_published!=null)
  	{
  		$query->where('residence.state = "'.$this->_published.'"');
  	}

   return $query;
  }
}