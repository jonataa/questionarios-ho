<?php

/**
 * Description of Item
 *
 * @author Jonata Weber
 */
class Item extends AppModel {
    
    var $useTable = 'item';
    
    var $belongsTo = array('GrupoItem'=>array('type'=>'INNER'));
    
    var $hasMany = array('Resposta');
    
}

?>
