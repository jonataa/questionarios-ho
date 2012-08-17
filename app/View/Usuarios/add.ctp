<!-- app/View/Usuarios/add.ctp -->
<?php echo $this->element('usuarios_menu'); ?>
<div class="usuarios form">
<?php echo $this->Form->create('Usuario');?>
    <fieldset>
        <legend><?php echo __('Cadastrar Usuário'); ?></legend>
    <?php
        echo $this->Form->input('nome', array('label'=>'Nome'));
        echo $this->Form->input('usuario', array('label'=>'Usuário'));
        echo $this->Form->input('senha', array('label'=>'Senha', 'type'=>'password'));
        echo $this->Form->input('email', array('label'=>'Email'));    
        echo $this->Form->input('datacriacao', array('type'=>'hidden','value'=>date('Y-m-d')));    
        echo $this->Form->input('datamodificado', array('type'=>'hidden','value'=>date('Y-m-d')));            
        echo $this->Form->input('role', array(
            'label' => 'Nível de Acesso',
            'options' => array('admin' => 'Admin', 'ouvidoria' => 'Ouvidoria')
        ));        
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Salvar'));?>
</div>