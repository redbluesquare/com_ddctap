<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

?>

<?php 
$apartment_remove = array();
$app = JFactory::getApplication();
$session = JFactory::getSession();
$this->_ppl = $app->input->get('ppl',null);
if($app->input->get('datecheckin',null)==null){
	$this->_checkin = $session->get('checkin');
}else{$this->_checkin = $app->input->get('datecheckin',null);}
if($app->input->get('datecheckout',null)==null){
	$this->_checkout = $session->get('checkout');
}else{$this->_checkout = $app->input->get('datecheckout',null);}
if($app->input->get('location',null)==null){
	$this->_location = $session->get('location');
}else{$this->_location = $app->input->get('location',null);}
if($app->input->get('proptype',null)==null){
	$this->_proptype = $session->get('proptype');
}else{$this->_proptype = $app->input->get('proptype',null);}
$checkin = date_create($this->_checkin);
$checkout = date_create($this->_checkout);
$interval = date_diff($checkin, $checkout);
$stayindays = $interval->format('%a');
$residence_remove = array();

$totalapartments = count($this->apartments);
foreach($this->apartments as $apartment):
	if(!in_array($apartment->res_id,$residence_remove)):
	if(DdcbookitModelsDefault::checkmybooking($apartment->ddcbookit_apartments_id, $this->_checkin, $this->_checkout)!=null){
		array_push($apartment_remove,DdcbookitModelsDefault::checkmybooking($apartment->ddcbookit_apartments_id, $this->_checkin, $this->_checkout));
	}
	else{
		$pc = explode(' ',$apartment->post_code);
		$pc1 = trim($pc[0]);
		if($stayindays==0){$stayindays=$apartment->min_stay;}
		array_push($residence_remove,$apartment->res_id);}
?>
	<div class="row-fluid" id="residenceEntry">
		<div class="span10">
			<a style="text-decoration:none;" href="index.php?option=com_ddcbookit&view=apartments&layout=apartments&residence_id=<?php echo $apartment->res_id;?>">
				<img class="img-rounded pull-left" src="<?php echo JRoute::_($apartment->image_thumb); ?>" width="120px" hspace="8" vspace="10" />
			</a>
			<h3 style="line-height:20px;">
			<a style="text-decoration:none;" href="index.php?option=com_ddcbookit&view=apartments&layout=apartments&residence_id=<?php echo $this->residence[0]->ddcbookit_residence_id;?>">
				<?php echo strtoupper($apartment->res_name).' - '.strtoupper($apartment->town).' '.$pc1; ?>
			</a>
			</h3>
			<p>
				<?php echo 'Apartment Type: '.$apartment->pt.'<br />Max Guests: '.$apartment->ppl; ?>
			</p>
		</div>
		<div class="span2 pull-right">
			<p class="std_apartment_price"><?php echo 'Price for '.$stayindays.' nights<br/>';?><span><?php echo '&pound; '; ?><?php echo number_format(($stayindays*$apartment->price),2); ?></span></p>
			<?php if($this->_checkin!=null):?>
				<a href="<?php echo JRoute::_('index.php?option=com_ddcbookit&view=apartments&layout=apartmentbook&apartment_id='.$apartment->ddcbookit_apartments_id); ?>" class="btn btn-primary pull-right"><?php echo JText::_('COM_DDCBOOKIT_CLICK_TO_BOOK');?></a>
			<?php endif; ?>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php endif; ?>
<?php endforeach;?>


