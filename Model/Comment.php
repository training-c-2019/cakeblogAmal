<?php
class Comment extends AppModel {
    public $belongsTo = array(
        'Post' => array(
        'className' => 'Post')
       );
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