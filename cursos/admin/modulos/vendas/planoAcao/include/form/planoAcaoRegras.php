<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Regras = new Regras();

$idPlanoAcao = $_GET['id'];

 
  ?>
  <form id="form_Regras" class="validate" action="" method="post" onsubmit="return false" >
    <?php echo $Regras->selectRegrasCheckbox($idPlanoAcao); ?> 
    <br />
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_Regras', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/planoAcaoRegras.php?id=$idPlanoAcao"?>');" >
        Enviar</button>
      </p>
    </div>
  </form>
</fieldset>
<script>ativarForm();</script> 
