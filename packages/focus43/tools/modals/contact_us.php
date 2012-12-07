<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<form id="test" data-method="ajax" data-show-feedback="true" action="<?php echo F43_PACKAGE_TOOLS; ?>email_team_member">
<?php
    echo Loader::helper('form')->hidden('send_to', $_REQUEST['send_to']);
    echo Loader::helper('form')->text('name', '', array('placeholder'=> 'Name'));
    echo Loader::helper('form')->email('email', '', array('placeholder'=> 'Email'));
    echo Loader::helper('form')->textarea('message', '', array('placeholder'=> 'Message'));
    echo Loader::helper('form')->submit('submit', 'Send');
?>
</form>