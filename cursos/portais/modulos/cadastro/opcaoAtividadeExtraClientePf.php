<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$TipoAtividadeExtra = new TipoAtividadeExtra();

$idClientePf = $_SESSION['idClientePf_SS']; //$_GET['id'];
?>

<fieldset>
  <legend>Caracteristicas</legend>
  <div class="menu_interno"></div>
  <form id="form_atividadeExtra" class="validate" action="" method="post" onsubmit="return false" >
    <?php echo $TipoAtividadeExtra->selectTipoatividadeextraDiv($idClientePf) ?> <br />
    <div class="linha-inteira">
    <div id="passo" style="display:none">
<label>
Passo 2 de 3
</label>
<a href="#" onclick="carregarModulo('modulos/cadastro/opcaoAtividadeExtraProfessorClientePf.php', '#centro');" >Clique aqui para ir para proximo passo.</a>
</div>
      <p>
        <button class="Bblue" id="salvou" onclick="enviar()">Salvar</button>
      </p>
    </div>
  </form>
</fieldset>
<script>
//ativarForm();
function enviar() {
	enviadoOK();
	postForm('form_atividadeExtra', '<?php echo "modulos/cadastro/opcaoAtividadeExtraClientePfAcao.php?id=".$idClientePf?>')
	
	window.setTimeout('funcao()', 3000);
	
}
function funcao() {
	document.getElementById("passo").style.display = "block";
}

//$('#salvou').attr('onclick','enviar()')

</script> 
