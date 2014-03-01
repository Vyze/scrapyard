<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:28 PM
 */
class page_users extends Page {
    function init() {
        parent::init();
        $this->add('CRUD')->setModel('User',array(
            'name','email','password'
        ),array(
            'name','email','created_at','updated_at'
        ));
    }
}