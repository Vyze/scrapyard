<?php
/**
 * Created by Vadym Radvansky
 * Date: 3/1/14 2:29 PM
 */
class Model_User extends Model_Table {
    public $table = 'user';
    function init() {
        parent::init();
        if (!@$this->api->auth) {
            throw $this->exception('Add Auth for password encription');
        }
        $this->api->auth->addEncryptionHook($this);

        $this->addField('name');
        $this->addField('email')->mandatory('required');
        $this->addField('password')->display(array('form'=>'password'))->mandatory('required');
        $this->addField('created_at');
        $this->addField('updated_at');

        // hooks
        $this->addHook('beforeInsert',function($m,$q){
            $q->set('created_at',$q->expr('now()'));
            $q->set('updated_at',$q->expr('now()'));
            if($m->getBy('email',$m['email'])) throw $m
                    ->exception('User with this email already exists','ValidityCheck')
                    ->setField('email');
        });

        $this->addHook('beforeModify',function($m,$q){
            $q->set('updated_at',$q->expr('now()'));
            if($m->dirty['email']) throw $m
                ->exception('Do not change email for existing user','ValidityCheck')
                ->setField('email');
        });
    }
    function me(){
        $this->addCondition('id',$this->api->auth->get('id'));
        return $this;
    }
}