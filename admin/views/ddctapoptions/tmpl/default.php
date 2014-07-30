<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_ddctap&controller=ddctapoptions'); ?>" method="post" name="adminForm" id="adminForm">
        <table class="adminlist">
                <thead>
                	<tr>
                		<th width="3%"><?php echo JText::_('COM_DDCTAP_ID'); ?></th>
        				<th width="10%"><?php echo JText::_('COM_DDCTAP_TITLE'); ?></th>
						<th width="10%"><?php echo JText::_('COM_DDCTAP_CATEGORY'); ?></th>
					</tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                <?php foreach($this->items as $i => $item): ?>
        			<tr class="row<?php echo $i % 2; ?>">
                		<td>
                	        <?php echo $item->ddctap_option_id; ?>
                		</td>
                		<td>
                	        <a href="<?php echo JRoute::_('index.php?option=com_ddctap&view=ddctapoptions&layout=edit&option_id='.$item->ddctap_option_id); ?>"><?php echo $item->title; ?></a>
                		</td>
                		<td style="text-align: center;">
                	        <?php echo $item->catid; ?>
                		</td>
        			</tr>
				<?php endforeach; ?>
                </tbody>
        </table>
        
        <div>
                <input type="hidden" name="jform[table]" value="ddctapoptions" />
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>