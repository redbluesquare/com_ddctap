<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
<<<<<<< HEAD
<h2><?php echo JText::_('COMDDCTAP_BOOK_HOLIDAY'); ?></h2>

<form>
	<input type="text" name="user_id" id="user_id" placeholder="User" /><br/>
	<input type="text" name="holidaydatestart" id="holidaydatestart" placeholder="Start" /><br/>
	<input type="text" name="holidaydateend" id="holidaydateend" placeholder="End" /><br/>
	<input type="text" name="requested_by" id="requested_by" placeholder="Controller" /><br/>
=======
<h2><?php echo JText::_('COM_DDCTAP_BOOK_HOLIDAY'); ?></h2>
<form method="post" action="<?php echo JRoute::_('index.php?option=com_ddctap&controller=add'); ?>">
	<?php foreach($this->form->getFieldset("default_start") as $field): ?>
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
							<div class="">
							<?php foreach($this->form->getFieldset("dates_sae") as $field): ?>
								<div class="span4">
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
								</div>
							<?php endforeach; ?>
							</div>
							<div class="clearfix"></div>
							<?php foreach($this->form->getFieldset("default_end") as $field): ?>
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
>>>>>>> origin/tag1
	<button class="btn"><?php echo JText::_('COM_DDCTAP_REQUESTNOW'); ?></button>

</form>
