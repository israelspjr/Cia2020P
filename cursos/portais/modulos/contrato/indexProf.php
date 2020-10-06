<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

	$Contrato = new Contrato();
?>
<fieldset>
  <legend>Contrato</legend>
<div id="div_lista_contrato" class="lista">
<table id="tb_lista_contratoP" class="registros">
  <thead>
    <tr>
       <th>Nome</th>
       <th>Data de Cadastro</th>
      <th>Ver contrato</th>
     
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $Contrato->selectContratoTr("", "", "#div_contrato_professor", "WHERE professor_idProfessor = ".$_SESSION['idProfessor_SS']."","",1);
	?>
  </tbody>
 
</table>
</div>
</fieldset>
<script>//tabelaDataTable('tb_lista_contratoP','simples');</script> 

