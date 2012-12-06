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
    protected $pkgVersion = '1.1.6';

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
    }

    public function upgrade(){
        parent::upgrade();
        $pkg = Package::getByHandle('focus43');

        // ADD 'default' PAGE TYPE
        $dt = CollectionType::getByHandle('default'); // full page type
        if(!$dt || !intval($dt->getCollectionTypeID())){
            CollectionType::add(array('uID'=>1,'ctHandle'=>'default','ctName'=>'Default','ctIcon'=>'main.png'),$pkg);
        }

        // ADD 'work' PAGE TYPE
        $dt = CollectionType::getByHandle('work'); // full page type
        if(!$dt || !intval($dt->getCollectionTypeID())){
            CollectionType::add(array('uID'=>1,'ctHandle'=>'default','ctName'=>'Work','ctIcon'=>'main.png'),$pkg);
        }
    }

    public function install() {
        $pkg = parent::install();

        // install block
//        BlockType::installBlockTypeFromPackage('focus43', $pkg);

        // install theme
        PageTheme::add('focus_on_43', $pkg);

        // ADD 'default' PAGE TYPE
        $dt = CollectionType::getByHandle('default'); // full page type
        if(!$dt || !intval($dt->getCollectionTypeID())){
            CollectionType::add(array('uID'=>1,'ctHandle'=>'default','ctName'=>'Default','ctIcon'=>'main.png'),$pkg);
        }


        // ADD 'work' PAGE TYPE
        $dt = CollectionType::getByHandle('work'); // full page type
        if(!$dt || !intval($dt->getCollectionTypeID())){
            CollectionType::add(array('uID'=>1,'ctHandle'=>'default','ctName'=>'Work','ctIcon'=>'main.png'),$pkg);
        }
    }

}