<?php defined('C5_EXECUTE') or die(_("Access Denied."));

    class DefaultPageTypeController extends BasePageTypeController {

        public function on_start(){
        	parent::on_start();

            // create a list of team members for the team list
            $userList = new UserList();
            $userList->sortBy('uName', 'asc');
			if( $this->group('Team') instanceof Group ){
				$userList->filterByGroupID( $this->group('Team')->getGroupID() );
			}
            $this->set('teamMembers', $userList->get());
        }
		
		
		/**
		 * @return Group || null
		 */
		private function group( $name ){
			if( $this->{'_group_'.$name} == null ){
				$this->{'_group_'.$name} = Group::getByName($name);
			}
			return $this->{'_group_'.$name};
		}
		
    }

