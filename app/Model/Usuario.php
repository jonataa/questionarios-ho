<?php

class Usuario extends AppModel {
    var $useTable = "usuario";
    
    public $validate = array(
        'nome'  =>  array(
            'required'  =>  array(
                'rule'  =>  array('notEmpty'),
                'message'   =>  'Esse campo é obrigatório'
            )
        ),
        'usuario'  =>  array(
            'required'  =>  array(
                'rule'  =>  array('notEmpty'),
                'message'   =>  'Esse campo é obrigatório'
            )
        ),
        'senha'  =>  array(
            'required'  =>  array(
                'rule'  =>  array('notEmpty'),
                'message'   =>  'Esse campo é obrigatório'
            )
        ),        
        'email'  =>  array(
            'required'  =>  array(
                'rule'  =>  array('notEmpty'),
                'message'   =>  'Esse campo é obrigatório'
            )
        ),
        'role'  =>  array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'coordenador', 'ouvidoria', 'rh')),
                'message' => 'Por favor, escolha um nível de acesso válido',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave() {
        if (isset($this->data[$this->alias]['senha'])) {
            $this->data[$this->alias]['senha'] = AuthComponent::password($this->data[$this->alias]['senha']);
        }
        return true;
    }
    
}

?>
