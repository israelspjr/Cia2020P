<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];

$idProfessor = $_REQUEST['idProfessor'];

?>
<p><strong><?php echo "$mes/$ano"?></strong></p>
<table id="tb_lista_Demonstrativo" class="registros">
  <thead>
    <tr>
      <th>Professor</th>
      <th>Demonstrativo</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	$caminhoAtualizar = CAMINHO_PAG."demonstrativo/consultoria/include/resourceHTML/demonstrativo.php?mes=".$mes."&ano=".$ano;
	echo $Professor->selectProfessorDemonstrativoConsultoriaTr($mes, $ano, "$caminhoAtualizar", "#lista_Demonstrativo", $idProfessor);
  ?>
  </tbody>
  <tfoot>
    <tr>
      <th>Professor</th>
      <th>Demonstrativo</th>
    </tr>
  </tfoot>
</table>

<script>tabelaDataTable('tb_lista_Demonstrativo');</script> 