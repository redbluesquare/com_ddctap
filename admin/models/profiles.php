<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class DdctapModelsProfiles extends DdctapModelsDefault
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
  	$this->_profile_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$this->_user_id = $app->input->get('user_id', null);
	$this->_cat_id = $app->input->get('id', null);
  	  	
    parent::__construct();       
  }
    
//   function getItem()
//   {
//   	$profile = JFactory::getUser($this->_user_id);
//   	$userDetails = JUserHelper::getProfile($this->_user_id);
//   	$profile->details =  isset($userDetails->profile) ? $userDetails->profile : array();
  	
//   	$profile->isMine = JFactory::getUser()->id == $profile->id ? TRUE : FALSE;
  	
//   	return $profile;
//   }
	
   protected function _buildQuery()
  {
 	
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select("u.id, u.username, u.name, u.email, u.registerDate");
    $query->from("#__users as u");
    
    $query->select("uext.*");
    $query->leftjoin("#__ddctap_userext as uext on uext.user_id = u.id");

    $query->select("o1.title as jt");
    $query->leftjoin("#__ddctap_options as o1 on o1.ddctap_option_id = uext.jobtitle");
    
    $query->select("o2.title as part_time");
    $query->leftjoin("#__ddctap_options as o2 on o2.ddctap_option_id = uext.parttime");
    
    $query->select("o3.title as emp_status");
    $query->leftjoin("#__ddctap_options as o3 on o3.ddctap_option_id = uext.rbgb");
    
    $query->select("o4.title as shift_pattern");
    $query->leftjoin("#__ddctap_options as o4 on o4.ddctap_option_id = uext.shift");
    
    $query->select("o5.title as dsp_cat");
    $query->leftjoin("#__ddctap_options as o5 on o5.ddctap_option_id = uext.dsp");
    
    return $query;
    
  }
  
  protected function _buildWhere(&$query)
  {
	if($this->_user_id!=null)
	{
		$query->where("u.id = '".(int)$this->_user_id."'");
	}
  	

   return $query;
  }

}