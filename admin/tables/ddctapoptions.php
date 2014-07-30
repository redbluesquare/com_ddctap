<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableDdctapoptions extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddctap_option_id 			= null;

	
	function __construct( &$db )
	{
    	parent::__construct('#__ddctap_options', 'ddctap_option_id', $db);
  	}
}