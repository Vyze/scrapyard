<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:12 PM
 */
class page_index extends Page {
    function init() {
        parent::init();
        $this->add('LoremIpsum');
    }
}