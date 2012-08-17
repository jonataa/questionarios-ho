<?php

/**
 * Description of GrupoItem
 *
 * @author Jonata Weber
 */
class GrupoItem extends AppModel {
    
    var $useTable = 'grupo_item';
    
    var $hasMany = array('item');
    
    var $displayField = 'descricao';
}

?>
