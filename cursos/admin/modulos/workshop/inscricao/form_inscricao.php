<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$inscricao = new WorkshopPresenca();
?>
<fieldset>
    <legend>
      Cadastros de Workshops
    </legend>
    <form id="form_WorkshopPresenca" class="validate" method="post" onsubmit="return false" >
      <input type="hidden" name="idworkshop" id="idworkshop" value="<?php echo $valor[0]['idworkshop'];?>" />      
      <input type="hidden" name="excluido" id="excluido" value="<?php echo $valor[0]['excluido']?>"/>
      <input type="hidden" name="acao" id="acao" value="cadastrar"/>      
      <p>
        <label>Evento:</label>
        <?php
        $work = new Workshop();
        echo $work->selectWorkShopSelect($valor[0]['workshop_idWorkshop']);
        ?>
      </p>
      <p>
        <label>Professor:</label>
        <?php
          $Professor = new Professor();
          echo $Professor->selectProfessorSelect();
        ?> 
      </p>
      <p>
        <label>Funcionário:</label>
        <?php
          $Funcionario = new Funcionario();
          echo $Funcionario->selectFuncionarioSelect();
        ?> 
      </p>    
      <p>
        <label>Data do Evento:</label>
        <input type="text" name="dataEvento" id="dataEvento" class="required data" value="<?php echo $valor[0]['dataEvento']?>"/>
        <span class="placeholder">Campo Obrigatório</span>
      </p>     
      <p> 
        <label>Horário de Início:</label>
        <input type="text" name="inicio" id="inicio" class="required hora" value="<?php echo $valor[0]['inicio']?>"/>
        <span class="placeholder">Campo Obrigatório</span>       
      </p>
      <p> 
        <label>Horário de Término:</label>
        <input type="text" name="termino" id="termino" class="required hora" value="<?php echo $valor[0]['termino']?>"/>
        <span class="placeholder">Campo Obrigatório</span>       
      </p>
      <p>
        <label>Finalizado:</label>
        <input type="checkbox" name="finalizado" id="finalizado" value="1" <?php ($valor[0]['finalizado'])? "Checked":""; ?>/>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_workshop', '<?php echo CAMINHO_EVENTOS?>inscricao/acao.php')">
          Enviar
        </button>
      </p>
    </form>
  </fieldset>
<script>
ativarForm();
</script>
