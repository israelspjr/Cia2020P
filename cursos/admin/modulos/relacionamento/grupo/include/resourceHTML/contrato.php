<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Contrato.class.php");

$Contrato = new Contrato();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];

$pag = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
$idGrupo = $pag[0]['grupo_idGrupo'];

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}

$valorx2 = implode(', ',$valorX);
?>
 <div id="div_contrato_clientepj" class="lista">
<fieldset>
  <legend>Contrato</legend>
 <!--Quando o Grupo não tem contrato, aparece o contrato da empresa.-->
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="cadastrar contrato" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/contrato.php";?>?idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/contrato.php?id=".$idPlanoAcaoGrupo?>', '#div_contrato_clientepj');" /></div><br /><br />

<table id="tb_lista_contrato2" class="registros">
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
	echo $Contrato->selectContratoTr(CAMINHO_REL."grupo/include/form/contrato.php", CAMINHO_REL."grupo/include/resourceHTML/contrato.php?id=".$idPlanoAcaoGrupo, "#div_contrato_clientepj", "WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")",$idPlanoAcaoGrupo);
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
</div>
<script>tabelaDataTable('tb_lista_contrato2');</script> 

