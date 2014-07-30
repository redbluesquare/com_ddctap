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
  	$this->session = JFactory::getSession();
  	if($app->input->get('holiday_id', null)==null){
  		$this->_holiday_id = $this->session->get('holiday_req');
  	}else{
  		$this->_holiday_id = $app->input->get('holiday_id', null);
  	}
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
    $query->from('#__ddctap_holidayplanner as hol');
    
    $query->select('u1.name as user');
    $query->leftJoin('#__users as u1 on u1.id = hol.user_id');
    
    $query->select('u2.name as r_by');
    $query->leftJoin('#__users as u2 on u2.id = hol.requested_by');
    
    $query->select('u3.name as c_by');
    $query->leftJoin('#__users as u3 on u3.id = hol.created_by');
    
    $query->select('u4.name as m_by');
    $query->leftJoin('#__users as u4 on u4.id = hol.modified_by');
    
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
  		$query->where('hol.ddctap_holiday_id = "'.(int)$this->_holiday_id.'"');
  	}
   return $query;
  }
  
  static public function getApprover(){
  	
  	$params = JComponentHelper::getParams('com_ddctap');
  	$approval = $params->get('approval');
  	
  	$db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select('u.*');
    $query->from('#__users as u');
  	$query->where('u.id = "'.(int)$approval.'"');
    
  	$db->setQuery($query);
  	
  	$item = $db->loadObject();
  	return $item;

  }
  
  public function storeHolReq($data=null)
  {
  	$date = date("Y-m-d H:i:s");
  	$user = JFactory::getUser()->id;
  	$data = $data ? $data : JRequest::getVar('jform', array(), 'post', 'array');
  	$user_id = $data['user_id'];
  	$holidaydatestart=JHtml::date(strtotime($data['holidaydatestart']),"Y-m-d");
  	$holidaydateend=JHtml::date(strtotime($data['holidaydateend']),"Y-m-d");
  	
  	$modified_by=$user;
  	$requested_by=$data['requested_by'];
  	if(isset($approved_by))
  	{
  		$approved_by=$user;
  		$approved_on=$date;
  	}
  	$ddctap_holiday_id=$data['ddctap_holiday_id'];
  	$status = $data['status'];
  	if($created==null)
  	{
  		$created_by=$user;
  		$created = $date;
  	}
  	$modified = $date;
  	$sitetitle = JFactory::getApplication()->getCfg('sitename');
  	 		 
  	// Get a db connection.
  	$db = JFactory::getDbo();
  		 
  	// Create a new query object.
  	$query = $db->getQuery(true);
  		 
  	// Insert columns.
  	$columns = array('user_id', 'holidaydatestart', 'holidaydateend', 'modified_by', 'modified', 
  			'requested_by', 'created_by','created', 'status');
  		 
  	// Insert values.
  	$values = array($db->quote($user_id), $db->quote($holidaydatestart), $db->quote($holidaydateend), $db->quote($modified_by), $db->quote($modified),
  			$db->quote($requested_by), $db->quote($created_by), $db->quote($created), $db->quote($status));
  		 
  	// Prepare the insert query.
  	$query
  		->insert($db->quoteName('#__ddctap_holidayplanner'))
  		->columns($db->quoteName($columns))
  		->values(implode(',', $values));
  		 
  	// Set the query using our newly populated query object and execute it.
  	$db->setQuery($query);
  	$db->execute();
  	$holiday_ref = $db->insertid();
  		$this->session->set('holiday_ref',$holiday_ref);
  		 
  		 
  		return $query;
  	
  	}
  
}