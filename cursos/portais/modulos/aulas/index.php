<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$FeedbackProfessor = new FeedbackProfessor();	
$idProfessor = $_SESSION['idProfessor_SS'];	
?>
<fieldset>
  <legend>Aulas assistidas</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="zerarCentro();carregarModulo('<?php echo "modulos/aulas/feedbackProfessor.php";?>?idProfessor=<?php echo $idProfessor?>', '#centro');" /> </div>
  <div id="div_lista_feeds" class="lista">
<table id="tb_lista_feedbackProfessor" class="registros">
  <thead>
    <tr>
     <!-- <th>Anexo</th>-->
      <th>Data aula assistida</th>
      <th>Grupo</th>
      <th>Status</th>
      <th>Nota</th>
      <th>Professor Assistido</th>
       <th>Feedback</th>
      <th></th>
      
    </tr>
  </thead>
  <tbody>
    <?php 
	echo $FeedbackProfessor->selectFeedbackProfessorTrProfessor("modulos/aulas/feedbackProfessor.php", "modulos/aulas/feedbackProfessor.php?id=".$id, "#div_feedback_professor", " WHERE quemAssistiu = ".$idProfessor);
	?>
  </tbody>
  <tfoot>
    <tr>
   <!--   <th>Anexo</th>-->
      <th>Data aula assistida</th>
       <th>Grupo</th>
      <th>Status</th>
      <th>Nota</th>
      <th>Professor Assistido</th>
       <th>Feedback</th>
 	<th></th>
     
    </tr>
  </tfoot>
</table>
</div>
</fieldset>
<script> //tabelaDataTable('tb_lista_feedbackProfessor', 'simples');</script> 
