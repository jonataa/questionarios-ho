<?php

/**
 * Description of TipoComentario
 *
 * @author Jonata Weber
 */
class TipoComentario extends AppModel {
    
    var $useTable = 'tipo_comentario';        
    
    var $hasMany = 'Questionario';
    
    var $displayField = 'descricao';
    
}

?>
