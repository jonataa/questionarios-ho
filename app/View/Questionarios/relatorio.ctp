<?php 
function getNota($quantidades,$item,$nota){    
    $r = 0;
    foreach($quantidades AS $quantidade):
        if($quantidade['item']['id']==$item && $quantidade['resposta_item']['id']==$nota):
            return $quantidade[0]['qtd'];                        
        endif;                
    endforeach;
    return $r;
}
?>
<?php echo $this->Html->css('imprimir', 'stylesheet', array('media'=>'print')); ?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<?php if(!empty($grupos)): ?>

<?php foreach($grupos AS $i=>$grupo): ?>
<div style="page-break-after: always;">
    
<!-- Cabeçalho do Relatório -->
<?php $displayTitulo = ($i>0)?(true):(false); ?>
<?php echo $this->element('titulopadrao', array('display'=>$displayTitulo)); ?>
<?php echo $this->element('relatorioparametros', array(
    'periodo_de'=>$this->data['questionarios']['periodo_de'], 
    'periodo_ate'=>$this->data['questionarios']['periodo_ate'],    
    'display'=>$displayTitulo
        )); ?>
<!-- FIM Cabeçalho do Relatório -->

<h6 style="font-size: 150%;"><?php echo $grupo['GrupoItem']['descricao']; ?></h6>
<table>
    <tr>
        <th></th>  
        <th width="120px" style="text-align: center;">Ótimo</th>
        <th width="120px" style="text-align: center;">Bom</th>
        <th width="120px" style="text-align: center;">Regular</th>
        <th width="120px" style="text-align: center;">Ruim</th>
        <th width="120px" style="text-align: center;">Sem Resposta</th>
    </tr>
    <?php $graficosGrupoItem = array(); ?>
    <?php foreach($grupo['item'] AS $item): ?>    
    <tr>        
        <td><?php if($item['grupo_item_id']==$grupo['GrupoItem']['id']): echo $grupoItemDescricao = $item['descricao']; endif; ?></td>   
        <?php 
            $qtdnotas[0] = getNota($quantidades,$item['id'],'1');//Ótimo
            $qtdnotas[1] = getNota($quantidades,$item['id'],'2');//Bom
            $qtdnotas[2] = getNota($quantidades,$item['id'],'3');//Regular
            $qtdnotas[3] = getNota($quantidades,$item['id'],'4');//Ruim
            $qtdnotas[4] = getNota($quantidades,$item['id'],'5');//Sem Resp.
            
            $graficoGrupoItemAux = array();            
            $graficoGrupoItemAux['id'] = $item['id'];
            $graficoGrupoItemAux['descricao'] = $grupoItemDescricao;
            $graficoGrupoItemAux['notas']['Ótimo'] = $qtdnotas[0];
            $graficoGrupoItemAux['notas']['Bom'] = $qtdnotas[1];
            $graficoGrupoItemAux['notas']['Regular'] = $qtdnotas[2];
            $graficoGrupoItemAux['notas']['Ruim'] = $qtdnotas[3];
            $graficoGrupoItemAux['notas']['Sem Resp.'] = $qtdnotas[4];
            array_push($graficosGrupoItem, $graficoGrupoItemAux);            
        ?>
        <td style="text-align: center;"><?php echo $qtdnotas[0]; ?></td>             
        <td style="text-align: center;"><?php echo $qtdnotas[1]; ?></td>             
        <td style="text-align: center;"><?php echo $qtdnotas[2]; ?></td>             
        <td style="text-align: center;"><?php echo $qtdnotas[3]; ?></td>             
        <td style="text-align: center;"><?php echo $qtdnotas[4]; ?></td>             
    </tr>
    <?php endforeach; ?>    
</table>
<br/>
<?php if($this->data['questionarios']['grafico']): ?>
<h3>GRÁFICOS</h3><hr/><br/>
<?php             
    $grupoId = $grupo['GrupoItem']['id'];     
?>

<?php foreach($graficosGrupoItem AS $graficoGrupoItem): ?>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Item', 'Percentual por Nota'],
      ['Ótimo',     <?php echo $graficoGrupoItem['notas']['Ótimo']; ?>],
      ['Bom',       <?php echo $graficoGrupoItem['notas']['Bom']; ?>],
      ['Regular',   <?php echo $graficoGrupoItem['notas']['Regular']; ?>],
      ['Ruim',      <?php echo $graficoGrupoItem['notas']['Ruim']; ?>],
      ['Sem Resp.', <?php echo $graficoGrupoItem['notas']['Sem Resp.']; ?>]
    ]);

    var options = {
      title: '<?php echo $graficoGrupoItem['descricao']; ?>',
      colors:['#109618','#FF9900','#3366CC','#DC3912','#6C7B8B'],
      'chartArea': {'width': '95%', 'height': '80%'}
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_pie_item_<?php echo $graficoGrupoItem['id']; ?>'));
    chart.draw(data, options);
  }
</script>
<div id="chart_pie_item_<?php echo $graficoGrupoItem['id']; ?>" style="width: 250px; height: 250px; float:left;"></div>
<?php endforeach; ?>
<div style="clear: both;"></div><br/>
<?php endif; ?>
</div>
<?php endforeach; ?>  
<?php endif; ?>

<div style="page-break-after: always;"></div>

<?php if(!empty($comentarios)): ?>

<!-- Cabeçalho do Relatório -->
<?php echo $this->element('titulopadrao', array('display'=>($i>0)?(true):(false))); ?>
<?php echo $this->element('relatorioparametros', array(
    'periodo_de'=>$this->data['questionarios']['periodo_de'], 
    'periodo_ate'=>$this->data['questionarios']['periodo_ate'],    
    'display'=>($i>0)?(true):(false)
        )); ?>
<!-- FIM Cabeçalho do Relatório -->

<h3>Comentários e/ou Sugestões</h3>
<hr/><br/>
<?php foreach($comentarios AS $i=>$comentario): ?>
    <?php if($i>0): ?>
    <?php if($comentario['TipoComentario']['id']!=$comentarios[$i-1]['TipoComentario']['id']): ?>    
    <p><b><?php echo $comentario['TipoComentario']['descricao']; ?></b></p>
    <?php endif; ?>
    <?php else: ?>
    <p><b><?php echo $comentario['TipoComentario']['descricao']; ?></b></p>
    <?php endif; ?>    
    <p><i>"<?php echo $comentario['Questionario']['comentariosugestoes']; ?>"</i></p>
<?php endforeach; ?>
    <br/>
<?php endif; ?>
</div>

<style type="text/css">
    .menu-principal { display: none; }
</style>