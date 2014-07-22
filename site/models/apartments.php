<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcbookitModelsApartments extends DdcbookitModelsDefault
{

  /**
  * Protected fields
  **/
  var $_apartment_id   		= null;
  var $_residence_id		= null;
  var $_cat_id		    	= null;
  var $_pagination  		= null;
  var $_published   		= 1;
  var $_user_id     		= null;
  var $_ppl					= null;
  var $_adults				= null;
  var $_kids				= null;
  var $_rooms				= null;
  var $_proptype			= null;
  var $_formdata			= null;
  protected $messages;

  
  function __construct()
  {
  	$app = JFactory::getApplication();
  	//If no User ID is set to current logged in user
  	$this->_user_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$app = JFactory::getApplication();
  	$session = JFactory::getSession();
  	$input = new JInput();
  	if($input->get('apartmentdatecheck',null)==1){
  		$session->set('checkin', $input->get('checkin',null));
  		$session->set('checkout', $input->get('checkout',null));
  		$session->set('check', 1);
  		$session->set('adults', 2);
  		$session->set('kids', 0);
  	}
  	if($session->get('adults')!=null && $input->get('check',null)==null){
  		$this->_adults = $session->get('adults');
  	}else{
  		$this->_adults = $input->get('adults',null);
  	}
  	if($session->get('kids')!=null){
  		$this->_kids = $session->get('kids');
  	}else{
  		$this->_kids = $input->get('kids',null);
  	}
  	$this->_apartment_id = $app->input->get('apartment_id', null);
  	$this->_residence_id = $app->input->get('residence_id', null);
  	$this->_ppl = $input->get('ppl',null);
  	$this->_rooms = $app->input->get('rooms', null);
  	$this->_proptype = $input->get('proptype', null);
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

    $query->select('apartment.ddcbookit_apartments_id');
    $query->select('apartment.apartment_name');
    $query->select('apartment.residence_name as res_id');
    $query->select('apartment.max_adults');
    $query->select('apartment.max_kids');
    $query->select('apartment.min_stay');
    $query->select('(apartment.min_stay+apartment.default_price) as stdprice');
    $query->select('apartment.proptype_title as pt_id');
    $query->select('(apartment.max_kids+apartment.max_adults) as ppl');
    $query->select('apartment.num_of_beds');
    $query->select('apartment.default_price as apartment_price');
    $query->from('#__ddcbookit_apartments as apartment');
    $query->select('proptype.ddcbookit_proptype_id');
    $query->select('proptype.proptype_title as pt');
    $query->leftJoin('#__ddcbookit_proptypes as proptype on apartment.proptype_title = proptype.ddcbookit_proptype_id');
    $query->select('price.max_days');
    $query->select('price.price');
    $query->leftJoin('#__ddcbookit_apartment_prices as price on apartment.proptype_title = price.proptype_id And apartment.residence_name = price.residence_id');
    $query->select('residence.main_image');
    $query->select('residence.image_thumb');
    $query->select('residence.residence_name as res_name');
    $query->select('residence.town');
    $query->select('residence.post_code');
    $query->select('residence.description');
    $query->leftJoin('#__ddcbookit_residences as residence on apartment.residence_name = residence.ddcbookit_residence_id');
    $query->group('apartment.ddcbookit_apartments_id');
    $query->order('apartment.default_price ASC');
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
  	if($this->_adults!=null)
  	{
  		$query->where('(apartment.max_kids+apartment.max_adults) >= "'.((int)$this->_adults+(int)$this->_kids).'"');
  	}
  	if($this->_apartment_id!=null)
  	{
  		$query->where('apartment.ddcbookit_apartments_id = "'.(int)$this->_apartment_id.'"');
  	}
  	if($this->_proptype!=null)
  	{
  		$query->where('apartment.proptype_title = "'.(int)$this->_proptype.'"');
  	}
  	if($this->_residence_id!=null)
  	{
  		$query->where('apartment.residence_name = "'.(int)$this->_residence_id.'"');
  	}
   return $query;
  }
  
  static function getPrices()
  {
  	$db = JFactory::getDBO();
  	$query = $db->getQuery(TRUE);
  	$query->select('price.ddcbookit_apartment_price_id as id, price.residence_id, price.proptype_id,price.max_days, price.price');
  	$query->from('#__ddcbookit_apartment_prices as price');
  	$query->group('price.ddcbookit_apartment_price_id');
  	// Reset the query using our newly populated query object.
  	$db->setQuery($query);
  	$results = $db->loadObjectList();
  	if($db->getErrorNum()){
  		JError::raiseWarning(500,$db->stderr(true));
  	}
  	return $results;
  }
  
  public function hit($pk = 0)
  {
  	$input = JFactory::getApplication()->input;
    $hitcount = $input->getInt('hitcount', 1);
  	if ($hitcount)
  	{
  		// Initialise variables.
  		$pk = (!empty($pk)) ? $pk : (int)$this->_apartment_id;
  		$db = JFactory::getDBO();
  
  		$db->setQuery(
  				'UPDATE #__ddcbookit_apartments' .
  				' SET hits = hits + 1' .
  				' WHERE ddcbookit_apartments_id = '.(int) $pk
  		);
  
  		if (!$db->query()) {
  			$this->setError($db->getErrorMsg());
  			return false;
  		}
  	}
  
  	return true;
  }
  
  
//   public function hit($pk = 0)
//   {
//   	$input = JFactory::getApplication()->input;
//   	$hitcount = $input->getInt('hitcount', 1);
  
//   	if ($hitcount)
//   	{
//   		$pk = (!empty($pk)) ? $pk : (int) $this->getState('apartment.ddcbookit_apartments_id');
  
//   		$table = JTable::getInstance('Apartments', 'Table');
//   		$table->load($pk);
//   		$table->hit($pk);
//   	}
  
//   	return true;
//   }
}