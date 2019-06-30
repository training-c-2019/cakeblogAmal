<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Comment</h1>
<?php
echo $this->Form->create('comment', [
    'url' => [
        'controller' => 'Comments',
        'action' => 'add'
    ]
]);
echo $this->Form->input('title');
echo $this->Form->input('body');
echo $this->Form->end('Save Comment');
?>
