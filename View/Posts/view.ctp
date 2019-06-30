<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo ($post['Post']['created']); ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>
<p><?php// debug($post['Post']['role']);exit; ?></p>
<p><?php //debug($comment); ?></p>
<p><?php echo $this->Html->link('Add comment', array('controller' => 'Comments','action' => 'add',$post['Post']['id'])); ?></p>

<h1>Add Comment </h1>
<?php
echo $this->Form->create('Comment', [
    'url' => [
        'controller' => 'Comments',
        'action' => 'add'
    ]
]);
echo $this->Form->input('title');
echo $this->Form->input('body');
echo $this->Form->input('post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
//echo $this->Form->input('user_id',array('type'=>'hidden','value'=>$user['User']['id']));
echo $this->Form->end('save comment');
?> 