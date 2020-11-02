<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Categoria = new Categoria();

//$idQuestao = $_GET['idQuestao'];	
$idCategoria = $_REQUEST['idCategoria'];



if($idCategoria!='' && $idCategoria>0){
	
	$valorCategoria = $Categoria->selectCategoria(' WHERE idCategoria='.$idCategoria);
	
	$idCategoria = $valorCategoria[0]['idCategoria'];
	$valor = $valorCategoria[0]['valor'];
	$inativo = $valorCategoria[0]['inativo'];
}

//if ($nivel == '') $nivel = 0;
?>

<div class="conteudo_nivel">

  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <center><legend>Cadastrar Categorias</legend></center>
  <fieldset>
     
  <form id="form_Categoria" class="validate" method="post" action="" onsubmit="return false" >
  <div class="esquerda">
  <input type="hidden" id="idCategoria" name="idCategoria" value="<?php echo $idCategoria?>" />
     
       <p>
          <label>Categoria:</label>          
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
        <button class="button blue" onclick="postForm('form_Categoria', '<?php echo CAMINHO_CAD?>categoria/grava.php?id=<?php echo $idCategoria?>')">Salvar</button>
        
      </p>
  </div>
          </div>

    
    </form>
  </fieldset>
</div>
</div>

<script>ativarForm();
/*function buscar(x){
  var idioma, retorno, idNivel;
  $( "#nivel" ).empty();
  if (x != '') {
	idNivel = x;
  } else {
  	idNivel = <?php //echo $nivel?>;
  }
//  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
//  status = $("#status:checked").val();
  idioma = $("#idIdioma option:selected").val();
  retorno = $.ajax({
    url:"<?php //echo CAMINHO_CAD."questoes/select_nivel.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{idioma:idioma,idNivel:idNivel}   
  });
  retorno.done(function( html ) {
    $( "#nivel" ).append( html );
  });
//  grupos();
}
$('#idIdioma').attr('onchange', 'buscar()');
//buscar(<?php //echo $nivel; ?>);

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
/*$('#add_file').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
/*	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
	}).submit();
});*/
</script> 