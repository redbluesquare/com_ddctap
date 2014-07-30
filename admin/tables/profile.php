<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableProfile extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddctap_holiday_id 			= null;

	
	function __construct( &$db )
	{
    	parent::__construct('#__ddctap_userext', 'ddctap_userext_id', $db);
  	}
}