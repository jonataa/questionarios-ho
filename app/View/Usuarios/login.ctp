<h2>EFETUE LOGIN!</h2>
<?php
echo $this->Session->flash('auth'); // Exibimos qualquer erro que possa ter ocorrido
echo $this->Form->create('Usuario' , array('action' => 'login'));
echo $this->Form->input('usuario');
echo $this->Form->input('senha', array('type'=>'password'));
echo $this->Form->end('ACESSAR');
?>