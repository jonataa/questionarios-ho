<h3>METAS</h3><hr/><br/>
<table>
    <thead>
        <tr>
            <th colspan="6" style="font-size: 130%; text-align: center;">INTERNAÇÃO</th>
        </tr>
        <tr>
            <th>Local de Atendimento</th>
            <th style="width: 250px; text-align: center;">Total de Pesquisas Aplicadas</th>
            <th style="width: 250px; text-align: center;">Meta Pactuada</th>
            <th style="width: 100px; text-align: center;">Nº de Internações (<?php echo $periodos['mes']; ?>)</th>
            <th style="width: 100px; text-align: center;">Meta Quant. (<?php echo $periodos['mes']; ?>)</th>
            <th style="width: 100px; text-align: center;">% Alcançado</th>
        </tr>        
        <tr>
            <td>Centro Cirúrgico</td>            
            <td rowspan="4" style="vertical-align: middle; text-align: center;"><?php echo $metas['internacao']['total_pesquisas']; ?></td>
            <td rowspan="4" style="vertical-align: middle; text-align: center;">80% do total das internações ocorridas no período</td>
            <td rowspan="4" style="vertical-align: middle; text-align: center;"><?php echo $metas['internacao']['n_internacoes']; ?></td>
            <td rowspan="4" style="vertical-align: middle; text-align: center;"><?php echo $metas['internacao']['meta_quant']; ?></td>
            <td rowspan="4" style="vertical-align: middle; text-align: center;"><?php echo $metas['internacao']['alcancado_%']; ?>%</td>
        </tr>  
         <tr>
            <td>Unidades de Internamento</td>                        
        </tr>  
         <tr>
            <td>UTI</td>                       
        </tr>  
         <tr>
            <td>UPA (Urgência e Emergência)</td>                        
        </tr>  
    </thead>
</table>
<br/>
<table>
    <thead>
        <tr>
            <th colspan="6" style="font-size: 130%; text-align: center;">AMBULATORIAL</th>
        </tr>
        <tr>         
            <th>Local de Atendimento</th>
            <th style="width: 250px; text-align: center;">Total de Pesquisas Aplicadas</th>
            <th style="width: 250px; text-align: center;">Meta Pactuada</th>
            <th style="width: 100px; text-align: center;">Nº de Consultas (<?php echo $periodos['mes']; ?>)</th>
            <th style="width: 100px; text-align: center;">Meta Quant. (<?php echo $periodos['mes']; ?>)</th>
            <th style="width: 100px; text-align: center;">% Alcançado</th>
        </tr>        
        <tr>
            <td>Ambulatório</td>            
            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $metas['ambulatorial']['total_pesquisas']; ?></td>
            <td rowspan="2" style="vertical-align: middle; text-align: center;">5% do total das consultas realizadas no período</td>
            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $metas['ambulatorial']['n_consultas']; ?></td>
            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $metas['ambulatorial']['meta_quant']; ?></td>
            <td rowspan="2" style="vertical-align: middle; text-align: center;"><?php echo $metas['ambulatorial']['alcancado_%']; ?>%</td>
        </tr>  
        <tr>
            <td>SADT</td>                        
        </tr>            
    </thead>
</table>

<!--div class="table-contagem-local-atendimento">    
    <table>
        <thead>
            <tr>
                <th>Local de Atendimento</th>
                <th style="width: 40px; text-align: center;">Qtd.</th>
            </tr>            
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach($metas AS $c): ?>
            <?php $total += $c[0]['count']; ?>
            <tr>
                <td><?php echo $c['LocalAtendimento']['descricao']; ?></td>
                <td style="text-align: center;"><?php echo $c[0]['count']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>            
            <tr>
                <td style="text-align: right;"><b>Total</b></td>
                <td style="text-align: center;"><?php echo $total; ?></td>
            </tr>
        </tfoot>
    </table>
</div-->