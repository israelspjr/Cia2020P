<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Contrato.class.php");

	$Contrato = new Contrato();
	
	$idProfessor = $_GET['id'];
?>
<fieldset>
  <legend>Arquivos digitalizados</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."contrato/include/form/contrato.php";?>?idProfessor=<?php echo $idProfessor?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/contrato.php?id=".$idProfessor?>', '#div_contrato_professor');" /> </div>
<div id="div_lista_contrato" class="lista">
<table id="tb_lista_contratoP" class="registros">
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
	echo $Contrato->selectContratoTr(CAMINHO_CAD."contrato/include/form/contrato.php", CAMINHO_CAD."professor/include/resourceHTML/contrato.php?id=".$idProfessor, "#div_contrato_professor", "WHERE professor_idProfessor = ".$idProfessor);
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
</div>
</fieldset>
<script>tabelaDataTable('tb_lista_contratoP');</script> 

