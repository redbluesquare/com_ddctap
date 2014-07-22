<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 *
 * @author Darryl
 *        
 */
class DdcbookitControllersBook extends JControllerBase {
	
	private $data = Null;
	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$table = $app->input->get('table',null);
		
		if($table=='booking')
		{
			$modelName  = $app->input->get('models', 'booking');
			$modelName  = 'DdcbookitModels'.ucwords($modelName);
			$model = new $modelName();
			
			if( $row = $model->storebooking() )
			{
				$sent = false;
				$sent = $this->_sendEmail();
				$return['success'] = true;
				$msg = JText::_('COM_DDCBOOKIT_SAVE_SUCCESS');
			//	$link=  JRoute::_('index.php?option=com_ddcbookit&view=apartments&layout=booksummary',FALSE);	
			//	$app->redirect($link,true);
			}
			else{
				$return['msg'] = JText::_('COM_DDCBOOKIT_SAVE_FAILURE');
				
				//$link=  JRoute::_('index.php?option=com_ddcbookit&view=apartments&layout=apartmentbook&apartment_id='.$app->input->get('apartment_id',null),FALSE);
				//$app->redirect($link,$return['msg']);
			}
			return true;
		}
		echo json_encode($return);
	}
	
	private function _sendEmail()
	{
		//get the new booking posted by function storebooking()
  	$modelBooking = new DdcbookitModelsBooking();
  	$this->booking = $modelBooking->getItem();
  	$booking_id = (string)$this->ddcbookit_bookings_id;
  	$contact_name = (string)$this->booking->contact_name;
  	$contact_email = (string)$this->booking->contact_email;
  	$contact_tel = (string)$this->booking->contact_tel;
  	$residence_name = (string)$this->booking->residence_name;
  	$proptype_title = (string)$this->booking->proptype_title;
  	$num_adults = (string)$this->booking->num_adults;
  	$num_kids = (string)$this->booking->num_kids;
  	$checkin = (string)JHtml::date($this->booking->checkin,'d-M-Y');
  	$checkout = (string)JHtml::date($this->booking->checkout,'d-M-Y');
  	$address1 = (string)$this->booking->address1;
  	$town = (string)$this->booking->town;
  	$post_code = (string)$this->booking->post_code;
  	$booked_price = (string)number_format($this->booking->booked_price,2);
  	
  	$sitetitle = JFactory::getApplication()->getCfg('sitename');
  	$message = <<<EOT
  	<div style="width:800px; box-shadow:#ccc 0px 0px 5px;">
  		<div style="background:#163bb2;display:block;width:770px;color:#cfcfcf;padding:2px 10px 1px 20px;">
  			<h1 style="float:left;">$sitetitle</h1>
  			<p style="float:right;"><span>Booking number: </span><span>$booking_id</span></p>
  			<div style="clear:both;"></div>
  		</div>
		<div style="background:#ffffff;display:block;padding:10px;"><h2>Booking Summary</h2><hr />
			<table class="table borderless"><tbody>
			<tr><td class="span3" style="text-align:right;font-weight:bold;">Contact Name: </td><td class="span9">$contact_name</td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Contact E-mail: </td><td>$contact_email</td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Contact Telephone: </td><td>$contact_tel</td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Apartment: </td><td><span style="font-weight:bold;font-size:1.3em;color:#990099">$residence_name</span><br />$proptype_title</td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Address: </td><td>$address1<br />$town<br />$post_code<br /></td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Number of Guests: </td><td>$num_adults adults and $num_kids kids</td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Duration: </td><td><span class="price_green\">$checkin</span> to <span class="price_green">$checkout</span> ($days nights)</td></tr>
  			<tr><td style="text-align:right;font-weight:bold;">Price: </td><td>&pound; $booked_price</td></tr>
  			</tbody>
  			</table>
			<p>Here are all the terms and conditions of staying in an apartment when booking with Euracom.</p>
		</div>
		<div style="background:#163bb2;display:block;min-height:20px;padding:10px;">
			<p style="float:right;color:#ffffff\"><a style="color:#ffffff;text-decoration:none;" href="http:\\www.euracomapartments.co.uk">Euracom Apartments date('Y')</a></p><div style="clear:both;">
		</div>
	</div>
EOT;

		$app = JFactory::getApplication();
		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');
		$sitename	= $app->getCfg('sitename');
	
		$name		= $booking->contact_name;
		$email		= JStringPunycode::emailToPunycode($contact_email);
		$subject	= "Booking made today";
		$body		= "Booking message sent to e-mail address";
	
		// Prepare email body
		$prefix = JText::sprintf('COM_CONTACT_ENQUIRY_TEXT', JUri::base());
		$body	= $prefix."\n".$name.' <'.$email.'>'."\r\n\r\n".stripslashes($body);
	
		$mail = JFactory::getMailer();
		$mail->addRecipient($contact_email);
		$mail->addReplyTo(array($email, $name));
		$mail->setSender(array($mailfrom, $fromname));
		$mail->setSubject($sitename.': '.$subject);
		$mail->isHTML(true);
		$mail->Encoding = 'base64';
		$mail->setBody($message);
		$sent = $mail->Send();
		return $sent;
	}
		
}
