<?php

//Require object class
require_once(O3_CMS_DIR.'/classes/o3_cms_objects.php');

//Require define class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_helper.php');

/**
 * O3 Snafer Email sending class
 *
 * @package o3 cms
 * @link    todo: add url
 * @author  Zotlan Fischer <zlf@web2it.dk>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

//Send emails from email address
snafer_helper::def('SNAFER_EMAIL_FROM', 'Snafer <no-reply@'.$_SERVER['HTTP_HOST'].'>');

//Email queue expiration in days
snafer_helper::def('SNAFER_EMAIL_QUEUE_DAYS',180);

//Email queue expiration in seconds
snafer_helper::def('SNAFER_EMAIL_QUEUE_SEC',SNAFER_EMAIL_QUEUE_DAYS * 24 * 3600);

//Email queue cleaning percent - default: 1
snafer_helper::def('SNAFER_EMAIL_QUEUE_CLEAN_USE_PERCENT',1);

class snafer_emails extends o3_cms_objects {

	/*
	* Use as a constructor
	*/
	public function init() {
		//load email module
		$this->o3->module( 'email' );
		$this->o3->load();
	}

	/*
	* Table name where are the objects
	*/
	public function tablename_index() {
		return 'snafer_email_queue';
	}

	/**
	* Add an email to send queue
	*
	* @return Boolean
	*/
	public function send( $to, $subject, $message, $priority = 0, $cc = '', $bcc = '', $from = SNAFER_EMAIL_FROM ) {
		
		//insert into queue
		$this->o3->mysqli->insert( $this->tablename(), array(
				'from' => $from,
				'to' => $to,
				'cc' => $cc,
				'bcc' => $bcc,
				'subject' => $subject,
				'message' => $message,
				'priority' => $priority
			) );
		$id = $this->o3->mysqli->insert_id;

		if ( $id > 0 && $priority == 0 )
			$this->send_by_id( $id );		

		//delete old requests
		if ( SNAFER_EMAIL_QUEUE_CLEAN_USE_PERCENT > 0 && rand(1,100) <= SNAFER_EMAIL_QUEUE_CLEAN_USE_PERCENT ) {
			$this->o3->debug->_('Clearing old password reset request');
			
			$datetime = date('Y-m-d H:i:s', time() - SNAFER_EMAIL_QUEUE_SEC );
			$sql = 'DELETE FROM '.$this->tablename().' WHERE created < "'.$datetime.'"';
			$this->o3->mysqli->query( $sql );
		}

		
		return $id > 0;
	}

	/**
	* Send an email from the queue
	*
	* @return Boolean
	*/
	public function send_by_id( $id ) {
		$return = false;
		$email = $this->get_by_id( $id );
		if ( $email !== false ) {
			$return = $this->sendto( $email->to, $email->subject, $email->message, $email->cc, $email->bcc, $email->from );

			//set sent
			if ( $return )
				$this->update( array( 'sent' => date('Y-m-d H:i:s') ), array( 'id' => $email->id ) );
		}
		return $return;
	}

	/**
	* Send an email
	*
	* @return Boolean
	*/
	public function sendto( $to, $subject, $message, $cc = '', $bcc = '', $from = SNAFER_EMAIL_FROM ) {

		//Send email
		$email_data = new o3_email_data( $to );		
		$email_data->from = $from;				
		$email_data->cc = $cc;				
		$email_data->bcc = $bcc;
		$email_data->subject = $subject;
		$email_data->styles = file_get_contents( O3_CMS_THEME_DIR.'/res/email/email.css' );
		$email_data->message = file_get_contents( O3_CMS_THEME_DIR.'/res/email/email.html' );
		$email_data->add_replace( '{SUBJECT}', $subject );
		$email_data->add_replace( '{MESSAGE}', $message );
		$email_data->add_replace( '{TO}', $to );
		$email_data->add_replace( '{URL_CONTACT_PAGE}', o3_get_host().$this->o3_cms->page_url( CONTACT_PAGE_ID ) );
		$email_data->add_replace( '{URL_TERMS_PAGE}', o3_get_host().$this->o3_cms->page_url( TERMS_PAGE_ID ) );
		$email_data->add_replace( '/res/', o3_get_host().'/res/' );
		return $this->o3->email->send( $email_data );

	}

}

?>