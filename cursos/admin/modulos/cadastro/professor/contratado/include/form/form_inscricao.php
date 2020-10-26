<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$inscricao = new WorkshopPresenca();
//$idProfessor = $_POST['idProfessor'];

?>
<fieldset>
    <legend>
      Cadastros de Participação em Workshops
    </legend>
    <form id="form_WorkshopPresenca" class="validate" method="post" onsubmit="return false" >
    <!--  <input type="hidden" name="idworkshop" id="idworkshop" value="<?php echo $valor[0]['idworkshop'];?>" /> -->     
      <input type="hidden" name="excluido" id="excluido" value="<?php echo $valor[0]['excluido']?>"/>
      <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor?>"/>
      <input type="hidden" name="acao" id="acao" value="cadastrar"/>      
      <p>
        <label>Evento:</label>
        
		<input type="text" name="evento" id="evento" class="required " value="<?php echo $valor[0]['workshop_idWorkshop']?>"/>
        <span class="placeholder">Campo Obrigatório</span>
      <!-- // $work = new Workshop();
       // echo $work->selectWorkShopSelect($valor[0]['workshop_idWorkshop']);
        -->
      </p>
      <p>
        <label>Professor:</label>
        <?php
          $Professor = new Professor();
          echo $Professor->getNome($idProfessor); //selectProfessorSelect();
        ?> 
      </p>
  <!--    <p>
        <label>Funcionário:</label>
        <?php
          //$Funcionario = new Funcionario();
          //echo $Funcionario->selectFuncionarioSelect();
        ?> 
      </p>    -->
      <p>
        <label>Data do Evento:</label>
        <input type="text" name="dataEvento" id="dataEvento" class="required data" value="<?php echo $valor[0]['dataInscricao']?>"/>
        <span class="placeholder">Campo Obrigatório</span>
      </p>     
      <p> 
        <label>Duração do evento:</label>
        <input type="text" name="inicio" id="inicio" class="required hora" value="<?php echo $valor[0]['duracao']?>"/>
        <span class="placeholder">Campo Obrigatório</span>       
      </p>
    
      <p>
        <button class="button blue" onclick="postForm('form_WorkshopPresenca', '<?php echo CAMINHO_CAD."professor/contratado/include/acao/inscricao.php"?>')">
          Enviar
        </button>
      </p>
    </form>
  </fieldset>
<script>
ativarForm();
</script>
