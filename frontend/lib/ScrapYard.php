<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:09 PM
 */
class ScrapYard extends ApiFrontend {
    function init() {
        parent::init();


        $this->pathfinder->addLocation(array(
            //'addons'=>array('../atk4-addons','../addons','../vendor'),
            'php'=>array('../shared'),
            //'template' => array(
            //    '../addons/romaninsh/menu/template',
            //),
        ))->setBasePath($this->pathfinder->base_location->getPath());


        $this->dbConnect();
        $this->add('jUI');

        $this->setLayout();
        $this->addMenu();
        $this->addAuth();
        $this->auth->check();
    }

    private function setLayout() {
        $this->layout = $this->add('Layout_Basic');
    }
    private function addMenu() {
        $menu = $this->layout->add('Menu',null,'Main_Menu');
        $menu->addMenuItem('','Home');
        $menu->addMenuItem('users','Users');
        $menu->addMenuItem('scrap','Scrap');
    }
    private function addAuth() {
        $this->add('Auth');
        $this->auth->usePasswordEncryption('sha256/salt')
            ->setModel('Model_User', 'email', 'password')
        ;
        //$this->api->auth->add('auth/Controller_Cookie');
    }
}