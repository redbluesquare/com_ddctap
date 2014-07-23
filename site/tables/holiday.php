<?php defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
class TableHoliday extends JTable
{                      
  /**
  * Constructor
  *
  * @param object Database connector object
  */
	var $ddctap_holiday_id 			= null;

	
	function __construct( &$db )
	{
    	parent::__construct('#__ddctap_holidayplanner', 'ddctap_holiday_id', $db);
  	}
}