<?php if(AuthComponent::user('nome')): ?>
<div style="float: right;">
<?php echo 'Olá ' . AuthComponent::user('nome') . ', ' . $this->Html->link('Sair', array('controller' => 'usuarios', 'action' => 'logout'), array('style'=>'color:#fff;')); ?>
</div>
<?php endif; ?>