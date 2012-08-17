<?php

/**
 * Description of OuvidoriaController
 *
 * @author Jonata Weber
 */
class QuestionariosController extends AppController {
    
    var $helpers = array('Time');
    
    public function index(){         
        $limit = 20;        
        $this->set('questionarios', $this->Questionario->find('all', array('limit'=>$limit, 'order' => 'Questionario.id DESC')));                     
    }
    
    public function salvar($datas){   
        $i = 0;
        foreach($datas AS $data){ 
            $i++;
            $this->Questionario->begin();                                    
            $data['Questionario']['registration'] = implode("-", array_reverse(explode("/",$data['Questionario']['registration'])));                                                  
            //$this->request->data['Questionario']['registration'] = date('Y-m-d');
            $this->Questionario->create($data['Questionario']);                         
            if ($this->Questionario->save()){                                
                $dataRespostas = array();
                foreach($data AS $key=>$respostaItemId):                        
                    $arrAux = explode('_',$key);                
                    if($arrAux[0]=='RespostaItem'){
                        $dataAux['questionario_id'] = $this->Questionario->id;                            
                        $dataAux['item_id'] = $arrAux[1];                            
                        $dataAux['resposta_item_id'] = $respostaItemId;
                        array_push($dataRespostas, $dataAux);                                                                                 
                    }
                endforeach;                                          
                if($this->Questionario->Resposta->saveAll($dataRespostas)) {                    
                    $this->Questionario->Resposta->commit();
                    if($i<=1) $this->Session->setFlash('Questionário adicionado com sucesso!');                                    
                    else $this->Session->setFlash("{$i} questionários adicionados com sucesso!");                                                        
                } else {                    
                    $this->Questionario->rollback();
                }                                
            } else {                
                $this->Session->setFlash('Questionário não pôde ser adicionado. Por favor, tente novamente.');
            } 
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function novo() {            
        if (!empty($this->data)) { 
            $datas = array();
            if(isset($this->data['Questionario']['questionarios_json']) && !empty($this->data['Questionario']['questionarios_json'])) {
                $datas = json_decode($this->data['Questionario']['questionarios_json'], true);                                                    
                unset($this->request->data['Questionario']['questionarios_json']);
            }
            if(isset($this->data['salvar-adicionar']) && !empty($this->data['salvar-adicionar'])) {                                              
                array_push($datas, $this->data);                        
                $this->data = array();
                $this->set('datas', $datas);                
                $this->set('grupos', ClassRegistry::init('GrupoItem')->find('all'));             
                $this->set('tipos', ClassRegistry::init('TipoComentario')->find('list', array('order' => array('ordem ASC'))));
                $this->set('notas', ClassRegistry::init('RespostaItem')->find('all'));                
            } else {                                 
                array_push($datas, $this->data);                                
                $this->salvar($datas);    
            }                                  
        } else {            
            $this->set('quemrespondeu', ClassRegistry::init('QuemRespondeu')->find('list'));
            $this->set('grupos', ClassRegistry::init('GrupoItem')->find('all'));
            $this->set('tipos', ClassRegistry::init('TipoComentario')->find('list', array('order' => array('ordem ASC'))));
            $this->set('notas', ClassRegistry::init('RespostaItem')->find('all'));     
        }
    }   

    public function detalhe($id = null){        
        $this->Questionario->id = $id;        
        $this->set('questionario', $this->Questionario->read());         
        $options['conditions'] = array(
            'questionario_id'=>$this->Questionario->id
        );
        
        $options['order'] = array(
            'grupo_item_id ASC'
        );
                
        $this->set('quemrespondeu', ClassRegistry::init('QuemRespondeu')->find('list'));
        $this->set('respostas', $this->Questionario->Resposta->find('all', $options));                
        $this->set('grupos', $this->Questionario->Resposta->Item->GrupoItem->find('list'));
    }
    
    public function getMeses(){
        $periodos = array();
        $ano = date('Y');
        $periodos['01']  = 'JANEIRO/'.$ano;
        $periodos['02']  = 'FEVEREIRO/'.$ano;
        $periodos['03']  = 'MARÇO/'.$ano;
        $periodos['04']  = 'ABRIL/'.$ano;
        $periodos['05']  = 'MAIO/'.$ano;
        $periodos['06']  = 'JUNHO/'.$ano;
        $periodos['07']  = 'JULHO/'.$ano;
        $periodos['08']  = 'AGOSTO/'.$ano;
        $periodos['09']  = 'SETEMBRO/'.$ano;
        $periodos['10'] = 'OUTUBRO/'.$ano;
        $periodos['11'] = 'NOVEMBRO/'.$ano;
        $periodos['12'] = 'DEZEMBRO/'.$ano;
        
        return $periodos;
    }
    
    public function criarrelatorio(){        
        $periodos = $this->getMeses();                
        $this->set('periodos', $periodos);
        $this->set('grupos', ClassRegistry::init('GrupoItem')->find('list'));           
    }       
    
    
    public function getGraficos($sqlQuantidades){
        $sql = str_replace('GROUP BY resposta_item.id, item.id, grupo_item.id', 'GROUP BY resposta_item.id, grupo_item.id/*, local_atendimento.id*/', $sqlQuantidades);
        $quantidadesGraficos = $this->Questionario->query($sql);        
        $graficos = array();        
        foreach($quantidadesGraficos AS $quantidade){                        
            $grupoId = $quantidade['grupo_item']['id'];
            $notaId  = $quantidade['resposta_item']['id'];                        
        }                              
        return $graficos;
    }
    public function getPeriodos($mes){                
        $meses = $this->getMeses();
        $periodos = array();
        $periodos['periodo_de'] = '01/'.$mes.'/'.date('Y');
        $periodos['periodo_ate'] = date("d/m/Y", strtotime('-1 second',strtotime('+1 month', strtotime($mes.'/01/'.date('Y').' 00:00:00'))));      
        $periodos['mes'] = $meses[$mes];        
        return $periodos;
    }
    
    public function relatorio(){       
        if(!empty($this->data)){
            
            $periodos = $this->getPeriodos($this->data['questionarios']['mes']);            
            $this->request->data['questionarios']['periodo_de'] = $periodos['periodo_de'];
            $this->request->data['questionarios']['periodo_ate'] = $periodos['periodo_ate'];                        
                        
            if(!empty($this->data['questionarios']['periodo_de']) || !empty($this->data['questionarios']['periodo_ate'])){              
                $periodo = array();
                $periodo['de'] = $this->data['questionarios']['periodo_de'];
                $periodo['ate'] = $this->data['questionarios']['periodo_ate'];
                $periodo['de_formatDB'] = implode("-", array_reverse(explode("/",$periodo['de'])));
                $periodo['ate_formatDB'] = implode("-", array_reverse(explode("/",$periodo['ate']))); 

                // Resumo dos Questionários                
                $periodoWhere = "AND questionario.registration BETWEEN STR_TO_DATE('{$this->data['questionarios']['periodo_de']} 00:00:00','%d/%m/%Y %H:%i:%s') AND STR_TO_DATE('{$this->data['questionarios']['periodo_ate']} 23:59:59','%d/%m/%Y %H:%i:%s')";
                $sqlQuantidades = "SELECT                             
                            grupo_item.id,
                            grupo_item.descricao,
                            grupo_item.descricao_plural,
                            item.id,
                            item.descricao,
                            resposta_item.id,
                            resposta_item.descricao,
                            COUNT(resposta_item.id) AS qtd
                        FROM questionario                                                        
                            INNER JOIN resposta ON resposta.questionario_id = questionario.id
                            INNER JOIN resposta_item ON resposta_item.id = resposta.resposta_item_id
                            INNER JOIN item ON item.id = resposta.item_id
                            INNER JOIN grupo_item ON grupo_item.id = item.grupo_item_id
                        WHERE 1=1                           
                        {$periodoWhere}
                        GROUP BY resposta_item.id, item.id, grupo_item.id
                        ORDER BY grupo_item.descricao, item.descricao, resposta_item.descricao";                              
                $quantidades = $this->Questionario->query($sqlQuantidades);  
                $this->set('graficos', $this->getGraficos($sqlQuantidades));
                $this->set('quantidades', $quantidades);
                $this->set('periodos', $periodos);
                
                // Grupos                    
                $this->set('grupos', ClassRegistry::init('GrupoItem')->find('all',array('conditions'=>array('GrupoItem.id'=>$this->data['questionarios']['grupos']))));
            } else {
                $this->Session->setFlash('Você deve preencher o período');
		$this->redirect(array('controller'=>'questionarios', 'action' => 'criarrelatorio'));
            };
            // Tabela Metas
            /*if(isset($this->data['questionarios']['metas']) && !empty($this->data['questionarios']['metas'])){     
                $nInternacoes = $this->data['questionarios']['n_internacoes'];
                $nConsultas = $this->data['questionarios']['n_consultas'];
                $contagem = $this->Questionario->find('all', array('fields'=>array('*, COUNT(*) AS count'),'group' => 'LocalAtendimento.id','order'=>'LocalAtendimento.ordem ASC','conditions'=>array('Questionario.registration BETWEEN ? AND ?'=>array($periodo['de_formatDB'],$periodo['ate_formatDB']))));                                
                
                $metas = $this->getMetas($contagem, $nInternacoes, $nConsultas);                                
                $this->set('metas', $metas);
            }*/
            // Comentários e/ou Sugestões
            if($this->data['questionarios']['comentarios']):
                $this->set('comentarios', $this->Questionario->find('all', array(
                    'order'=>'TipoComentario.descricao ASC',
                    'conditions'=>array(                        
                        'questionario.tipo_comentario_id !='=>7,
                        'questionario.registration BETWEEN STR_TO_DATE(?,"%d/%m/%Y %H:%i:%s") 
                            AND STR_TO_DATE(?,"%d/%m/%Y %H:%i:%s")' => array($this->data['questionarios']['periodo_de'].' 00:00:00', $this->data['questionarios']['periodo_ate'].' 23:59:59')
                        ))));                    
            endif;               
        } else 
            $this->redirect('/');                
    }
    
    public function getMetas($contagem, $nIntenacoes, $nConsultas){
        $metas = array();
        $total = 0;
        $metas['internacao']['total_pesquisas'] = 0;
        $metas['ambulatorial']['total_pesquisas'] = 0;
        foreach($contagem AS $cont){            
            if($cont['LocalAtendimento']['id']==4 || $cont['LocalAtendimento']['id']==2 || $cont['LocalAtendimento']['id']==3 || $cont['LocalAtendimento']['id']==1)
                $metas['internacao']['total_pesquisas'] += $cont[0]['count'];                                
            else 
                $metas['ambulatorial']['total_pesquisas'] += $cont[0]['count'];                
            
            $total += $cont[0]['count'];            
        }
        $metas['internacao']['n_internacoes'] = $nIntenacoes;
        $metas['internacao']['meta_quant']    = round($metas['internacao']['n_internacoes'] * 0.8); // 80% (INTERNAÇÃO)            
        $metas['internacao']['alcancado_%']   = round(($metas['internacao']['total_pesquisas'] * 100) / $metas['internacao']['meta_quant']);
        
        $metas['ambulatorial']['n_consultas'] = $nConsultas;
        $metas['ambulatorial']['meta_quant']  = round($metas['ambulatorial']['n_consultas'] * 0.05); // 20% (AMBULATORIAL)    
        $metas['ambulatorial']['alcancado_%'] = round(($metas['ambulatorial']['total_pesquisas'] * 100) / $metas['ambulatorial']['meta_quant']);
        
        $metas['total_pesquisas'] = $total;
        
        return $metas;
    }
    
}

?>
