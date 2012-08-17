<?php echo $this->element('usuarios_menu'); ?>
<div class="form">
    <table>
        <tr>
            <th>Nome</th>
            <th>Usuário</th>
            <th>Email</th>
            <th>Nível de Acesso</th>
            <th></th>
        </tr>
        <?php foreach($usuarios AS $usuario): ?>
        <tr>
            <td><?php echo $usuario['Usuario']['nome']; ?></td>
            <td><?php echo $usuario['Usuario']['usuario']; ?></td>
            <td><?php echo $usuario['Usuario']['email']; ?></td>
            <td><?php echo $usuario['Usuario']['role']; ?></td>
            <td style="text-align: center;">
                <?php echo $this->Html->link($this->Html->image('icon_edit.png'), array('action' => 'edit', $usuario['Usuario']['id']), array('escape'=>false)); ?>
                <?php echo $this->Html->link($this->Html->image('icon_del.png'), array('action' => 'delete', $usuario['Usuario']['id']), array('escape'=>false)); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>