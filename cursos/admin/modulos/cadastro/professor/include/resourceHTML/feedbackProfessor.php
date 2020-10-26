<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FeedbackProfessor = new FeedbackProfessor();	
$idProfessor = $_GET['id'];	
?>
<fieldset>
  <legend>Aulas assistidas</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/include/form/feedbackProfessor.php";?>?idProfessor=<?php echo $idProfessor?>', '<?php echo CAMINHO_CAD."professor/include/resourceHTML/feedbackProfessor.php?id=".$idProfessor?>', '#div_feedback_professor');" /> </div>
  <div id="div_lista_feeds" class="lista">
<table id="tb_lista_feedbackProfessor" class="registros">
  <thead>
    <tr>
   <!--   <th>Anexo</th>-->
      <th>Data aula assistida</th>
      <th>Grupo</th>
      <th>Status</th>
      <th>Nota</th>
      <th>Quem assistiu ? </th>
  <!--    <th>Feedback</th>-->
 
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $FeedbackProfessor->selectFeedbackProfessorTr(CAMINHO_CAD."professor/include/form/feedbackProfessor.php", CAMINHO_CAD."professor/include/resourceHTML/feedbackProfessor.php?id=".$idProfessor, "#div_feedback_professor", " WHERE professor_idProfessor = ".$idProfessor);
	?>
  </tbody>
  <tfoot>
    <tr>
    <!--  <th>Anexo</th>-->
      <th>Data aula assistida</th>
       <th>Grupo</th>
      <th>Status</th>
      <th>Nota</th>
      <th>Quem assistiu ? </th>
  <!--    <th>Feedback</th>-->
       <th></th>
    </tr>
  </tfoot>
</table>
</div>
</fieldset>
<script> tabelaDataTable('tb_lista_feedbackProfessor', 'simples');</script> 
