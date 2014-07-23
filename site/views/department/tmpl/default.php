<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<h2><?php echo JText::_('COMDDCTAP_BOOK_HOLIDAY'); ?></h2>

<form>
	<input type="text" name="user_id" id="user_id" placeholder="User" /><br/>
	<input type="text" name="holidaydatestart" id="holidaydatestart" placeholder="Start" /><br/>
	<input type="text" name="holidaydateend" id="holidaydateend" placeholder="End" /><br/>
	<input type="text" name="requested_by" id="requested_by" placeholder="Controller" /><br/>
	<button class="btn"><?php echo JText::_('COM_DDCTAP_REQUESTNOW'); ?></button>

</form>
<?php

?>