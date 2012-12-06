<?php
/**
 * Created by JetBrains PhpStorm.
 * User: superrunt
 * Date: 11/29/12
 * Time: 3:18 PM
 * To change this template use File | Settings | File Templates.
 */

defined('C5_EXECUTE') or die(_("Access Denied."));

class Focus43Package extends Package {

    protected $pkgHandle = 'focus43';
    protected $appVersionRequired = '5.6.0.2';
    protected $pkgVersion = '1.1.9';

    public function getPackageDescription() {
        return t("Focus43 company site.");
    }

    public function getPackageName() {
        return t("Focus43");
    }

    public function on_start(){
        $uh = Loader::helper('concrete/urls');

        define('F43_PACKAGE_ROOT',$uh->getPackageURL(Package::getByHandle('focus43')).'/');
        define('F43_PACKAGE_TOOLS',BASE_URL.$uh->getToolsURL('','focus43'));
        define('F43_PACKAGE_IMAGES_DIR', DIR_REL.'/packages/focus43/images/' );
		
		$this->registerAutoloadClasses();
    }
	
	
	private function registerAutoloadClasses(){
		Loader::registerAutoload(array(
			'BasePageTypeController' => array('library', 'base_page_type_controller', $this->pkgHandle)
		));
	}
	
	
	/**
	 * Get the package object; if it hasn't been instantiated yet, load it.
	 * @return Package
	 */
	private function packageObject(){
		if( !($this->_packageObj instanceof Package) ){
			$this->_packageObj = Package::getByHandle( $this->pkgHandle );
		}
		return $this->_packageObj;
	}
	
	
	/**
	 * Get an attribute key category object (eg: an entity category) by its handle
	 * @return AttributeKeyCategory
	 */
	private function attributeKeyCategory( $handle ){
		if( !($this->{$handle.'_akc'} instanceof AttributeKeyCategory) ){
			$this->{$handle.'_akc'} = AttributeKeyCategory::getByHandle( $handle );
		}
		return $this->{$handle.'_akc'};
	}


	/**
	 * Easy way to access different attribute types during setup. This will make it so that a call
	 * to AttributeType::getByHandle will only be used once; and it'll 'cache' all the attribute types
	 * for access at a later point in the script
	 * @return AttributeType
	 */
	private function attributeType( $typeHandle ){
		if( $this->{"_at_{$typeHandle}"} === null ){
			$this->{"_at_{$typeHandle}"} = AttributeType::getByHandle( $typeHandle );
		}
		return $this->{"_at_{$typeHandle}"};
	}

    
	public function upgrade(){
        parent::upgrade();
        $this->installAndUpdate();
    }
    

    public function install() {
        parent::install();   
        $this->installAndUpdate();
    }
	
	
	public function installAndUpdate(){
		$this->setupThemeAndPageTypes();
		$this->setupGroups();
		$this->setupUserAttributes();
	}
	
	
	private function setupThemeAndPageTypes(){
		// INSTALL THE THEME
        try {
            PageTheme::add('focus_on_43', $this->packageObject());
        }catch(Exception $e){ /* do nothing, just continue... */ }
		
		// setup page types
		if( !(CollectionType::getByHandle('default') instanceof CollectionType) ){
			CollectionType::add(array(
				'uID'		=> 1,
				'ctHandle'	=> 'default',
				'ctName'	=> 'Default',
				'ctIcon'	=> 'main.png'
			), $this->packageObject());
		}
		
		
		if( !(CollectionType::getByHandle('work') instanceof CollectionType) ){
			CollectionType::add(array(
				'uID'		=> 1,
				'ctHandle'	=> 'work',
				'ctName'	=> 'Work',
				'ctIcon'	=> 'main.png'
			), $this->packageObject());
		}
		
	}
	
	
	private function setupGroups(){
		try {
			Group::add('Team', 'Focus43 Team Members');
		}catch(Exception $e){ /* continue gracefully */ }
		
	}
	
	
	private function setupUserAttributes(){
		// attribute set
		$teamDisplaySet = AttributeSet::getByHandle('team_display');
		if( !is_object($teamDisplaySet) ){
			$this->attributeKeyCategory('user')->setAllowAttributeSets( AttributeKeyCategory::ASET_ALLOW_SINGLE );
			$teamDisplaySet = $this->attributeKeyCategory('user')->addSet('team_display', t('Team Display'), $this->packageObject());
		}
		
		// full name
		if( !(is_object(UserAttributeKey::getByHandle('full_name'))) ){
			UserAttributeKey::add($this->attributeType('text'), array(
				'akHandle'	=> 'full_name', 
				'akName'	=> t('Full Name')
			), $this->packageObject())->setAttributeSet($teamDisplaySet);
		}
		
		// linkedin
		if( !(is_object(UserAttributeKey::getByHandle('linkedin'))) ){
			UserAttributeKey::add($this->attributeType('text'), array(
				'akHandle'	=> 'linkedin', 
				'akName'	=> t('Linked In')
			), $this->packageObject())->setAttributeSet($teamDisplaySet);
		}
	}

}