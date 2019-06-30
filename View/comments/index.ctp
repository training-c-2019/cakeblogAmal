<!-- File: /app/View/Posts/index.ctp -->

<h1>Comments</h1>
<p><?php echo $this->Html->link('Add Comment', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($comments as $comment): ?>
    <tr>
        <td><?php echo $comment['Comment']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $comment['Comment']['title'],
                    array('action' => 'view', $comment['Comment']['id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->commentLink(
                    'Delete',
                    array('action' => 'delete', $comment['Comment']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $comment['Comment']['id'])
                );
            ?>
        </td>
        <td>
            <?php echo $comment['Comment']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>