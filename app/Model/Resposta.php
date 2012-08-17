<?php

/**
 * Description of Resposta
 *
 * @author Jonata Weber
 */
class Resposta extends AppModel {
    
    var $useTable = 'resposta';               
   
    var $belongsTo = array(
        'Item'=>array('type'=>'INNER'),
        'RespostaItem'=>array('type'=>'INNER'),
        'Questionario'=>array('type'=>'INNER')
        );       
    
    
}

?>
