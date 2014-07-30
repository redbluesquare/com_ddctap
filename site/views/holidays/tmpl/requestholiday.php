<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

?>
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
	<button class="btn"><?php echo JText::_('COM_DDCTAP_REQUESTNOW'); ?></button>

</form>
