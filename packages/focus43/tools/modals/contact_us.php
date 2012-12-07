<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

    <form id="email" data-method="ajax" data-show-feedback="true" action="<?php echo F43_PACKAGE_TOOLS; ?>email_team_member">
        <fieldset>
            <legend>Send an email</legend>


            <?php
            echo Loader::helper('form')->hidden('send_to', $_REQUEST['send_to']);
            echo "<br>";
            echo Loader::helper('form')->text('name', '', array('placeholder'=> 'Name', 'class'=>'span4'));
            echo "<br>";
            echo Loader::helper('form')->email('email', '', array('placeholder'=> 'Email', 'class'=>'span4'));
            echo "<br>";
            echo Loader::helper('form')->textarea('message', '', array('placeholder'=> 'Message', 'class'=>'span4'));
            echo "<br>";
            echo Loader::helper('form')->submit('submit', 'Send', array(), 'btn');
            ?>

        </fieldset>
    </form>


