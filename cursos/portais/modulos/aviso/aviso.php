<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Aviso = new Aviso();
$NewsProfessor = new NewsProfessor();

$caminhoAbrir = "cursos/portais/aviso/avisoForm.php";
$caminhoAtualizar = "cursos/portais/aviso/aviso.php?id=".$_SESSION['idClientePf_SS']; 
$onde = "#centro";
$where = " WHERE clientePf_idClientePf = ".$_SESSION['idClientePf_SS'];

?>

<fieldset>
 <p>&nbsp;</p>
<legend>ÚLTIMOS AVISOS</legend>

<?php

$valor2 = $NewsProfessor->selectNewsProfessor(" WHERE portal = 2 AND inativo = 0 AND popup = 1 ".$add. " ORDER BY idNewsProfessor DESC");
 
$valor = $NewsProfessor->selectNewsProfessor(" WHERE portal = 3 AND inativo = 0 ".$add. " ORDER BY idNewsProfessor DESC");
//Uteis::pr($valor);

foreach ($valor as $value) {

//echo "<pre>";
echo $value['news'];
echo "<hr style=\"    border-top: 1px dashed black;\">";
//echo "</pre>";
	
}


 
 
foreach ($valor as $value) {

	?>


<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
   <!--     <h5 class="modal-title" id="exampleModalLabel"><center><strong>Campanha Social</strong><center></h5>-->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!--  <span aria-hidden="true">&times;</span>-->
        </button>
      </div>
      <div class="modal-body">
        <?php echo $value['news'] ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      <!--  <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
<?php 
	
}
    ?> 

<script>
	
$('#exampleModal2').modal('show');

</script>
