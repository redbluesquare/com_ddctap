<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdcbookitModelsPrices extends DdcbookitModelsDefault
{

  /**
  * Protected fields
  **/
  var $_prices_id    		= null;
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
  	$this->_prices_id = $app->input->get('prices_id', null);
  	$app = JFactory::getApplication();
  	$jinput = JFactory::getApplication()->input;
	$this->_formdata    = $jinput->get('jform', array(),'array');
	$this->task = $jinput->get('task', "", 'STR' );
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

    $query->select('prices.ddcbookit_apartment_price_id');
    $query->select('prices.residence_id');
    $query->select('prices.proptype_id as pt');
    $query->select('prices.max_days');
    $query->select('prices.price');
    $query->from('#__ddcbookit_apartment_prices as prices');
    return $query;
    
  }
  
  static function getResidences()
  {
  	$db = JFactory::getDBO();
  	$query = $db->getQuery(TRUE);
  	$query->select('res.ddcbookit_residence_id as id, res.residence_name as residence');
  	$query->from('#__ddcbookit_residences as res');
  	$query->group('res.residence_name');
  	// Reset the query using our newly populated query object.
  	$db->setQuery($query);
  	$resresults = $db->loadObjectList();
  	if($db->getErrorNum()){
  		JError::raiseWarning(500,$db->stderr(true));
  	}
  	return $resresults;
  }
  static function getProptypes()
  {
  	$db = JFactory::getDBO();
  	$query = $db->getQuery(TRUE);
  	$query->select('pt.ddcbookit_proptype_id as id, pt.proptype_title');
  	$query->from('#__ddcbookit_proptypes as pt');
  	$input = new JInput();
  	$proptype = $input->get('proptype', null);
  	 
  	 
  	// Reset the query using our newly populated query object.
  	$db->setQuery($query);
  	$proptyperesults = $db->loadObjectList();
  	if($db->getErrorNum()){
  		JError::raiseWarning(500,$db->stderr(true));
  	}
  	return $proptyperesults;
  }
  
  /**
  * Builds the filter for the query
  * @param    object  Query object
  * @return   object  Query object
  *
  */
  protected function _buildWhere(&$query)
  {


  	if($this->_prices_id!=null || $this->task=='price.add')
  	{
  			$query->where('prices.ddcbookit_apartment_price_id = "'.(int)$this->_prices_id.'"');
  	}
   return $query;
  }
  
  function storeprice()
  {
  	$jinput = JFactory::getApplication()->input;
  	$this->data = $jinput->get('jform', array(),'array');
  	
  	
  	$id=$this->data['ddcbookit_apartment_price_id'];
  	$residence_id=$this->data['residence_id'];
  	$proptype_id=$this->data['proptype_id'];
  	$maxdays=$this->data['max_days'];
  	$price=$this->data['price'];
  	
  	// Get a db connection.
  	$db = JFactory::getDbo();
  	 
  	// Create a new query object.
  	$query = $db->getQuery(true);

  	if($id!=null){
	  	// Fields to update.
	  	$fields = array(
	  			$db->quoteName('residence_id') . ' = ' . $db->quote($residence_id),
	  			$db->quoteName('proptype_id') . ' = ' . $db->quote($proptype_id),
	  			$db->quoteName('max_days') . ' = ' . $db->quote($maxdays),
	  			$db->quoteName('price') . ' = '.$db->quote($price)
	  	);
	  	
	  	// Conditions for which records should be updated.
	  	$conditions = array(
	  			$db->quoteName('ddcbookit_apartment_price_id') . ' = '.$db->quote($id)
	  	);
	  	
	  	$query->update($db->quoteName('#__ddcbookit_apartment_prices'))->set($fields)->where($conditions);
  	}
  	else{
	  	// Insert columns.
	  	$columns = array('residence_id', 'proptype_id', 'max_days', 'price');
	  	 
	  	// Insert values.
	  	$values = array($db->quote($residence_id), $db->quote($proptype_id), $db->quote($maxdays), $db->quote($price));
	  	 
	  	// Prepare the insert query.
	  	$query
	  	->insert($db->quoteName('#__ddcbookit_apartment_prices'))
	  	->columns($db->quoteName($columns))
	  	->values(implode(',', $values));
  	} 
  	// Set the query using our newly populated query object and execute it.
  	$db->setQuery($query);
  	$db->execute();
  	 
  	return $query;
  }
}