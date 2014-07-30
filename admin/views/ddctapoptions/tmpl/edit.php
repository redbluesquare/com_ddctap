<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
$app = JFactory::getApplication();
$resadd = $app->input->get('task',null);

ini_set('display_errors',1);
error_reporting(E_ALL);

?>
<div class="span12">
	<form action="<?php echo JRoute::_('index.php?option=com_ddctap&controller=ddctapoptions'); ?>"
      method="post" name="adminForm" id="adminForm">
        <fieldset class="adminform">
                <legend><?php echo JText::_( 'COM_DDCTAP_PROFILE_DETAILS' ); ?></legend>

                <div class="clearfix"></div>
                <div class="adminformlist">
                	<div class="row-fluid">					
							<?php foreach($this->form->getFieldset('options_main') as $field): ?>
							<div class="span3">
								<?php if ($field->hidden):// If the field is hidden, just display the input.?>
									<?php echo $field->input;?>
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
						<div class="row-fluid">
							<?php foreach($this->form->getFieldset('options_rest') as $field): ?>
							<div class="span3">
								<?php if ($field->hidden):// If the field is hidden, just display the input.?>
									<?php echo $field->input;?>
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

        </fieldset>
        		<input type="hidden" name="task" value="ddctapoption.edit" />
                <?php echo JHtml::_('form.token'); ?>
	</form>
</div>
