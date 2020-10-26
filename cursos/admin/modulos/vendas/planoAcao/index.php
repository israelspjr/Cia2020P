<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();

//ATUALIZAR APENAS UMA LINHA
if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	
	$idPlanoAcao = $_REQUEST["idPlanoAcao"];
	$ordem = $_REQUEST["ordem"];
	
	$saida = $PlanoAcao->selectPlanoAcaoTr(" AND idPlanoAcao = $idPlanoAcao", true);
	
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_PlanoAcao";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}

//FILTROS
$idPlanoAcao = $_POST['idPlanoAcao'];
if($idPlanoAcao!="")
$where .= "AND PA.idPlanoAcao = ".$idPlanoAcao;

$dataCadastro = $_POST['dataCadastro'];
$dataCadastro2 = $_POST['dataCadastro2'];
if($dataCadastro && $dataCadastro2) $where .= " AND DATE(PA.dataCadastro) BETWEEN '".Uteis::gravarData($dataCadastro)."' AND '".Uteis::gravarData($dataCadastro2)."' ";

$dataAprovacao = $_POST['dataAprovacao'];
$dataAprovacao2 = $_POST['dataAprovacao2'];
if($dataAprovacao && $dataAprovacao2) $where .= " AND DATE(PA.dataAprovacao) BETWEEN '".Uteis::gravarData($dataAprovacao)."' AND '".Uteis::gravarData($dataAprovacao2)."' ";	

$idIdioma = implode(",",$_POST['idIdioma']);
if($idIdioma) $where .= " AND I.idIdioma IN(".$idIdioma.")";	

$clientePj_idClientePj = implode(",",$_POST['clientePj_idClientePj']);
if($clientePj_idClientePj) $where .= " AND CPJ.idClientePj IN(".$clientePj_idClientePj.")";	

$idRepresentante = implode(",",$_POST['idRepresentante']);
if($idRepresentante) $where .= " AND RE.idRepresentante IN(".$idRepresentante.")";	

$idStatusAprovacao = implode(",",$_POST['idStatusAprovacao']);
if($idStatusAprovacao) $where .= " AND PA.statusAprovacao_idStatusAprovacao IN(".$idStatusAprovacao.")";	

$IdNivelEstudo = implode(",",$_POST['IdNivelEstudo']);
if($IdNivelEstudo) $where .= " AND NE.IdNivelEstudo IN(".$IdNivelEstudo.")";

$idFocoCurso = implode(",",$_POST['idFocoCurso']);
if($idFocoCurso) $where .= " AND FC.idFocoCurso IN(".$idFocoCurso.")";	

$tipo = $_POST['tipoP'];
//echo $tipo;

$tipoCurso = $_REQUEST['idTipoCurso'];
if($tipoCurso != "-") {
	if($tipoCurso != "") {
	$where .= " AND PA.tipoCurso IN (".$tipoCurso.")";	
	}
}

//echo $where;
?>

<div class="lista">
  <table id="tb_lista_PlanoAcao" class="registros">
    <thead>
      <tr>
        <th></th>
        <th>idPlano(idProposta)</th>
        <th>Empresa</th>
        <th>Idioma</th>
        <th>Nível</th>
        <th>Foco</th>
        <th>Tipo Curso</th>
        <th>Integrantes</th>
        <th>Representante</th>
        <th>Data de abertura</th>
        <th>Data de aprovação</th>
        <th>Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $PlanoAcao->selectPlanoAcaoTr($where, "",$tipoP);?>
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th>idPlano(idProposta)</th>
        <th>Empresa</th>
        <th>Idioma</th>
        <th>Nível</th>
        <th>Foco</th>
        <th>Tipo Curso</th>
        <th>Integrantes</th>
        <th>Representante</th>
        <th>Data de abertura</th>
        <th>Data de aprovação</th>
        <th>Status</th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</div>
<script>
	tabelaDataTable('tb_lista_PlanoAcao', 'ordenaColuna');
	eventDestacar(1);
	
	function editarPA(x) {

$.ajax({
    url: "<?php echo CAMINHO_REL."grupo/include/acao/planoAcaoGrupo.php"?>",
    type: "POST",
    data: "idPlanoAcao="+x+"&acao=liberarPA",
    dataType: "html"

}).done(function(resposta) {
    alert(resposta);
//	$('#msg').html(resposta);
	$('#liberarPA').hide();
});
	
	
}
	
</script> 
