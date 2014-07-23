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
	
  	//If no User ID is set to current logged in user
  	$this->_profile_id = $app->input->get('profile_id', JFactory::getUser()->id);
  	$this->_user_id = $app->input->get('user_id', null);
	$this->_cat_id = $app->input->get('id', null);
  	  	
    parent::__construct();       
  }
    
  function getItem()
  {
  	$profile = JFactory::getUser($this->_user_id);
  	$userDetails = JUserHelper::getProfile($this->_user_id);
  	$profile->details =  isset($userDetails->profile) ? $userDetails->profile : array();
  	
  	$profile->isMine = JFactory::getUser()->id == $profile->id ? TRUE : FALSE;
  	
  	return $profile;
  }
	
   protected function _buildQuery()
  {
 	
    $db = JFactory::getDBO();
    $query = $db->getQuery(TRUE);

    $query->select("u.id, u.username, u.name, u.email, u.registerDate");
    $query->from("#__users as u");

    $query->select("uext.*");
    $query->leftjoin("#__ddctap_userext as uext on uext.user_id = u.id");
    
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