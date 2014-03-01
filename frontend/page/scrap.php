<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:28 PM
 */
class page_scrap extends Page {
    function init() {
        parent::init();
        $this->add('CRUD')->setModel('Scrap',array(
            'value'
        ),array(
            'value','created_at','updated_at'
        ));
    }
}