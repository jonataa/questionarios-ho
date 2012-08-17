<?php

/**
 * Description of UsuarioController
 *
 * @author Administrador
 */
class UsuariosController extends AppController {    
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('logout');
    }
    
    public function login() {                
            if ($this->Auth->login()) {                
                $this->redirect($this->Auth->redirect());
            } else {
                if($this->request->is('POST')) {
                    $this->Session->setFlash(__('Usuário e senha inválidos. Por favor, tente novamente.'));
                }
            }
    }        

    public function logout() {  
        $user = $this->Auth->user();        
        switch($user['role']){            
            case 'ouvidoria'    : $url = array('controller' => 'questionarios', 'action' => 'index'); break;
            case 'admin'        : $url = array('controller' => 'usuarios', 'action' => 'index'); break;
            default             : $url = array('controller' => 'usuarios', 'action' => 'login'); break;
        }        
        $this->Auth->logout();
        $this->redirect($url);
    }
    
    public function index() {        
        $usuarios = $this->Usuario->find("all");        
        $this->set('usuarios', $usuarios);
    }
    
    public function view($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        $this->set('usuario', $this->Usuario->read(null, $id));
    }
    
    public function add() {
        if ($this->request->is('post')) {
            $this->Usuario->create();            
            $this->request->data['datacriacao'] = date('Y-m-d');
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('O usuário foi salvo com sucesso'));
                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
            }
        }
    }      

    public function edit($id = null) {
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {            
            if(!empty($this->request->data['Usuario']['novasenha'])) $this->request->data['Usuario']['senha'] = $this->request->data['Usuario']['novasenha'];
            if ($this->Usuario->save($this->request->data)) {
                $this->Session->setFlash(__('O usuário foi salvo com sucesso'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
            }
        } else {
            $this->request->data = $this->Usuario->read(null, $id);
            unset($this->request->data['Usuario']['senha']);
        }
    }

    public function delete($id = null) {        
        $this->Usuario->id = $id;
        if (!$this->Usuario->exists()) {
            throw new NotFoundException(__('Usuário inválido'));
        }
        if ($this->Usuario->delete()) {
            $this->Session->setFlash(__('Usuário removido'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('O usuário não pôde ser removido'));
        $this->redirect(array('action' => 'index'));
    }
}

?>
