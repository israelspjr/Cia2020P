<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicionalPlanoAcaoGrupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProdutoAdicional.class.php");


$ProdutoAdicionalPlanoAcaoGrupo = new ProdutoAdicionalPlanoAcaoGrupo();
$ProdutoAdicional = new ProdutoAdicional();
	
$idProdutoAdicionalPlanoAcaoGrupo = $_REQUEST['id'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de Produto adicional</legend>
    <form id="form_ProdutoAdicionalPlanoAcaoGrupo" class="validate"  method="post" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
      <p>
        <label>Prova:</label>
        <?php 
		$and = " AND idProdutoAdicional NOT IN (
			SELECT produtoAdicional_idProdutoAdicional FROM produtoAdicionalPlanoAcaoGrupo 
			WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo
		)";
		
		echo $ProdutoAdicional->selectProdutoAdicionalSelect("required", "", $and);?> <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Data do vínculo:</label>
        <input type="text" name="dataEntrada" id="dataEntrada" class="required data"/>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <button class="button blue" onclick="postForm('form_ProdutoAdicionalPlanoAcaoGrupo', '<?php echo CAMINHO_REL."grupo/include/acao/produtoAdicionalPlanoAcaoGrupo.php"?>')"> Enviar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
