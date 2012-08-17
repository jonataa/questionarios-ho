<?php

/**
 * Description of RespostaItem
 *
 * @author Jonata Weber
 */
class RespostaItem extends AppModel {
    
    var $useTable = 'resposta_item';
    
    var $hasMany = array('Resposta');
    
}

?>
