<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$Professor = new Professor();

if (isset($_REQUEST["tr"])) {

	$arrayRetorno = array();

	$idProfessor = $_REQUEST["idProfessor"];
	$ordem = $_REQUEST["ordem"];

	$saida = $Professor -> selectProfessorCandidatoTr(" AND idProfessor = $idProfessor", true);

	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_professor";
	$arrayRetorno["ordem"] = $ordem;

	echo json_encode($arrayRetorno);
	exit ;
}

$where = " ";

$status = $_POST['status'];
if ($status != '')
	$where .= " AND inativo IN (" . $status . ")";
$nome = $_POST['nome'];
if( $nome != '' ) $where .= " AND nome like '%".$nome."%' ";

$idIdioma = $_POST['idIdioma'];

$prova = ( $_POST['prova'] == "1" ? 1 : 0);
$contratado = ( $_POST['contratado'] == "1" ? 1 : 0);
$naoUsar = ( $_POST['naoUsar'] == "1" ? 1 : 0);
if ($contratado == 0) {
	$where .= " AND P.candidato = 1";
}


if ($prova == 1) {
	$where .= " AND notaTeste IS NOT NULL";
}

if ($naoUsar == 0) {

$mes_ini = $_REQUEST['mes_ini'];
$ano_ini = $_REQUEST['ano_ini'];

$dataIni = $ano_ini.'-'.$mes_ini.'-01';

$mes_fim = $_REQUEST['mes_fim'];
$ano_fim = $_REQUEST['ano_fim'];

$dataFimT = $ano_fim.'-'.$mes_fim.'-01';
$dataFim = date("Y-m-t", strtotime($dataFimT));

$where .= " AND dataTeste BETWEEN '".$dataIni."' AND '".$dataFim."'";

}
//echo $where;
?>


<div id="lista_professor" class="lista">
<img src="<?php echo CAMINHO_IMG."lista.png"?>" width="32" title="Abrir Candidatos selecionados (Quadro Geral)" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD?>professor/candidato/quadroAll.php?ids='+AllIds(),'')" /> 
<img src="<?php echo CAMINHO_IMG."excelente.png"?>" width="32" title="Abrir Candidatos selecionados (Comportamental)" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD?>professor/candidato/quadroAll2.php?ids='+AllIds2(),'')" /> 
	<table id="tb_lista_professor" class="registros">
		<thead>
			<tr>
				<th>Nome</th>
                <th>Data de cadastro</th>
        		<th>Telefone</th>
        		<th>Quadro Geral</th>
				<th>Escrito</th>
                <th>Modalidade</th>
                <th>Bairro onde mora </th>
                <th>Como conheceu</th>
                <th>Comportamental</th>
                <th>Avaliação Oral e Nível</th>
                <th>Pedagógico (Global nã precisa)</th>
                <th>Análise Final</th>
                <th>Trilha enviada/ Prof. Assistiu</th>
			<!--	<th>Prof. Assistiu vídeos/ preencheu form de cada sessão?</th>-->
                <th>Integração</th>
                <th>Contrato Assinado</th>
                <th></th>
			</tr>
		</thead>
		<tbody>
			<?php echo $Professor -> selectProfessorCandidatoTr($where, false, $idIdioma); ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Nome</th>
                <th>Data de cadastro</th>
        		<th>Telefone</th>
        		<th>Quadro Geral</th>
				<th>Escrito</th>
           <th>Modalidade</th>
                <th>Bairro onde mora </th>
                <th>Como conheceu</th>
                <th>Comportamental</th>
                <th>Avaliação Oral e Nível</th>
                <th>Pedagógico (Global nã precisa)</th>
                <th>Análise Final</th>
                <th>Trilha enviada/ Prof. Assistiu</th>
			<!--	<th>Prof. Assistiu vídeos/ preencheu form de cada sessão?</th>-->
                <th>Integração</th>
                <th>Contrato Assinado</th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>

<script>
function toggleCheckbox(element) {
     $('#resumido').attr('checked', "checked");	
}
	eventDestacar(1);
	tabelaDataTable('tb_lista_professor'); 
	
function AllIds(){
    camposMarcados = new Array();
    $("input[type=checkbox][name='idh[]']:checked").each(function(){
        camposMarcados.push($(this).val());
    });
    return camposMarcados;
}

function AllIds2(){
    camposMarcados = new Array();
    $("input[type=checkbox][name='idhC[]']:checked").each(function(){
        camposMarcados.push($(this).val());
    });
    return camposMarcados;
}

</script>
