<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 3:05 PM
 */
class Lister_Scrap extends CompleteLister {

    protected $paginator = null;

    function init() {
        parent::init();
        $this->addPaginator();
        $this->addQuickSearch(array('value'));
    }

    function formatRow() {
        parent::formatRow();
        $this->current_row_html['value'] = $this->formatText($this->current_row['value']);
    }

    function addPaginator($ipp = 25, $options = null) {
        if ($this->paginator) {
            return $this->paginator;
        }
        $this->paginator = $this->add('Paginator', $options);
        $this->paginator->ipp($ipp);
        return $this;
    }

    function addQuickSearch($fields,$class='QuickSearch',$options=null){
        return $this->add($class,$options,'quick_search')
            ->useWith($this)
            ->useFields($fields);
    }

    function defaultTemplate() {
        return array('view/lister_scrap');
    }

    private function formatText($text) {
        $text = nl2br($text);
        return $text;
    }
}