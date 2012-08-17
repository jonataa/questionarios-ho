<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    
    public $components = array(
        'Session',
        'Auth' => array(            
            'loginAction' => array(
                'controller' => 'usuarios',
                'action' => 'login'
            ),
            'authError' => 'Acesso não permitido!',
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'Usuario',
                    'fields' => array('password' => 'senha', 'username' => 'usuario')
                )
            ),
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display'),
            'logoutRedirect' => array('controller' => 'usuarios', 'action' => 'login'),
            'authorize' => array('Controller') // Adicionamos essa linha
        )
    );
    
    public function isAuthorized($user = null) {                   
        $controller = $this->request->params['controller'];            
        $action     = $this->request->params['action'];                    
        if(isset($user['role'])){
            if($user['role'] === 'admin'){
                return true; //Admin pode acessar todas as actions
            }else if(($controller === 'questionarios') && ($user['role'] === 'ouvidoria')){                
                return true;
            }
        }
        return false; // O resto não pode        
    }

    function beforeFilter() {        
        $this->Auth->allow('display');        
    }       
    
}
