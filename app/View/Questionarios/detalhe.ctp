<p><?php echo $this->Html->link('Voltar',array('controller' => 'questionarios', 'action' => 'index')); ?></p><br/>

<?php echo $this->element('titulopadrao'); ?>

<h3>Informações do Questionário</h3>
<br/>
<table>
    <tr>
        <th style="width: 25%;"></th>
        <th></th>
    </tr>    
    <tr>
        <td style="text-align: right;">Código:</td>
        <td><b><?php echo $questionario['Questionario']['id']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Nome:</td>
        <td><b><?php echo $questionario['Questionario']['nome']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">E-mail:</td>
        <td><b><?php echo $questionario['Questionario']['email']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Celular:</td>
        <td><b><?php echo $questionario['Questionario']['celular']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Outro Telefone:</td>
        <td><b><?php echo $questionario['Questionario']['telefone2']; ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">Consultas:</td>
        <td><b><?php echo $questionario['Questionario']['consultas']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Exames:</td>
        <td><b><?php echo $questionario['Questionario']['exames']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Internação:</td>
        <td><b><?php echo $questionario['Questionario']['internacao']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Qual Unidade?</td>
        <td><b><?php echo $questionario['Questionario']['qual_unidade']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Outros:</td>
        <td><b><?php echo $questionario['Questionario']['outros']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Comentário / Elogio / Sugestão:</td>
        <td><b><?php echo $questionario['Questionario']['comentariosugestoes']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Tipo de Comentário:</td>
        <td><b><?php echo $questionario['TipoComentario']['descricao']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Quem está respondendo este boletim?</td>
        <td><b><?php echo (empty($questionario['QuemRespondeu']['descricao'])?('<i>Não Informado</i>'):($questionario['QuemRespondeu']['descricao'])); ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Indicaria para alguém conhecido?</td>
        <td><b><?php echo $questionario['Questionario']['indicaria']; ?></b></td>
    </tr>
    <tr>
        <td style="text-align: right;">Data do envio do boletim:</td>
        <td><b><?php echo $questionario['Questionario']['registration']; ?></b></td>
    </tr>
</table>
<br/>
<table>
    <tr>
        <th>Categoria</th>
        <th>Item</th>
        <th>Nota</th>
    </tr>
    <?php foreach($respostas AS $resposta): ?>
    <tr>    
        <?php foreach($grupos AS $id=>$grupo): ?>
        <?php if($resposta['Item']['grupo_item_id']==$id): ?>
        <td><?php echo $grupo; break; ?></td>
        <?php endif; ?>
        <?php endforeach; ?>
        <td><?php echo $resposta['Item']['descricao']; ?></td>
        <td><?php echo $resposta['RespostaItem']['descricao']; ?></td>    
    </tr>    
    <?php endforeach; ?>
</table>