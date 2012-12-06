<?php defined('C5_EXECUTE') or die(_("Access Denied."));

    Loader::library('validate_and_send_email', 'circ');
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
    $mailer->setSubject('Message from your circ.biz profile page')
           ->setFrom('jon@circ.biz')
           ->setTo( $user->getUserEmail() )
           ->sendEmail();
    
    // SETUP THE RESPONSE OBJECT
    $respObj        = new stdClass();
    $respObj->code  = (int)$mailer->sentOK();
    $respObj->error = (array)$mailer->getError()->getList();
    $respObj->msg   = (bool)$mailer->sentOK() ? 
                        'Thanks for getting in touch!' : 
                        implode('<br />', $mailer->getError()->getList());
    
    echo Loader::helper('json')->encode($respObj);
