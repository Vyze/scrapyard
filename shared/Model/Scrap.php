<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:30 PM
 */
class Model_Scrap extends Model_Table {
    public $table = 'scrap';
    function init() {
        parent::init();
        $this->addField('value')->type('text');
        $this->hasOne('User');
        $this->addField('created_at');
        $this->addField('updated_at');

        // hooks
        $this->addHook('beforeInsert',function($m,$q){
            $q->set('created_at',$q->expr('now()'));
            $q->set('updated_at',$q->expr('now()'));
            $q->set('user_id',$q->api->auth->model->id);
        });

        $this->addHook('beforeModify',function($m,$q){
            $q->set('updated_at',$q->expr('now()'));
        });
    }
}