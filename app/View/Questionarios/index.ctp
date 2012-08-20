<?php 
    //print_r($contagem[0]);
?>
<h2 style="margin-bottom: 0px;">Questionários</h2>
<h5>Serviço de Atendimento ao Cliente (SAC)</h5><br/>
<hr/><br/>
<p>
<?php echo $this->Form->button('Novo Questionário', array('onclick'=>"window.location = 'questionarios/novo';",'type'=>'button',
                                          'class'=>'btnDefault')); ?>
<?php echo $this->Form->button('Relatórios', array('onclick'=>"window.location = 'questionarios/criarrelatorio';",'type'=>'button',
                                          'class'=>'btnDefault')); ?>        
</p>

<div class="table-questionarios">
    <h3>Questionários (<?php echo sizeof($questionarios); ?> últimos)</h3>       
    <table>
    <thead>
        <tr>
            <th>Cód.</th>        
            <th>Nome</th>
            <th>E-mail</th>
            <th style="text-align: center;">Data de Registro</th>
            <th width="100px"></th>
        </tr>
    </thead>
    <tbody>
        <?php if(empty($questionarios)): ?>
        <tr>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>            
        </tr>  
        <?php endif; ?>  
        <?php foreach($questionarios AS $questionario): ?>
        <tr>
            <td><?php echo $questionario['Questionario']['id']; ?></td>        
            <td><?php echo $questionario['Questionario']['nome']; ?></td>
            <td><?php echo $questionario['Questionario']['email']; ?></td>
            <td style="text-align: center;"><?php echo $questionario['Questionario']['registration']; ?></td>
            <td style="text-align: center;">
                <?php echo $this->Html->link(
                        $this->Html->image('icon_details.png'), 
                        array('action' => 'detalhe', $questionario['Questionario']['id']), 
                        array('escape'=>false)); 
                    ?>
            </td>
        </tr>
        <?php endforeach; ?>             
    </tbody>
    </table>    
</div>

