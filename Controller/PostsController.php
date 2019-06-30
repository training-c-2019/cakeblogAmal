<?php
App::import('Controller', 'Comment');
App::import('Controller', 'User');
class PostsController extends AppController {
    var $uses = array( 'Post', 'Comment' );
    public $helpers = array('Html', 'Form');
    public $components =array ('Flash');

    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
    }
    public function getPost($id = null) {
        $this->autoRender = false;
        $id = $this->request->query['id'];

        if (!$id) {
            echo json_encode(['Invalid post']);
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            echo json_encode(['Invalid post']);
        }
        echo json_encode($post);
    }
    // app/Controller/PostsController.php
public function add() {
    if ($this->request->is('post')) {
        //Added this line
        $this->request->data['Post']['user_id'] = $this->Auth->user('id');
        if ($this->Post->save($this->request->data)) {
            $this->Flash->success(__('Your post has been saved.'));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
public function add2() {
    $this->autoRender = false;
    //$title = $_Post['title'];
    //$body = $_Post['body'];
    if ($this->request->is('post')) {
        //Added this line
        //$this->request->data['Post']['user_id'] = $this->Auth->user('id');
        $this->Post->create();
        //$this->request->data['Post']['title'] = $title;
        //$this->request->data['Post']['body'] = $body;
        if ($this->Post->save($this->request->data)) {
            $show=(__('Your post has been saved.'));
            echo json_encode($show);
        }
    }

}

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
    
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
    
        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }
    
        if (!$this->request->data) {
            $this->request->data = $post;
        }
    } 
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
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
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
    
        return parent::isAuthorized($user);
    }
}

    
?>