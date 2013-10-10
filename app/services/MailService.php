<?php
	class MailService{
		//ADMIN_EMAIL: sender
		//SITE_EMAIL: receiver
		//ADMIN_EMAIL_PASSWD: password email of sender
		public static function sendEmail($data,$from)
	    {
	        $connmail = new Zend_Mail_Transport_Smtp (
	                'smtp.gmail.com',
	                array ( 'auth' => 'login',
	                        'username' => ADMIN_EMAIL,
	                        'password' => ADMIN_EMAIL_PASSWD,
	                        'ssl' => 'ssl',
	                        'port' => 465 )
	                );
	
	        Zend_Mail::setDefaultTransport ( $connmail );
	        $mail = new Zend_Mail ( 'UTF-8' );
	        $mail->setBodyHtml ( $data );
	        $mail->addTo ( SITE_EMAIL );
	        $mail->setSubject ( 'Contact from websites: '.$from );
	        $mail->setFrom ( ADMIN_EMAIL,'WEB MASTER' );
	        $mail->setDefaultReplyTo($from);
	                try{
	                        $mail->send ();
	                        return 1;
	                }catch (Zend_Mail_Exception $e) {
	                    die($e);
	                        return 0;
	                }
	    }
	}