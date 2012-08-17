<?php
/**
 * Description of EscalasController
 *
 * @author Jonata Weber
 */
class EscalasController extends AppController {
    
    /*public $components = array(
            'CakePdf.CakePdf' => array(
                'prefix' => 'pdf',
                'layout' => 'CakePdf.pdf',
                'filename' => '{name_of_action}.pdf', // this is the name on output pdf (when force download occurs)
                'orientation' => 'L',  // accept 'P' for portrait and 'L' for landscape
                'paper' => 'A4' // accept all paper types of tcpdf library
            )
    );*/
    
    public function index(){
        $this->redirect(array('action' => 'gerarrelatorio'));
    }
    
    public function gerarrelatorio($relatorio='planilha'){           
        $unidades_categorias = ClassRegistry::init('Funcionario')->query(
           "SELECT unidade.*, categoria.* 
            FROM funcionario
                    INNER JOIN categoria ON categoria.id = funcionario.categoria_id
                    INNER JOIN funcionario_escala ON funcionario_escala.funcionario_id = funcionario.id
                    INNER JOIN unidade ON unidade.id = funcionario_escala.unidade_id
            GROUP BY unidade.id, categoria.id
            ORDER BY unidade.descricao, categoria.descricao");   
        
        $this->set('unidades_categorias', $unidades_categorias); 
        $this->set('relatorio', $relatorio);       
        $this->set('unidades', ClassRegistry::init('Unidade')->find('list'));             
        $this->set('refeicoes', ClassRegistry::init('Refeicao')->find('list'));       
        $this->set('categorias', ClassRegistry::init('Categoria')->find('list'));   
    }
       
    
    public function relatorio($relatorio = null){  
        set_time_limit(0);
        
        $relatorio = (empty($relatorio))?($this->data['escalas']['relatorio']):($relatorio);        
        
        if (!empty($this->data)) {             
                if(!$this->data['escalas']['todos']) {
                    $unidade_categoria = explode('_', $this->data['escalas']['unidade_categoria']);
                    $unidadeId   = $unidade_categoria[0];
                    $categoriaId = $unidade_categoria[1];
                    $unidade['id'] = $unidadeId;  
                }else{
                    $categoriaId = null;
                    $unidade['id'] = null;
                }
            
            /* PARÂMETROS */                     
            if($relatorio=='refeitorio') $refeicao['id'] = $this->data['escalas']['refeicao'];
            $periodo = array();
            $periodo['de'] = $this->data['escalas']['periodo_de'];
            $periodo['ate'] = $this->data['escalas']['periodo_ate'];
            $periodo['de_formatDB'] = implode("-", array_reverse(explode("/",$periodo['de'])));
            $periodo['ate_formatDB'] = implode("-", array_reverse(explode("/",$periodo['ate'])));                             
            
            /* CONSULTAS NO BANCO DE DADOS */      
            $refeicoesId = null;
            if($relatorio=='refeitorio') {                
                $refeicoes = ClassRegistry::init('Refeicao')->findById($refeicao['id']);
                $refeicoesId = array();
                $legenda = array();               
                foreach($refeicoes['Escala'] AS $escala){                                        
                    array_push($refeicoesId, $escala['id']);
                }   
            }                                                                                                                                  
            $funcionarios = $this->getFuncionarios($this->data['escalas']['todos'], $unidade, $categoriaId, $periodo, $relatorio, $refeicoesId);                                  
            $unidade = ClassRegistry::init('Unidade')->findById($unidade['id']);   
            $escalaModel = ClassRegistry::init('Escala');
            $escalaModel->displayField = 'descricao';
            $escalas = $escalaModel->find('list');            
            
            /* SESSÕES */   
            if($relatorio=='refeitorio') 
                $this->set('refeicoes', $refeicoes);
            $this->set('unidade', $unidade);            
            $this->set('funcionarios', $funcionarios);                        
            $this->set('periodo', $periodo); 
            $this->set('escalas', $escalas); 
            $this->set('legenda', $this->data['escalas']['legenda']); 
            $this->set('relatorio', $relatorio);    
            $this->set('todos', $this->data['escalas']['todos']);                                       
            
            /* REDIRECIONAR VIEW */            
            switch($relatorio){                 
                case 'refeitorio'  : {                       
                    $this->render('relatoriorefeitorio');
                    break;
                }
                case 'planilha' : {   
                    $this->set('tickets', $this->data['escalas']['tickets']); 
                    $this->set('refeicoes', ClassRegistry::init('Refeicao')->find('all'));
                    $datas = $this->getDatas($this->getIntervalo($periodo['ate_formatDB'], $periodo['de_formatDB']), $periodo['de_formatDB']);          
                    $this->set('datas', $datas);                     
                    $this->render('relatorioplanilhaescalas');                    
                    break;
                }                
            }                                                
        }                
    }
    
    public function cadastrarescala(){
        
        //phpinfo(); die;
        
        /*$funcionarios = ClassRegistry::init('Funcionarios')->find('all');
        print_r($funcionarios); die;*/                
        
        $unidades = ClassRegistry::init('UsuarioUnidade')->find('all', array('conditions'=>array('UsuarioUnidade.usuario_id' => $this->Auth->user('id')),'fields'=>array('Unidade.id, Unidade.descricao')));        
        $unidadesList = array();
        foreach($unidades AS $unidade){
            $unidadesList[$unidade['Unidade']['id']] = $unidade['Unidade']['descricao'];
        }
        $funcionarios = ClassRegistry::init('Funcionario')->find('list', array('conditions' => array('Funcionario.usuario_id' => $this->Auth->user('id'))));     
        $this->set('unidades', $unidadesList);
        $this->set('funcionarios', $funcionarios);
    }
    
    public function prepararescala() {
        $periodo = array();
        $periodo['de'] = $this->data['escalas']['periodo_de'];
        $periodo['ate'] = $this->data['escalas']['periodo_ate'];
        $periodo['de_formatDB'] = implode("-", array_reverse(explode("/",$periodo['de'])));
        $periodo['ate_formatDB'] = implode("-", array_reverse(explode("/",$periodo['ate'])));           
        $datas = $this->getDatas($this->getIntervalo($periodo['ate_formatDB'],$periodo['de_formatDB']), $periodo['de_formatDB']);                     
        
        $funcionarios = ClassRegistry::init('Funcionario')->find('all', array('conditions' => array('Funcionario.id' => $this->data['escalas']['funcionarios'])));                             
        $escalas = ClassRegistry::init('Escala')->find('list');                
        $unidade = ClassRegistry::init('UsuarioUnidade')->find('all', array('conditions'=>array('UsuarioUnidade.unidade_id'=>$this->data['escalas']['unidade'],'UsuarioUnidade.usuario_id' => $this->Auth->user('id')),'fields'=>array('Unidade.id, Unidade.descricao')));
        
        $this->set('funcionarios', $funcionarios);
        $this->set('unidade', $unidade);
        $this->set('escalas', $escalas);                        
        
        $escalaModel = ClassRegistry::init('Escala');
        $escalaModel->displayField = 'descricao';
        $escalasLegenda = $escalaModel->find('list');                          
        $this->set('escalasLegenda', $escalasLegenda);                
        
        $this->set('periodo', $periodo);
        $this->set('datas', $datas);
    }
    
    public function getFuncionarios($todos, $unidade, $categoriaId, $periodo, $relatorio, $refeicoesId){        
        
        $funcionarioModel = ClassRegistry::init('Funcionario');
               
        $funcionarioConditions = array('FuncionarioEscala.data BETWEEN ? AND ?'=>array($periodo['de_formatDB'],$periodo['ate_formatDB']));             
        if($todos==0) $funcionarioConditions['FuncionarioEscala.unidade_id'] = $unidade['id'];        
        if($relatorio=='refeitorio') $funcionarioConditions['FuncionarioEscala.escala_id'] = $refeicoesId;                                      
        $funcionarioModel->hasAndBelongsToMany['Escala']['conditions'] = $funcionarioConditions;
            
        if($todos==1) $funcionarios = $funcionarioModel->find('all', array('order'=>'Funcionario.nome ASC'));                  
        else $funcionarios = $funcionarioModel->find('all', array('conditions'=>array('Categoria.id'=>$categoriaId),'order'=>'Funcionario.nome ASC')); 
        
        return $funcionarios;
    }
    
    public function salvarescala(){             
        if(!empty($this->data)){
            $logModel = ClassRegistry::init('Log');    
            $dataLog = array();
            $dataLogDados = array();
            $data = array();              
            if(isset($this->data['escala']['update'])){
                foreach($this->data['escala']['update'] AS $funcionarioEscalaId=>$escalaAtualizada){   
                    array_push($dataLogDados, "Alterou a escala_funcionario({$funcionarioEscalaId}) de 'SD' para '{$escalaAtualizada}';");
                    $dataAux = array();
                    $dataAux['id'] = $funcionarioEscalaId;
                    $dataAux['escala_id'] = $escalaAtualizada;
                    array_push($data, $dataAux);
                }                
            }            
            if(isset($this->data['escala']['insert'])){
                foreach($this->data['escala']['insert'] AS $funcionarioId=>$escalas){
                    foreach($escalas AS $dataEscala=>$escala){
                        if(!empty($escala)){
                            array_push($dataLogDados, "Cadastrou a escala do funcionário({$funcionarioId}) do dia '{$dataEscala}' como '{$escala}';");
                            $dataAux = array();                        
                            $dataAux['unidade_id'] = $this->data['escalas']['unidade'];
                            $dataAux['funcionario_id'] = $funcionarioId;
                            $dataAux['data'] = $dataEscala;
                            $dataAux['escala_id'] = $escala;
                            array_push($data, $dataAux);
                        }
                    }
                }
            }
            
            //print_r($dataLogDados); die;
            
            $funcionarioEscalaModel = ClassRegistry::init('FuncionarioEscala');
            $funcionarioEscalaModel->begin();
            if($funcionarioEscalaModel->saveAll($data)) { 
                $this->Session->setFlash('Sua Escala foi alterada com sucesso!');
                $this->render('mensagemsalvarescala');
            }else{
                $this->Session->setFlash('Houve algum problema ao tentar salvar sua escala');
                $this->render('mensagemsalvarescala');
            }                        
        }        
    }
    
    public function getIntervalo($fim,$inicial){
        return intval((strtotime($fim)- strtotime($inicial))) / (60 * 60 * 24); 
    }
    
    public function getDatas($days, $de_formatDB){                     
        $datas = array();
        for($i=0; $i <= $days; $i++){                
            $dataAux = array();
            $dataInicial = $de_formatDB;                        
            $newdate = strtotime ('+'.$i.' day' , strtotime($dataInicial));   
            $dataAux['dataDB'] = date('Y-m-d', $newdate);
            $dataAux['dia'] = date('d', $newdate);                        
            $dataAux['diaExtenso'] = date('D', $newdate);
            $dataAux['diaExt'] = $this->getDia(date('D', $newdate));
            $dataAux['mes'] = $this->getMes(date('m', $newdate));
            $dataAux['dataNormal'] = implode("/", array_reverse(explode("-", date('Y-m-d', $newdate))));
            array_push($datas, $dataAux);
        }          
        return $datas;
    }
    
    public function tickets(){            
        $refeicoesTickets = array();
        $refeicoesTickets['CAFÉ DA MANHÃ'] = 0;
        $refeicoesTickets['ALMOÇO']        = 0;
        $refeicoesTickets['CAFÉ COMPLETO'] = 0;
        $refeicoesTickets['CEIA']          = 0;      
        
        $this->set('refeicoesTickets', $refeicoesTickets);        
        $this->set('unidade', 'UTI NEO');
        $this->set('categoria', '');
    }            
    
    public function getMes($mes){
        switch($mes){
            case 1 : return "JAN"; break;
            case 2 : return "FEV"; break;
            case 3 : return "MAR"; break;
            case 4 : return "ABR"; break;
            case 5 : return "MAI"; break;
            case 6 : return "JUN"; break;
            case 7 : return "JUL"; break;
            case 8 : return "AGO"; break;
            case 9 : return "SET"; break;
            case 10: return "OUT"; break;
            case 11: return "NOV"; break;
            case 12: return "DEZ"; break;
        }
    }
    
    public function getDia($dia){
        switch($dia){
            case "Mon"  : return "S"; break;
            case "Tue"  : return "T"; break;
            case "Wed"  : return "Q"; break;
            case "Thu"  : return "Q"; break;
            case "Fri"  : return "S"; break;
            case "Sat"  : return "S"; break;
            case "Sun"  : return "D"; break;
        }
    }
        
}

?>
