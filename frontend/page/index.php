<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:12 PM
 */
class page_index extends Page {
    function init() {
        parent::init();

        $this->title = 'Search';

        $l = $this->add('Lister_Scrap');
        $l->setModel('Scrap');
    }
    function defaultTemplate() {
        return array('page/index');
    }
}