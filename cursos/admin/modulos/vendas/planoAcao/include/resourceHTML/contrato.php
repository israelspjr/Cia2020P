<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Contrato = new Contrato();
$PlanoAcao = new PlanoAcao();

$idPlanoAcao = $_GET['id'];

$pag = $PlanoAcao->selectPlanoAcao("WHERE idPlanoAcao = $idPlanoAcao");
$idGrupo = $pag[0]['grupo_idGrupo'];
//echo $idGrupo;
//Gerar Total com Debito e Credito
//$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

//for ($x=0;$x<count($ids);$x++) {
//	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
//}

//$valorx2 = implode(', ',$valorX);
?>

<fieldset>
  <legend>Contrato</legend>
 <!--Quando o Grupo não tem contrato, aparece o contrato da empresa.-->
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar contrato" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/include/form/contrato.php";?>?idPlanoAcao=<?php echo $idPlanoAcao?>', '<?php echo CAMINHO_VENDAS."planoAcao/include/resourceHTML/contrato.php?id=".$idPlanoAcao?>', '#div_lista_contrato2');" /></div><br /><br />

<table id="tb_lista_contrato" class="registros">
  <thead>
    <tr>
       <th>Nome</th>
      <th>Data de Cadastro</th>
      <th>Ver contrato</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $Contrato->selectContratoTr(CAMINHO_VENDAS."planoAcao/include/form/contrato.php", CAMINHO_VENDAS."planoAcao/include/resourceHTML/contrato.php?id=".$idPlanoAcao, "#div_lista_contrato2", "WHERE planoAcao_idPlanoAcao in (".$idPlanoAcao.")",$idPlanoAcaoGrupo);
	?>
  </tbody>
  <tfoot>
    <tr>
       <th>Nome</th>
       <th>Data de Cadastro</th>
      <th>Ver contrato</th>
      <th></th>
    </tr>
  </tfoot>
</table>

</fieldset>

<script>tabelaDataTable('tb_lista_contrato');</script> 

