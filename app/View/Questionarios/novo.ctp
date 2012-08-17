<?php echo $this->Html->script('jquery.valid8'); ?>
<?php echo $this->Html->script('jquery.expand'); ?>
<p><?php echo $this->Html->link('Voltar',array('controller' => 'questionarios', 'action' => 'index')); ?></p><br/>
<h2 style="margin-bottom: 0px;">Pesquisa de Satisfação do Cliente</h2>
<h5>Serviço de Atendimento ao Cliente (SAC)</h5>
<br/>
<hr/>
<br/>
<?php 
echo $this->Form->create('Questionario'); 
echo '<h6 style="font-size: 130%;">Quais os serviços utilizados?</h6><br/>';
echo $this->Form->input('consultas', array('type'=>'checkbox', 'format' => array('before', 'input', 'between', 'label', 'after', 'error' )));
echo $this->Form->input('exames', array('type'=>'checkbox','format' => array('before', 'input', 'between', 'label', 'after', 'error')));
echo $this->Form->input('internacao', array('type'=>'checkbox', 'label'=>'Internação', 'format' => array('before', 'input', 'between', 'label', 'after', 'error')));
echo $this->Form->input('qual_unidade', array('label'=>'Qual Unidade?')); 
echo $this->Form->input('outros', array('label'=>'Outros')); 
?>

<br/><h3>AVALIE OS SERVIÇOS UTILIZADOS</h3><hr/><br/>

<?php foreach($grupos AS $grupo): ?>

<h6 style="font-size: 130%;"><?php echo $grupo['GrupoItem']['descricao']; ?></h6>

<table>
  <tr>
    <th></th>  
    <?php foreach($notas AS $nota): ?>
     <th width="120px" style="text-align: center;"><?php echo $nota['RespostaItem']['descricao']; ?></th>
    <?php endforeach; ?>               
  </tr>  
  <?php foreach($grupo['item'] AS $item): ?>
  <tr>    
    <td><?php echo $item['descricao']; ?></td>
    <?php foreach($notas AS $nota): ?>
    <?php $checkedSemResposta = ($nota['RespostaItem']['id']==5)?('checked="checked"'):(''); ?>
     <td style="text-align: center;"><input <?php echo $checkedSemResposta; ?> style="text-align:center; width:100%" name="RespostaItem.<?php echo $item['id']; ?>" value="<?php echo $nota['RespostaItem']['id']; ?>" type="radio" class="questionario-item" /></td>     
    <?php endforeach; ?>   
  </tr>
  <?php endforeach; ?>    
</table> 
<br/>
<?php endforeach; ?>

<?php 
echo $this->Form->input('quem_respondeu_id', array('options' => $quemrespondeu, 'type' => 'select', 'label' => 'Quem está respondendo este boletim?', 'empty'=>'Sem Resposta')); 
echo $this->Form->input('indicaria', array('options' => array(0=>'Sem Resposta',1=>'Sim',2=>'Não'),'type' => 'select','label' => 'Indicaria os serviços do Hospital do Oeste para alguém conhecido?')); 
echo $this->Form->input('comentariosugestoes', array('type'=>'textarea','label'=>'Comentário / Elogio / Sugestão'));
echo $this->Form->input('tipo_comentario_id', array('options' => $tipos, 'type' => 'select', 'label' => 'Tipo de Comentário')); 
?>
<br/><h3>IDENTIFICAÇÃO OPCIONAL</h3><hr/><br/>
<?php
echo $this->Form->input('nome', array('label'=>'Nome')); 
echo $this->Form->input('email', array('label'=>'E-mail')); 
echo $this->Form->input('celular', array('label'=>'Celular')); 
echo $this->Form->input('telefone2', array('label'=>'Outro Telefone')); 
echo $this->Form->input('registration', array( 'type'=>'text', 'value'=>date('d/m/Y'),'label' => 'Data do envio do boletim'));
echo '<br/>';
if(isset($datas) && !empty($datas)) echo $this->Form->input('questionarios_json', array('type'=>'hidden', 'value'=>json_encode($datas))); 
echo $this->Form->submit('Salvar & Adicionar Novo', array('name' => 'salvar-adicionar'));
$qtd = (empty($datas))?(' (1)'):('('.(sizeof($datas)+1).')');
echo $this->Form->end('FINALIZAR'.$qtd);
?>

<script type="text/javascript">
    $(document).ready(function(){                        
        $('.questionario-item').valid8();
        $( ".datepicker" ).datepicker({ dateFormat: "dd/mm/yy" });
    });    
</script>