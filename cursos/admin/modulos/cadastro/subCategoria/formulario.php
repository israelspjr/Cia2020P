<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$SubCategoria = new SubCategoria();
$Categoria = new Categoria();

//$idQuestao = $_GET['idQuestao'];	
$idSubCategoria = $_REQUEST['idSubCategoria'];



if($idSubCategoria!='' && $idSubCategoria>0){
	
	$valorSubCategoria = $SubCategoria->selectSubCategoria(' WHERE idSubCategoria='.$idSubCategoria);
	
	$idSubCategoria = $valorSubCategoria[0]['idSubCategoria'];
	$valor = $valorSubCategoria[0]['valor'];
	$inativo = $valorSubCategoria[0]['inativo'];
	$idCategoria = $valorSubCategoria[0]['categoria_idCategoria'];
}

//if ($nivel == '') $nivel = 0;
?>

<div class="conteudo_nivel">

  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <center><legend>Cadastrar Sub-categorias</legend></center>
  <fieldset>
     
  <form id="form_SubCategoria" class="validate" method="post" action="" onsubmit="return false" >
  <div class="esquerda">
  <input type="hidden" id="idSubCategoria" name="idSubCategoria" value="<?php echo $idSubCategoria?>" />
     <p><label>Categoria</label>
     <?php echo $Categoria->selectCategoriaSelect("required", $idCategoria)?>
       <p>
          <label>Sub-categoria:</label>          
          <input type="text" name="valor" id="valor"  class="required" style="width: 80%;" onsubmit="return false" value="<?php echo $valor?>" />
      <span class="placeholder">Campo Obrigatório</span>
 
        </p>
        
  
          <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
        </div>
     
        
        <div class="linha-inteira">
          <p>
        <button class="button blue" onclick="postForm('form_SubCategoria', '<?php echo CAMINHO_CAD?>subCategoria/grava.php?id=<?php echo $idSubCategoria?>')">Salvar</button>
        
      </p>
  </div>
          </div>

    
    </form>
  </fieldset>
</div>
</div>

<script>ativarForm();

</script> 