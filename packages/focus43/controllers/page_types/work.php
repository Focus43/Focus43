<?php
/**
 * Created by JetBrains PhpStorm.
 * User: superrunt
 * Date: 12/5/12
 * Time: 1:04 PM
 * To change this template use File | Settings | File Templates.
 */

defined('C5_EXECUTE') or die(_("Access Denied."));

    class WorkPageTypeController extends Controller {

        public function on_start(){
            // PERMISSIONS
            $this->set('p', new Permissions( Page::getCurrentPage() ) );

            // HELPERS
            $htmlHelper = Loader::helper('html');

            // STYLESHEETS
            $this->addHeaderItem($htmlHelper->css('bootstrap.css','focus43'));
            $this->addHeaderItem($htmlHelper->css('bootstrap-responsive.css','focus43'));
            $this->addHeaderItem($htmlHelper->css('global.css','focus43'));

            // JAVASCRIPT
            $this->addFooterItem($htmlHelper->javascript('google-code-prettify/prettify.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap.min.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap-modal.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap-popover.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap-transition.js','focus43'));

            $this->addFooterItem($htmlHelper->javascript('global.js','focus43'));

        }

    }

?>