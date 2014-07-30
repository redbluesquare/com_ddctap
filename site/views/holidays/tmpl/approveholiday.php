<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
$status_id = $this->holiday->status;
if($status_id==0)
{
	$status = "Waiting Approval";
}else if($status_id==1)
{
	$status = "Holiday Declined";
}else if($status_id==2)
{
	$status = "Holiday Approved";
}
$approver = JFactory::getUser()->name;
echo $this->holiday->status;
?>
<h2><?php echo JText::_('COM_DDCTAP_BOOK_HOLIDAY'); ?></h2>
<div class="span8">
<table class="table table-bordered">
	<tbody>
		<tr><th><?php echo JText::_('COM_DDCTAP_NAME'); ?></th><td><?php echo $this->holiday->user; ?></td></tr>
		<tr><th><?php echo JText::_('COM_DDCTAP_HOLIDAY_DURATION'); ?></th><td><?php echo JHtml::date($this->holiday->holidaydatestart,"d/m/Y")." to ".JHtml::date($this->holiday->holidaydateend,"d/m/Y"); ?></td></tr>
		<tr><th><?php echo JText::_('COM_DDCTAP_REQUESTED_BY'); ?></th><td><?php echo $this->holiday->r_by; ?></td></tr>
		<tr><th><?php echo JText::_('COM_DDCTAP_REQUESTED_ON'); ?></th><td><?php echo JHtml::date($this->holiday->created,"H:i d/m/Y"); ?></td></tr>
		<tr><th><?php echo JText::_('COM_DDCTAP_STATUS'); ?></th><td><?php echo $status; ?></td></tr>
		<tr><th><?php echo JText::_('COM_DDCTAP_APPROVAL_NAME'); ?></th><td><?php echo $approver; ?></td></tr>
	</tbody>
</table>
</div>
<div class="clearfix"></div>
<form method="post" action="<?php echo JRoute::_('index.php?option=com_ddctap&controller=holiday'); ?>">
	<?php foreach($this->form->getFieldset("default_approve") as $field): ?>
								<?php if ($field->hidden):// If the field is hidden, just display the input.?>
									<div><?php echo $field->input;?></div>
								<?php else:?>
								<div class="control-group">
									<div class="control-label">
										<?php echo $field->label; ?>
										<?php if (!$field->required && $field->type != 'Spacer') : ?>
											<span class="optional"><?php //echo JText::_('COM_USERS_OPTIONAL');?></span>
										<?php endif; ?>
									</div>
									<div class="controls">
										<?php echo $field->input;?>
									</div>
								</div>
								<?php endif;?>
							<?php endforeach; ?>
							<div class="clearfix"></div>
	<input type="hidden" id="jform_ddctap_holiday_id" name="jform[ddctap_holiday_id]" value="<?php echo $this->holiday->ddctap_holiday_id; ?>" />
	<input type="hidden" id="jform_user_id" name="jform[user_id]" value="<?php echo $this->holiday->user_id; ?>" />
	<input type="hidden" id="jform_approved_by" name="jform[approved_by]" value="<?php echo JFactory::getUser()->id; ?>" />
	<input type="hidden" id="jform_created" name="jform[created]" value="<?php echo $this->holiday->created; ?>" />
	<input type="hidden" id="table" name="table" value="<?php echo "holidayplanner"; ?>" />
	
	<button class="btn"><?php echo JText::_('COM_DDCTAP_REQUESTNOW'); ?></button>
	
</form>
