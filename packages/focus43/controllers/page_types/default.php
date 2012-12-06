<?php defined('C5_EXECUTE') or die(_("Access Denied."));

    class DefaultPageTypeController extends Controller {

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
//            $this->addHeaderItem($htmlHelper->javascript('form.js','focus43'));

//            $this->addFooterItem($htmlHelper->javascript('jquery-1.8.1.min.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('google-code-prettify/prettify.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap.min.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap-modal.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap-popover.js','focus43'));
            $this->addFooterItem($htmlHelper->javascript('bootstrap/bootstrap-transition.js','focus43'));

            $this->addFooterItem($htmlHelper->javascript('global.js','focus43'));

            // create a list of team members for the team list
            $userList = new UserList();
            $userList->sortBy('uName', 'asc');
            $teamMembers = $userList->filterByGroup('team');
            $this->set('teamMembers', $userList->get());


        }

    }

?>