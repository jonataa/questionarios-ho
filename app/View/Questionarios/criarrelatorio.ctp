<p><?php echo $this->Html->link('Voltar',array('controller' => 'questionarios', 'action' => 'index')); ?></p><br/>

<?php echo $this->element('titulopadrao'); ?>

<?php echo $this->Form->create('questionarios',array('action'=>'/relatorio','target'=>'relatorio')); ?>
<?php echo $this->Form->input('mes', array(
    'type'=>'select',
    'selected'=>date('m'),
    'label'=>'Período',         
    'options'=>$periodos)); 
?>
<div style="float:left;">
<?php echo $this->Form->input('grupos', array(
    'type'=>'select',
    'selected'=>array(1,2,3,4,5,6,7,8,9,10,11,12),
    'label'=>'Grupos',
    'multiple'=>'checkbox',    
    'style'=>'float:left;',
    'options'=>$grupos)); 
?>
</div>
<div style="float: left;">
    <h3>Incluir:</h3>
    <?php echo $this->Form->input('comentarios', array('type'=>'checkbox','label'=>'Comentários e/ou Sugestões')); ?>
    <?php echo $this->Form->input('grafico', array('type'=>'checkbox','label'=>'Gráficos','checked'=>'checked')); ?>
</div>
<div style="clear: both;"></div>

<?php echo $this->Form->end('Gerar Relatório'); ?>

<script type="text/javascript">
    $(document).ready(function(){         
        $('form').submit(function(){
            window.open('Relatório','relatorio','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width='+screen.width+', height='+screen.height+', screenX=0, screenY=0, alwaysLowered = false, scrollbars=yes,maximized=yes');            
        });                
    });    
</script>