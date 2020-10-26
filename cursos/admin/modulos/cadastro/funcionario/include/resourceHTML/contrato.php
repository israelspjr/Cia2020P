<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Contrato = new Contrato();
$idFuncionario = $_REQUEST['id'];
?>


<fieldset>
  <legend>Documentos</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."funcionario/include/form/contrato.php?idFuncionario=".$idFuncionario?>', '<?php echo CAMINHO_CAD."funcionario/include/resourceHTML/contrato.php?id=".$idFuncionario?>', '#div_contrato_funcionario');" /> </div>
<div id="div_lista_contrato" class="lista">
<table id="tb_lista_contrato" class="registros">
  <thead>
       <tr>
          <th>Nome</th>
          <th>Data de Cadastro</th>
          <th>Ver Doc</th>
           <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
	echo $Contrato->selectContratoTr(CAMINHO_CAD."contrato/include/form/contrato.php", CAMINHO_CAD."funcionario/include/resourceHTML/contrato.php?id=".$idFuncionario, "#div_contrato_funcionario", "WHERE funcionario_idFuncionario in ( ".$idFuncionario.")","","",$_SESSION['idFuncionario_SS'] );
	?>
      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Data de Cadastro</th>
          <th>Ver Doc</th>
            <th></th>
        </tr>
  </tfoot>
</table>
</div>
</fieldset>
<script>tabelaDataTable('tb_lista_contrato');</script> 

