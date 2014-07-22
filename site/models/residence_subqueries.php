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
  	//$input = new JInput();
  	//$jinput = JFactory::getApplication()->input;
   	//$this->_formdata    = $jinput->get('jform', array(),'array');
//    	if(isset($this->_formdata['ppl']) Or isset($this->_formdata['checkin']) Or isset($this->_formdata['checkout'])){
//    		$this->_ppl = $this->_formdata['ppl'];
//    		$this->_checkin = date('Y-m-d', strtotime(str_replace('-','/',$this->_formdata['checkin'])));
//    		$this->_checkout = date('Y-m-d', strtotime(str_replace('-','/',$this->_formdata['checkout'])));
//    	}
   	$this->_ppl = $app->input->get('ppl', null);
  	$this->_residence_id = $app->input->get('residence_id', null);
  	$this->_checkin = $app->input->get('datecheckin', null);
  	$this->_checkout = $app->input->get('datecheckout', null);
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
    $query->select('(SELECT MIN(apartment.default_price) 
    		FROM #__ddcbookit_apartments as apartment 
    		WHERE apartment.residence_name = residence.ddcbookit_residence_id) as apartment_price');
    $query->select('(SELECT apartment.ddcbookit_apartments_id
    		FROM #__ddcbookit_apartments as apartment
    		WHERE apartment.default_price = (SELECT MIN(apartment.default_price) 
    		FROM #__ddcbookit_apartments as apartment 
    		WHERE apartment.residence_name = residence.ddcbookit_residence_id)) as apart_id');
    $query->select('(SELECT (apartment.max_kids+apartment.max_adults) as ppl
    		FROM #__ddcbookit_apartments as apartment
    		WHERE apartment.default_price = (SELECT MIN(apartment.default_price)
    		FROM #__ddcbookit_apartments as apartment
    		WHERE apartment.residence_name = residence.ddcbookit_residence_id)) as max_guests');
	$query->group('residence.ddcbookit_residence_id');
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