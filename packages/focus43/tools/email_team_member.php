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
    
    // SETUP THE RESPONSE OBJECT
    $respObj        = new stdClass();
    $respObj->code  = (int)$mailer->sentOK();
    $respObj->error = (array)$mailer->getError()->getList();
    $respObj->msg   = (bool)$mailer->sentOK() ? 
                        'Thanks for getting in touch!' : 
                        implode('<br />', $mailer->getError()->getList());
    
     echo Loader::helper('json')->encode($respObj);

    ?>

<script type="text/javascript">
//    $.ajax({
//        type: "POST",
//        url: "process.php",
//        data: dataString,
//        success: function() {
//            $('#contact_form').html("<div id='message'></div>");
//            $('#message').html("<h2>Contact Form Submitted!</h2>")
//                    .append("<p>We will be in touch soon.</p>")
//                    .hide()
//                    .fadeIn(1500, function() {
//                        $('#message').append("<img id='checkmark' src='images/check.png' />");
//                    });
//        }
//    });
</script>