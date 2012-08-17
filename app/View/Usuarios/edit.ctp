<!-- app/View/Usuarios/edit.ctp -->
<?php echo $this->element('usuarios_menu'); ?>
<div class="usuarios form">
<?php echo $this->Form->create('Usuario');?>
    <fieldset>
        <legend><?php echo __('Editar Usuário'); ?></legend>
    <?php
        echo $this->Form->input('nome', array('label'=>'Nome'));
        echo $this->Form->input('usuario', array('label'=>'Usuário'));        
        echo $this->Form->input('datamodificado', array('type'=>'hidden','value'=>date('Y-m-d')));
        echo $this->Form->input('email', array('label'=>'Email'));        
        echo $this->Form->input('role', array(
            'label' => 'Nível de Acesso',            
            'options' => array('admin' => 'Admin', 'ouvidoria' => 'Ouvidoria')
        ));        
        echo $this->Form->input('novasenha', array('label'=>'Nova Senha', 'type'=>'password'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Salvar'));?>
</div>