<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$idiomaProfessor= new IdiomaProfessor();

if( isset($_REQUEST["tr"]) ){
    
    $arrayRetorno = array();
    
    $idProfessor = $_REQUEST["idProfessor"];
	$ordem = $_REQUEST["ordem"];
    $saida = $Professor->selectProfessorContratadoTr(" AND P.idProfessor = $idProfessor", true, 1);
    $arrayRetorno["updateTr"] = $saida;
    $arrayRetorno["tabela"] = "#tb_lista_professor";
    $arrayRetorno["ordem"] = $ordem;
    
    echo json_encode($arrayRetorno);
    exit;       
}

require ("include/acao/filtro.php");

$menor5grupos = isset($_REQUEST['menor5grupos'])? $_REQUEST['menor5grupos']: 0;
$excluido = isset($_REQUEST['excluido'])? $_REQUEST['excluido']: 0;
if ($excluido == 1) {
	$where .= " AND P.excluido = 1";
} else {
	$where .= " AND P.excluido = 0";
}

$terceiro = isset($_REQUEST['terceiro'])? $_REQUEST['terceiro']: 0;

?>
<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_filtra_Grupos', '<?php echo CAMINHO_CAD."professor/contratado/include/acao/professor.php"?>')"> Exportar relatório</button>
</div>
  <div id="lista_professor" class="lista">
    <table id="tb_lista_professor" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Idioma</th>
          <th>Nível</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Skype</th>
          <th>Grupos</th>
          <th>Status</th>
          <th>Obs</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Professor->selectProfessorContratadoTr($where, false, $comgrupos, $menor5grupos, false, $terceiro);?>

      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Idioma</th>
          <th>Nível</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Skype</th>
          <th>Grupos</th>
          <th>Status</th>
          <th>Obs</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
 //   tabelaDataTable('tb_lista_professor');
    eventDestacar(1);
	
	$(document).ready( function() {
  $('#tb_lista_professor').dataTable( {
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		"iDisplayLength": -1,
		 "oLanguage" : {
		
		"sSearch":       "Buscar:",
	    "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ Registros",
		"sLengthMenu":   "_MENU_ Registros",
		 "sInfoFiltered": "(filtrado de _MAX_ Total de Registros)",
		 "sInfoEmpty":    "Mostrando de 0 até 0 de 0 Registros" ,
		 "oPaginate": {
        "sFirst":    "&lt;&lt;",
        "sPrevious": "&lt;",
        "sNext":     "&gt;",
        "sLast":     "&gt;&gt;"
    }},
        "sPaginationType" : "full_numbers", 
		"bInfo": true,
//		"order": [[1, "asc"]],
		"bJQueryUI" : true,
        "aoColumns" : [  null,  null, null, null, null, null, null, null, null ]
  } );
} );

	
</script> 
