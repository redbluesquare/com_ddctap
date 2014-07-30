<?php
defined ( '_JEXEC' ) or die ( 'Restricted access' );

/**
 *
 * @author Darryl
 *        
 */
class DdctapControllersAdd extends JControllerBase {
	
	private $data = Null;
	
	public function execute() {
		
		$app = JFactory::getApplication ();
		$return = array ("success" => false	);
		$data = $data ? $data : JRequest::getVar('jform', 'post');
		
		if($data['table']=='holidayplanner')
		{
			$modelName  = $app->input->get('models', 'holidays');
			$view       = $app->input->get('view', 'department');
			$layout     = $app->input->get('layout', '_entry');
			$item       = $app->input->get('item', 'proptype');
			$modelName  = 'DdctapModels'.ucwords($modelName);
			
			$model = new $modelName();
			
			if ( $row = $model->storeHolReq() )
			{
				
				$sent = false;
				$sent = $this->_sendEmail();
				$return['success'] = true;
				$return['msg'] = JText::_('COM_DDCBOOKIT_SAVE_SUCCESS');
				
			}else{
				$return['msg'] = JText::_('COM_DDCBOOKIT_SAVE_FAILURE');
			}
		}
		
		echo json_encode($return);
	}
	
	private function _sendEmail()
	{
		$params = JComponentHelper::getParams('com_ddctap');
		$approval = $params->get('approval');
		
		//get the new booking posted by function storebooking()
		$modelHoliday = new DdctapModelsHolidays();
		$this->request = $modelHoliday->getItem();
		$holiday_id = (string)$this->request->ddctap_holiday_id;
		$contact_email = (string)DdctapModelsHolidays::getApprover()->email;

		 
		$sitetitle = JFactory::getApplication()->getCfg('sitename');
		$message = 'A new booking posted at <a href="'.JRoute::_('index.php&option=com_ddctap&views=department$layout=default&holiday_id='.$holiday_id).'">Click to View</a>';;
	
		$app = JFactory::getApplication();
		$mailfrom	= $app->getCfg('mailfrom');
		$fromname	= $app->getCfg('fromname');
		$sitename	= $app->getCfg('sitename');
	
		$name		= $approval;
		$email		= JStringPunycode::emailToPunycode($contact_email);
		$subject	= "Requestfor Holiday";
	
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
