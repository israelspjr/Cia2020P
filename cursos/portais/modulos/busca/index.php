<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");

$BuscaAvulsa = new BuscaAvulsa();

$caminhoAtualizar = CAMINHO_REL . "busca/avulsa/index.php";

if (isset($_REQUEST["tr"])) {

	$arrayRetorno = array();

	$idBuscaAvulsa = $_REQUEST["idBuscaAvulsa"];
	$ordem = $_REQUEST["ordem"];

	$saida = $BuscaAvulsa -> selectBuscaAvulsaTr($caminhoAtualizar, " AND B.idBuscaAvulsa = $idBuscaAvulsa", $ordem);

	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_avulsa";
	$arrayRetorno["ordem"] = $ordem;

	echo json_encode($arrayRetorno);
	exit ;
}
$idProfessor = $_SESSION['idProfessor_SS'];

?>

<fieldset>
	<legend>
		Vagas Disponiveis 
	</legend>
</fieldset>

<div id="lista_planoacao" class="lista">
	<table id="tb_lista_avulsa" class="registros">
		<thead>
			<tr>
				<th>Empresa</th>
                <th>Idioma</th>
                <th>A partir de</th>
				<th>Dias</th>
				<th>Endereço</th>
                <th>Tenho Interesse </th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
                echo $BuscaAvulsa->selectBuscaAvulsaProfessorTr($caminhoAtualizar, " AND B.status != 3",false,$idProfessor)
			?>
		</tbody>

	</table>
</div>
<script>
	eventDestacar(2);
  /*  jQuery(document).ready( function() {
        jQuery('#tb_lista_avulsa').dataTable( {
            "aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
            "oLanguage" : {

                "sSearch":       "Buscar:",
                "sZeroRecords":  "Não foram encontrados resultados",
                "sInfo":         "Mostrando de START até END de TOTAL Registros",
                "sLengthMenu":   "_MENU_ Registros",
                "sInfoFiltered": "(filtrado de MAX Total de Registros)",
                "sInfoEmpty":    "Mostrando de 0 até 0 de 0 Registros" ,
                "oPaginate": {
                    "sFirst":    "&lt;&lt;",
                    "sPrevious": "&lt;",
                    "sNext":     "&gt;",
                    "sLast":     "&gt;&gt;"
                }},
            "sPaginationType" : "full_numbers",
            "bInfo": true,
            "bJQueryUI" : true,
            "aoColumns" : [ null, null, { "sType": "custom-date" },  null, null, null ]
        } );
    } );*/
</script>
