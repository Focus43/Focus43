<?php

	class BasePageTypeController extends Controller {
		
		
		const PACKAGE_HANDLE = 'focus43';
		
		
		public function on_start(){
			$this->addHeaderItem( $this->getHelper('html')->css('bootstrap.css', self::PACKAGE_HANDLE) );
			$this->addHeaderItem( $this->getHelper('html')->css('bootstrap-responsive.css', self::PACKAGE_HANDLE) );
			$this->addHeaderItem( $this->getHelper('html')->css('global.css', self::PACKAGE_HANDLE) );
			
			//$this->addFooterItem( $this->getHelper('html')->javascript('google-code-prettify/prettify.js', self::PACKAGE_HANDLE) );
			$this->addFooterItem( $this->getHelper('html')->javascript('bootstrap/bootstrap.min.js', self::PACKAGE_HANDLE) );
			//$this->addFooterItem( $this->getHelper('html')->javascript('bootstrap/bootstrap-modal.js', self::PACKAGE_HANDLE) );
			$this->addFooterItem( $this->getHelper('html')->javascript('bootstrap/bootstrap-popover.js', self::PACKAGE_HANDLE) );
			$this->addFooterItem( $this->getHelper('html')->javascript('bootstrap/bootstrap-transition.js', self::PACKAGE_HANDLE) );
			$this->addFooterItem( $this->getHelper('html')->javascript('global.js', self::PACKAGE_HANDLE) );
		}
		
		
		/**
		 * @return Permissions
		 */
		public function pagePermissions(){
			if( $this->_pagePermissions == null ){
				$this->_pagePermissions = new Permissions( $this->getCollectionObject() );
			}
			return $this->_pagePermissions;
		}
		
		
		/**
		 * @return User
		 */
		public function userObj(){
			if( $this->_userObj == null ){
				$this->_userObj = new User();
			}
			return $this->_userObj;
		}
		
		
		/**
		 * @return ...Helper
		 */
		public function getHelper( $handle, $pkg = false ){
			if( $this->{'_' . $handle} == null ){
				$this->{'_' . $handle} = Loader::helper( $handle, $pkg );
			}
			return $this->{'_' . $handle};
		}
		
	}
