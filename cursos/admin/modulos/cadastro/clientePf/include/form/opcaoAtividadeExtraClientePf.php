<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$TipoAtividadeExtra = new TipoAtividadeExtra();

$idClientePf = $_GET['id'];
?>

<fieldset>
  <legend>Caracteristicas</legend>
  <div class="menu_interno"><img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CONFIG."atividadeextra/formulario.php";?>', '', '#');" /></div>
  <form id="form_atividadeExtra" class="validate" action="" method="post" onsubmit="return false" >
    <?php echo $TipoAtividadeExtra->selectTipoatividadeextraDiv($idClientePf) ?> <br />
    <div class="linha-inteira">
      <p>
        <button class="button blue" onclick="postForm('form_atividadeExtra', '<?php echo CAMINHO_CAD."clientePf/include/acao/opcaoAtividadeExtraClientePf.php?id=$idClientePf"?>');" >Salvar</button>
      </p>
    </div>
  </form>
</fieldset>
<script>ativarForm();</script> 
