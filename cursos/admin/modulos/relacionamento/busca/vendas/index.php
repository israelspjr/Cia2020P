<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaProfessor = new BuscaProfessor();
$Uf = new Uf();	
$Cidade = new Cidade();

$idUf = ID_UF;	
$cidadeIdCidade = ID_CIDADE;

$caminhoAtualizar = CAMINHO_REL."busca/vendas/index.php";

if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	
	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST["ordem"];
	
	$saida = $BuscaProfessor->selectBuscaProfessorTr(" AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo /*AND (B.tipoBusca_idTipoBusca = 3 OR  B.tipoBusca_idTipoBusca = 3)*/", $caminhoAtualizar, $ordem);
	
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_planoacao";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}

?>

<fieldset>
  <legend>Busca de professores - Vendas</legend>
</fieldset>
<div id="lista_planoacao" class="lista">
  <table id="tb_lista_planoacao" class="registros">
    <thead>
      <tr>
        <th>Grupo</th>
        <th>Plano de ação</th>
        <th>Dias</th>
        <th>Ofertas</th>
        <th>Professor</th>
        <th>Coordenador</th>
        <th>Etapas</th>
        <th>Enviar por e-mail</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $BuscaProfessor->selectBuscaProfessorTr(" /*AND (B.tipoBusca_idTipoBusca = 3 OR B.tipoBusca_idTipoBusca = 5)*/ ", $caminhoAtualizar)?>
    </tbody>
    <tfoot>
      <tr>
        <th>Grupo</th>
        <th>Plano de ação</th>
        <th>Dias</th>
        <th>Ofertas</th>
        <th>Professor</th>
        <th>Coordenador</th>
        <th>Etapas</th>
         <th>Enviar por e-mail</th>
      </tr>
    </tfoot>
  </table>
</div>
<script>
	eventDestacar(2);
	tabelaDataTable('tb_lista_planoacao');
	
</script> 
