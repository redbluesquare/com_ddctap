<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 *
 * @author Darryl
 *        
 */
class DdctapControllersHoliday extends JControllerBase {
	
	private $data = Null;
	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$table = $app->input->get('table',null);
		
		if($table=='holidayplanner')
		{
			$modelName  = $app->input->get('models', 'holidays');
			$modelName  = 'DdctapModels'.ucwords($modelName);
			$model = new $modelName();
			
			if( $row = $model->store() )
			{

				$return['success'] = true;
				$msg = JText::_('COM_DDCBOOKIT_SAVE_SUCCESS');
				$link=  JRoute::_('index.php?option=com_ddctap&view=holidays&layout=status',FALSE);	
				$app->redirect($link,true);
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
		$params = JComponentHelper::getParams('com_ddctap');
		$approval = $params->get('approval');
		
		//get the new booking posted by function storeholiday()
		$modelHoliday = new DdctapModelsHolidays();
		$this->request = $modelHoliday->getItem();
		$holiday_id = (string)$this->request->ddctap_holiday_id;
		$contact_email = (string)DdctapModelsHolidays::getApprover()->email;
			
		$sitetitle = JFactory::getApplication()->getCfg('sitename');
		$message = 'A new booking posted at <a href="'.JRoute::_('index.php&option=com_ddctap&views=holidays&layout=approveholiday&holiday_id='.$holiday_id).'">Click to View</a>';
		
		$app = JFactory::getApplication();
		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');
		$sitename	= $app->getCfg('sitename');
	
		$name		= $booking->contact_name;
		$email		= JStringPunycode::emailToPunycode($contact_email);
		$subject	= "Booking made today";
	
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
