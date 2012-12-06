<?php defined('C5_EXECUTE') or die(_("Access Denied."));

    Loader::library('validate_and_send_email', 'circ');
    
    $mailer = new ValidateAndSendEmail( $_REQUEST );
    
    // validation
    $mailer->addRequired('fName', 'First name is required.');
    $mailer->addRequired('lName', 'Last name is required.');
    $mailer->addRequiredEmail('email', 'Valid email address is required.');
    $mailer->addRequired('message', 'Uh oh, you forgot to type a message.');
    
    $mailer->setSubject('Message from circ.biz "talk to us" form')
           ->setFrom('jon@circ.biz')
           ->setTo('info@circ.biz')
           ->sendEmail();
    
    // SETUP THE RESPONSE OBJECT
    $respObj        = new stdClass();
    $respObj->code  = (int)$mailer->sentOK();
    $respObj->error = (array)$mailer->getError()->getList();
    $respObj->msg   = (bool)$mailer->sentOK() ? 
                        'Thanks for getting in touch!' : 
                        implode('<br />', $mailer->getError()->getList());
    
    echo Loader::helper('json')->encode($respObj);
