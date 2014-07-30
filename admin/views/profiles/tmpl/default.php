<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
// load tooltip behavior
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_ddctap&controller=profiles'); ?>" method="post" name="adminForm" id="adminForm">
        <table class="adminlist">
                <thead>
                	<tr>
                		<th width="3%"><?php echo JText::_('COM_DDCTAP_ID'); ?></th>
        				<th width="10%"><?php echo JText::_('COM_DDCTAP_NAME'); ?></th>
						<th width="10%"><?php echo JText::_('COM_DDCTAP_USERNAME'); ?></th>
						<th width="10%"><?php echo JText::_('COM_DDCTAP_JOBTITLE'); ?></th>
						<th width="10%"><?php echo JText::_('COM_DDCTAP_START_TIME'); ?></th>
						<th width="10%"><?php echo JText::_('COM_DDCTAP_FINISH_TIME'); ?></th>
					</tr>
                </thead>
                <tfoot>

                </tfoot>
                <tbody>
                <?php foreach($this->items as $i => $item): ?>
        			<tr class="row<?php echo $i % 2; ?>">
                		<td>
                	        <?php echo $item->user_id; ?>
                		</td>
                		<td>
                	        <a href="<?php echo JRoute::_('index.php?option=com_ddctap&view=profiles&layout=edit&user_id='.$item->id); ?>"><?php echo $item->name; ?></a>
                		</td>
                		<td style="text-align: center;">
                	        <?php echo $item->username; ?>
                		</td>
                		<td>
                			<?php echo $item->jt; ?>
                		</td>
                		<td>
                			<?php echo $item->starttime; ?>
                		</td>
                		<td>
                			<?php echo $item->finishtime; ?>
                		</td>
        			</tr>
				<?php endforeach; ?>
                </tbody>
        </table>
        
        <div>
                <input type="hidden" name="jform[table]" value="profiles" />
                <input type="hidden" name="task" value="" />
                <input type="hidden" name="boxchecked" value="0" />
                <?php echo JHtml::_('form.token'); ?>
        </div>
</form>