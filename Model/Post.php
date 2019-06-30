<?php
class Post extends AppModel {

    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'post_id'));//comment id 
        //public $belongsTo = array(
          //  'User' => array(
            //'className' => 'User'));

    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        )
    );
    
}
?>