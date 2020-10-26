<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de aviso</legend>
    <form id="form_aviso" class="validate"  method="post" onsubmit="return false" >
      <p>
        <label>Titulo do aviso:</label>
        <input type="text" name="tituloAviso" id="tituloAviso" class="required" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Aviso:</label>
        <input type="text" name="aviso" id="aviso" class="required" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Data do aviso:</label>
        <input type="text" name="dataAviso" id="dataAviso" class="date required" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" onclick="postForm('form_aviso', '<?php echo PASTA_ATUAL?>include/acao/aviso.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 