<div class="media span12">
  <img class="pull-left" src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($this->profile->email))); ?>?s=60" style="margin:10px;" />
  <div class="media-body">
    <h4 class="media-heading"><?php echo $this->profile->name; ?>
    <?php if($this->profile->id == JFactory::getUser()->id) { ?>
                 <a href="#editProfileModal" class="btn pull-right" data-toggle="modal" role="button" id="editButton"><?php echo JText::_('COM_DEVCLOUD_PROFILE_EDIT'); ?></a>
                <?php } ?></h4>
  </div>
</div>
<div class="well span12">
	<dl class="dl-horizontal">
		<dt><?php echo JText::_('COM_DEVCLOUD_LEAD_PROFILE_EMAIL').': '; ?></dt><dd><?php echo $this->profile->email; ?></dd>
		<?php if($this->profile->telephone!=NULL): ?><dt><?php echo JText::_('COM_DEVCLOUD_LEAD_PROFILE_TELEPHONE').': '; ?></dt><dd><?php echo $this->profile->telephone; ?></dd><?php endif ?>
		<?php if($this->profile->address!=NULL): ?><dt><?php echo JText::_('COM_DEVCLOUD_LEAD_PROFILE_ADDRESS1').': '; ?></dt><dd><?php echo $this->profile->address.' '; ?></dd><?php endif ?>
		<?php if($this->profile->suburb!=NULL): ?><dt><?php echo JText::_('COM_DEVCLOUD_LEAD_PROFILE_SUBURB').': '; ?></dt><dd><?php echo $this->profile->suburb; ?></dd><?php endif ?>
		<?php if($this->profile->postcode!=NULL): ?><dt><?php echo JText::_('COM_DEVCLOUD_LEAD_PROFILE_POSTCODE').': '; ?></dt><dd><?php echo $this->profile->postcode; ?></dd><?php endif ?>
	</dl>
</div>
<div class="well span12">
<strong><?php echo JText::_('COM_DEVCLOUD_PROJECTS_TOTAL'); ?></strong>:<br />
<table class="table table-striped font-small">
	<thead  style="color:white;">
		<tr>
			<th><?php echo JText::_('COM_DEVCLOUD_LEAD_PROJECT_TITLE'); ?></th>
			<th><?php echo JText::_('COM_DEVCLOUD_LEAD_DUE_DATE'); ?></th>
			<th><?php echo JText::_('COM_DEVCLOUD_LEAD_NO_OF_QUOTES'); ?></th>
		</tr>
	</thead>
	<tbody>	
<?php
	
	//for($i=0, $n = count($this->leads);$i<$n;$i++)
	//{
	//	$this->_leadListView->lead = $this->leads[$i];
	//	$this->_leadListView->type = 'leads';
	//	echo $this->_leadListView->render();
    //} 
?>

</tbody>
</table>
<p><?php echo JText::_('COM_DEVCLOUD_TOTAL_LISTINGS').': '; ?><?php //print_r($this->leads)?></p>
</div>

<?php echo $this->_editProfileView->render(); ?>