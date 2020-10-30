<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$Grupo = new Grupo();
$Gerente = new Gerente();

$caminhoAbrir2 = CAMINHO_REL."grupo/cadastro.php";
$caminhoAtualizar2 = CAMINHO_REL."grupo/index.php";
$onde2 = "tr";

if(isset($_REQUEST["tr"])){
    
	$arrayRetorno = array();
	
	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST["ordem"];
	
	$saida2 = $Grupo->selectGrupoTr($caminhoAbrir2, $caminhoAtualizar2, $onde2, " WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo", true, $aluno, $ArrIdiomas);
	
	$arrayRetorno["updateTr"] = $saida2;
	$arrayRetorno["tabela"] = "#tb_lista_Grupo";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}

//FILTROS
//print_r($_POST);
$where = "WHERE PAG.inativo = 0 ";
$status =  $_POST['status'];
if($status != "-"){
if( $status != '' ) $where .= " AND CL.inativo = ".$status;
}

$tp = $_POST['tipoContrato'];
if($tp != "-") {
	if ($tp == 0) {
	 $where .= " AND PA.tipoContrato is null ";	
	} else {
	 $where .= " AND PA.tipoContrato = ".$tp;
	}
}

$IdClientePj = $_POST['clientePj_idClientePj'];
if($IdClientePj != "-"){
if($IdClientePj!= "") $where .= " AND CL.idClientePj = ".$IdClientePj; 
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GT.gerente_idGerente in (".$IdGerente.")"; 
}

$statusG = $_POST['statusG'];
if($statusG != "-"){
if($statusG!= "") $where .= " AND G.inativo = ".$statusG; 
}

$grupo_idGrupo = $_POST['grupo_idGrupo'];
if($grupo_idGrupo != "-"){
if($grupo_idGrupo!= "") $where .= " AND G.idGrupo = ".$grupo_idGrupo; 
}
//$aluno = $_POST['aluno'];


$IdIdioma = implode(",", $_POST['idIdioma']);
if($IdIdioma != "-"){
if($IdIdioma!= "") {
	$ArrIdiomas = $_POST['idIdioma'];
	}
}

//echo "//".$where;
?>
<div class="lista">
  <table id="tb_lista_Grupo" class="registros">
    <thead>
      <tr>
        <th>Grupo</th>
        <th>Cliente p. jurídica</th>
        <th>Alunos</th>
        <th>Nível</th>
        <th>Idioma</th>
        <th>Tipo Contrato</th>
        <th>Tipo Curso</th>
        <th>Professor</th>
        <th>Carga horária Fixa </th>
        <th>Data incio</th>
        <th>Data Fechamento</th>
        <th>Término previsto</th>
        
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $Grupo->selectGrupoTr($caminhoAbrir2, $caminhoAtualizar2, $onde2, $where,"",$aluno, $ArrIdiomas);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Grupo</th>
        <th>Cliente p. jurídica</th>
        <th>Alunos</th>
        <th>Nível</th>
        <th>Idioma</th>
        <th>Tipo Contrato</th>
        <th>Tipo Curso</th>        
        <th>Professor</th>
        <th>Carga horária Fixa </th>
        <th>Data incio</th>
        <th>Data Fechamento</th>
          <th>Término previsto</th>
        <th>Status</th>
      </tr>
    </tfoot>
  </table>
</div>
<script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/date-eu.js"></script>
<script>
//	tabelaDataTable('tb_lista_Grupo');
$(document).ready( function() {
  $('#tb_lista_Grupo').dataTable( {
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
        "aoColumns" : [  null,  null, null,
					 null, null, null, null, null, null,  { "sType": "custom-date" },  { "sType": "custom-date" }, { "sType": "custom-date" }, null ]
  } );
} );


</script> 
