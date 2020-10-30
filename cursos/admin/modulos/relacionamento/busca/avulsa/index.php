<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();
$Idioma = new Idioma();

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

$vBusca = $_REQUEST['busca'];
if (($vBusca != '-') && ($vBusca != '')) {
	$busca = $vBusca;
	
} 

$idIdioma = $_REQUEST['idIdioma'];
if (($idIdioma != '-') && ($idIdioma != '')) {
	
	$where = " AND idIdioma = ".$idIdioma;
}

?>

<fieldset>
	<legend>
		Busca de professores - Avulsa
	</legend>
</fieldset>
<div class="linha-inteira">
<fieldset>
<legend>Filtro</legend>
</fieldset>
<div class="esquerda">
<form id="form_filtra_Grupos" class="validate" method="post" action onsubmit="return false">
<label>Selecione um status: </label>

<input type="radio" name="busca" value="-" <?php if ((!isset($busca)) || ($busca == "-")){ echo "checked"; } ?>/>Todos<br />
<input type="radio" name="busca" value="1" <?php if ($busca == 1){ echo "checked"; } ?>/>Não tem professor<br />
<input type="radio" name="busca" value="2" <?php if ($busca == 2){ echo "checked"; } ?>/>Aguardando aprovação do coordenador<br />
<input type="radio" name="busca" value="3" <?php if ($busca == 3){ echo "checked"; } ?>/>Tudo OK<br />

<label>Selecione um idioma:</label>
<?php echo $Idioma->selectIdiomaSelect() ?>



<div class="linha-inteira">
        <button class="button blue" onclick="Enviar()">Buscar</button>
      </div>
</form>
</div>
</div>

<div class="menu_interno">
	<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro"
	onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."busca/avulsa/include/form/avulsa.php"?>', '<?php echo CAMINHO_REL."busca/avulsa/index.php"?>', '#centro');" />
</div>
<div id="lista_planoacao" class="lista">
	<table id="tb_lista_avulsa" class="registros">
		<thead>
			<tr>
				<th>Empresa</th>
                <th>Idioma</th>
                <th>A partir de</th>
				<th>Novo dia</th>
				<th>Dias</th>
				<th>Professor</th>
                <th>Coordenador</th>
                <th>Valor hora Aluno</th>
                <th>Enviar para o grupo </th>
                <th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
                echo $BuscaAvulsa->selectBuscaAvulsaTr($caminhoAtualizar, $where,false, $vBusca)
			?>
		</tbody>
		<tfoot>
			<tr>
				<th>Empresa</th>
                <th>Idioma</th>
                <th>A partir de</th>
				<th>Novo dia</th>
				<th>Dias</th>				
				<th>Professor</th>
                <th>Coordenador</th>
                <th>Valor hora Aluno</th>
                <th>Enviar para o grupo </th>       
                <th>Status</th>             
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>
<script>
	eventDestacar(2);
	//tabelaDataTable('tb_lista_avulsa', 'ordenaColuna');
    jQuery(document).ready( function() {
        jQuery('#tb_lista_avulsa').dataTable( {
            "aLengthMenu" :  [[25, 50, 100, 200, -1],[25, 50, 100, 200, "All"]],
			"iDisplayLength" : -1,
            "oLanguage" : {

                "sSearch":       "Buscar:",
                "sZeroRecords":  "Não foram encontrados resultados",
                "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ Registros",
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
            "aoColumns" : [ null, null, { "sType": "custom-date" },  null, null, null, null, null, null , null, null]
        } );
    } );
	
	function mudarStatus(x, y) {
		
		
		if (y == 1) {
			var cor = "red";
		} else if (y == 2) {
			var cor = "blue";
		} else if ( y == 3) {
			var cor = "green";
		}
		$('#'+x+'_'+y+'').css('color', cor);		

	$.ajax({
            method: "post",
            url: "<?php echo CAMINHO_REL."busca/avulsa/include/acao/mudarStatus.php"?>",
            data: "idBuscaAvulsa="+x+"&status="+y
        })
		.done(function(resposta) {
			alert("Status alterado com sucesso!");
    console.log(resposta);

});
	}
	
	function Enviar(){
    filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '/cursos/admin/modulos/relacionamento/busca/avulsa/index.php', '', '#centro')
}
</script>
