<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaProfessor = new BuscaProfessor();

$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/busca.php";
$caminhoAtualizar2 = CAMINHO_REL."grupo/include/resourceHTML/aulaPermanenteGrupo.php";

if ($idPlanoAcaoGrupo == '') {
	$idPlanoAcaoGrupo = $_REQUEST['id'];	
}

if( isset($_REQUEST["tr"]) ){
	
	$arrayRetorno = array();
	
	$idPlanoAcaoGrupo = $_REQUEST["idPlanoAcaoGrupo"];
	$ordem = $_REQUEST["ordem"];
	
	$saida = $BuscaProfessor->selectBuscaProfessorTrGrupo(" AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo", $caminhoAtualizar, $ordem);
	
	$arrayRetorno["updateTr"] = $saida;
	$arrayRetorno["tabela"] = "#tb_lista_planoacao";
	$arrayRetorno["ordem"] = $ordem;
	
	echo json_encode($arrayRetorno);
	exit;		
}

?>

<fieldset>
  <legend>Busca de professores - Relacionamento</legend>
</fieldset>
<!--<button class="button blue" onclick="carregarModulo('<?php echo $caminhoAtualizar?>?id=<?php echo $idPlanoAcaoGrupo?>', '#buscaRelacimento');carregarModulo('<?php echo $caminhoAtualizar2?>?id=<?php echo $idPlanoAcaoGrupo?>', '#div_aulaPermanenteGrupo' )">Clique aqui</button> para atualizar esse quadro.-->
<div id="lista_planoacao" class="lista">
  <table id="tb_lista_planoacao" class="registros">
    <thead>
      <tr>
        <th>Dias</th>
        <th>Ofertas</th>
        <th>Professor</th>
        <th>Etapas</th> 
        <th>Enviar por e-mail</th>
      </tr>
    </thead>
    <tbody>
      <?php 	 
echo $BuscaProfessor->selectBuscaProfessorTrGrupo(" AND PAG.idPlanoAcaoGrupo =".$idPlanoAcaoGrupo, $caminhoAtualizar)?>
    </tbody>
    <tfoot>
      <tr>
        <th>Dias</th>
        <th>Ofertas</th>
        <th>Professor</th>
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
