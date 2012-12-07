<?php defined('C5_EXECUTE') or die(_("Access Denied."));

    Loader::library('validate_and_send_email', 'focus43');
    Loader::model('userinfo');

    $user = UserInfo::getByUserName($_REQUEST['username']);
    
    // Now actually use it
    $mailer = new ValidateAndSendEmail( $_REQUEST );
    
    $mailer->addRequired('name', 'Name is required.');
    $mailer->addRequired('email', 'Email address is required.');
    $mailer->addRequired('message', 'Message cannot be empty.');
    
    // note: we *don't* need to set the form body message because
    // the ValidateAndSendEmail message takes all the form inputs
    // and assembles it automatically
    $mailer->setSubject('Message from Focus43 website')
           ->setFrom('jon@circ.biz')
           ->setTo( $_REQUEST['send_to'] )
           ->sendEmail();
    
	$errorList = (array) $mailer->getError()->getList();
	
    // SETUP THE RESPONSE OBJECT
    $respObj        = new stdClass();
    $respObj->code  = (int)$mailer->sentOK();
	$respObj->messages = empty( $errorList ) ? array('Thanks for getting touch!') : $errorList;
    
     echo Loader::helper('json')->encode($respObj);
