<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */

	function __construct(){
		parent::__construct();
		set_time_limit(3000);
		$this->config->load('mail');
	}
	public function index(){
		show_error("Please show an data you want to list");
	}

	public function email(){
		/* connect to gmail with your credentials */
		/* try to connect */
		var_dump(
				$this->config->item('upload_email_hostname'),
				$this->config->item('upload_email_username'),
				$this->config->item('upload_email_password'),
				$this->config->item('upload_email_openmode')
				);
		$inbox = 
			@imap_open(
				$this->config->item('upload_email_hostname'),
				$this->config->item('upload_email_username'),
				$this->config->item('upload_email_password'),
				$this->config->item('upload_email_openmode'),
				3
				);
		if(!$inbox){
			return var_dump(imap_errors());
		}
 
 
		/* get all new emails. If set to 'ALL' instead 
		 * of 'NEW' retrieves all the emails, but can be 
		 * resource intensive, so the following variable, 
		 * $max_emails, puts the limit on the number of emails downloaded.
		 * 
		 */
		$emails = imap_search($inbox,'NEW');
 
		/* useful only if the above search is set to 'ALL' */
		$max_emails = 16;
		/* if any emails found, iterate through each email */
		if($emails){
			$count = 1;
 
			/* put the newest emails on top */
			rsort($emails);
 
			/* for every email... */
			foreach($emails as $email_number){
 
				/* get information specific to this email */
				$overview = imap_fetch_overview($inbox, $email_number, 0);

				$header = imap_fetchheader($inbox, $email_number, 0);
 
				/* get mail message, not actually used here. 
				Refer to http://php.net/manual/en/function.imap-fetchbody.php
				for details on the third parameter.
				*/
				$message = imap_fetchbody($inbox, $email_number, 2);

				/* get mail structure */
				$structure = imap_fetchstructure($inbox, $email_number);

				$attachments = array();

				var_dump(array("overview" => $overview, "header" => $header, "msg" => $message));
 
				/* if any attachments found... */
				// if(isset($structure->parts) && count($structure->parts)){
				// 	for($i = 0; $i < count($structure->parts); $i++){
				// 		$attachments[$i] = array(
				// 			'is_attachment' => false,
				// 			'filename' => '',
				// 			'name' => '',
				// 			'attachment' => ''
				// 		);
		 
				// 		if($structure->parts[$i]->ifdparameters){
				// 			foreach($structure->parts[$i]->dparameters as $object){
				// 				if(strtolower($object->attribute) == 'filename'){
				// 					$attachments[$i]['is_attachment'] = true;
				// 					$attachments[$i]['filename'] = $object->value;
				// 				}
				// 			}
				// 		}
		 
				// 		if($structure->parts[$i]->ifparameters){
				// 			foreach($structure->parts[$i]->parameters as $object){
				// 				if(strtolower($object->attribute) == 'name'){
				// 					$attachments[$i]['is_attachment'] = true;
				// 					$attachments[$i]['name'] = $object->value;
				// 				}
				// 			}
				// 		}
		 
				// 		if($attachments[$i]['is_attachment']){
				// 			$attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
				// 			if($structure->parts[$i]->encoding == 3){ /* 3 = BASE64 encoding */
				// 				$attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
				// 			}else if($structure->parts[$i]->encoding == 4){ /* 4 = QUOTED-PRINTABLE encoding */
				// 				$attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
				// 			}
				// 		}
				// 	}
				// }
 
				if($count++ >= $max_emails) break;
			}
 
		} 
 
		/* close the connection */
		imap_close($inbox);
 
		echo "Done";
	}
}

/* End of file get.php */
/* Location: ./application/controllers/get.php */