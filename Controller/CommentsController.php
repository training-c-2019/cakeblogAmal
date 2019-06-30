<?php
class CommentsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('comments', $this->Comment->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid comment'));
        }

        $comment = $this->Comment->findById($id);
        if (!$comment) {
            throw new NotFoundException(__('Invalid comment'));
        }
        $this->set('comment', $comment);
    }
    // app/Controller/PostsController.php
public function add() {
    if ($this->request->is('post')) {
        $this->Comment->create();
        //Added this line
        //$this->request->data['Comment']['user_id'] = $this->Auth->user('id');
        //debug($this->request->data);exit;
        $x=($this->request->data['comment']['post_id']);
        if ($this->Comment->save($this->request->data)) {
            $this->Flash->success(__('Your comment has been saved.'));
            return $this->redirect(array('controller' => 'Posts','action' => 'index',$x));
        }
        else { $this->Flash->success(__('Your comment has not been saved.'));}
    }
}

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid comment'));
        }
    
        $comment = $this->Comment->findById($id);
        if (!$comment) {
            throw new NotFoundException(__('Invalid comment'));
        }
    
        if ($this->request->is(array('comment', 'put'))) {
            $this->Comment->id = $id;
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success(__('Your comment has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your comment.'));
        }
    
        if (!$this->request->data) {
            $this->request->data = $comment;
        }
    } 
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Comment->delete($id)) {
            $this->Flash->success(
                __('The comment with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The comment with id: %s could not be deleted.', h($id))
            );
        }
    
        return $this->redirect(array('action' => 'index'));
    }
    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }
    
        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $commentId = (int) $this->request->params['pass'][0];
            if ($this->Comment->isOwnedBy($commentId, $comment['id'])) {
                return true;
                
            }
        }
    
        return parent::isAuthorized($user);
    }
}

    
?>