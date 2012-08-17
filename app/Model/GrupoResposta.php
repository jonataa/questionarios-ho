<?php

/**
 * Description of GrupoResposta
 *
 * @author Jonata Weber
 */
class GrupoResposta extends AppModel {
    
    var $useTable = 'grupo_resposta';                
    
    var $hasMany = array(
        'Resposta'=>array(
            'foreignKey'=>'grupo_resposta_id'),
        'Questionario'=>array(
            'foreignKey'=>'grupo_resposta_id'
            )
        );
}

?>
