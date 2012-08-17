<?php
/**
 * Description of Questionario
 *
 * @author Jonata Weber
 */
class Questionario extends AppModel { 
    
    var $useTable = 'questionario';                    
    
    var $belongsTo = array(                 
        'QuemRespondeu',
        'TipoComentario'=>array('type'=>'INNER')
        );                           
    
    var $hasMany = array(
        'Resposta'=>array(
            'type'=>'INNER',
            'dependent'=>true
            )
        );
    
       
    public function afterFind($results) {          
        foreach ($results as $key => $val) {                        
            foreach($results[$key]['Questionario'] AS $campo=>$valor){                                                
                $results[$key]['Questionario'][$campo] = ($results[$key]['Questionario'][$campo] != null)?($results[$key]['Questionario'][$campo]):('<i>Não Informado</i>');                
            }             
            $results[$key]['Questionario']['consultas'] = ($results[$key]['Questionario']['consultas'])?('Sim'):('Não');
            $results[$key]['Questionario']['exames'] = ($results[$key]['Questionario']['exames'])?('Sim'):('Não');           
            $results[$key]['Questionario']['internacao'] = ($results[$key]['Questionario']['internacao'])?('Sim'):('Não');
            $results[$key]['Questionario']['indicaria'] = ($results[$key]['Questionario']['indicaria'])?('Sim'):('Não');                  
            if (isset($val['Questionario']['registration'])) {                                                  
                $results[$key]['Questionario']['registration'] = $this->dateFormatAfterFind($val['Questionario']['registration'], false);                                
            }
        }        
        return $results;
    }
    
    public function dateFormatAfterFind($dateString, $time = true) {        
        if(!empty($dateString))
            if($time)
                return date('d/m/Y H:i:s', strtotime($dateString));
            else return date('d/m/Y', strtotime($dateString));
        else return null;
    }
    
}

?>
