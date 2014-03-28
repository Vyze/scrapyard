<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:09 PM
 */
class ScrapYard extends ApiFrontend {
    function init() {
        parent::init();
        try {
            $this->build = exec('git rev-list --count HEAD');
        } catch (Exeption $e) {
            $this->build = 'No git';
        }


        $this->pathfinder->addLocation(array(
            //'addons'=>array('../atk4-addons','../addons','../vendor'),
            'php'=>array('../shared'),
            //'template' => array(
            //    '../addons/romaninsh/menu/template',
            //),
        ))->setBasePath($this->pathfinder->base_location->getPath());

        $this->app_locations = $this->pathfinder->addLocation(array(
            'image'=>array('public/images'),
        ))
            ->setBasePath($this->pathfinder->base_location->getPath())
            ->setBaseURL($this->url('/')->__toString())
        ;


        $this->dbConnect();
        $this->addJUi();

        $this->setLayout();
        $this->addMenu();
        $this->addAuth();
        $this->auth->check();
    }

    private function setLayout() {
        $this->layout = $this->add('Layout_Fluid');

        $header = $this->layout->addHeader('View');
        $this->layout->header_wrap->addClass('header');
        $header->addClass('header-wrapper');
        $header->add('View')->setElement('img')->addClass('logo')->setAttr('src',
            $this->api->pathfinder->public_location->getURL().'images/logo.png');
        //$header->add('View')->setClass('atk-label atk-swatch-yellow atk-size-milli')->set('Build: '.$this->build);


        $this->layout->addFooter();
        foreach($this->layout->footer_wrap->elements as $m){
            $m->setHTML(
                '
                <div class="copyrights">
                    <div class="atk-move-left rgt">scrapyard © 2014</div>
                    <div class="atk-move-right webmaster">Agile55</div>
                    <div>&nbsp;</div>
                </div>
                '
            );
        };

    }
    private function addJUi() {
        $this->add('jUI')
            ->addStylesheet('scrapyard')
        ;
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