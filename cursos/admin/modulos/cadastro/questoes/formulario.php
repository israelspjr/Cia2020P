<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Questao = new Questao();
$TipoQuestao = new TipoQuestao();
$Idioma = new Idioma();
$NivelEstudo = new NivelEstudo();
$Categoria = new Categoria();
$FocoCurso = new FocoCurso();


$idQuestao = $_GET['id'];	



if($idQuestao!='' && $idQuestao>0){
	
	$valorQuestao = $Questao->selectQuestao(' WHERE idQuestao='.$idQuestao);
	
	$idQuestao = $valorQuestao[0]['idQuestao'];
	$tipoQ = $valorQuestao[0]['tipoQuestao_idTipoQuestao'];
	$nivel = $valorQuestao[0]['nivelEstudo_idNivelEstudo'];
	$titulo = $valorQuestao[0]['titulo'];
	$enunciado = $valorQuestao[0]['enunciado'];
	$foto = $valorQuestao[0]['imagem'];
	$inativo = $valorQuestao[0]['inativo'];
	$idQuestaoPai = $valorQuestao[0]['questao_IdQuestao'];
    $idioma = $valorQuestao[0]['idioma_idIdioma'];
	$idCategoria = $valorQuestao[0]['categoria'];
	$subCategoria = $valorQuestao[0]['subCategoria'];
	$tempo = Uteis::exibirHoras($valorQuestao[0]['tempo']);
	$audio = $valorQuestao[0]['audio'];
	$idFocoCurso = $valorQuestao[0]['idFocoCurso'];
	$idKitMaterial = $valorQuestao[0]['idKitMaterial'];
	$audio2 = $valorQuestao[0]['audio2'];
	$audio3 = $valorQuestao[0]['audio3'];
	$audio4 = $valorQuestao[0]['audio4'];
}


if ($nivel == '') $nivel = 0;
if ($idCategoria == '') $idCategoria = 0;
if ($subCategoria == '') $subCategoria = 0;

$valorFilhas = $Questao-> selectQuestao(" WHERE questao_IdQuestao = ".$idQuestao);

?>

<div class="conteudo_nivel">
<style>
video {
	width:100%;
	height:30px;	
}
</style>

  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <center><legend>Cadastrar questão</legend></center>
  <fieldset>
    <form id="formularioPf" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."questoes/grava.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="foto" />
      <input type="hidden" id="destino" name="destino" value="#visualizar" />
      <input type="file" id="add_foto" name="foto" onchange="postFileForm('formularioPf')" />
    </form>
    
     <form id="formularioM" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."questoes/grava.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="audio" />
      <input type="hidden" id="destinoM" name="destinoM" value="#visualizarM" />
      <input type="file" id="add_audio" name="audio" onchange="postFileForm('formularioM')" />
    </form>
    
      <form id="formularioM2" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."questoes/grava.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="audio2" />
      <input type="hidden" id="destinoM2" name="destinoM2" value="#visualizarM2" />
      <input type="file" id="add_audio2" name="audio2" onchange="postFileForm('formularioM2')" />
    </form>
    
      <form id="formularioM3" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."questoes/grava.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="audio3" />
      <input type="hidden" id="destinoM3" name="destinoM3" value="#visualizarM3" />
      <input type="file" id="add_audio3" name="audio3" onchange="postFileForm('formularioM3')" />
    </form>
    
      <form id="formularioM4" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD."questoes/grava.php"?>" style="display:none;" >
      <input type="hidden" id="acao" name="acao" value="audio4" />
      <input type="hidden" id="destinoM4" name="destinoM4" value="#visualizarM4" />
      <input type="file" id="add_audio4" name="audio4" onchange="postFileForm('formularioM4')" />
    </form>
    
  <form id="form_Questao" class="validate" method="post" action="" onsubmit="return false" >
  <div class="esquerda"> 
  <p>  <label>Tipo da questão:</label>
     <?php echo $TipoQuestao->selectTipoQuestaoSelect("required",$tipoQ);?>
   </p>
   
   <p>  <label>Idioma:</label>
     <p onchange="idioma()"><?php echo $Idioma->selectIdiomaSelect("required",$idioma);?></p>
   </p>
   
   <div id="focoDoCurso"></div>
        <div id="nivelDoCurso"></div>
        <?php if ($idQuestao != '' && $idQuestao > 0) { ?>
        <p>
          <label>Foco do curso:</label>
          <?php 		
		$sql = "INNER JOIN focoCursoIdioma AS FI ON FI.focoCurso_idFocoCurso = F.idFocoCurso ";
		$sql .= "INNER JOIN idioma AS I ON I.idIdioma = FI.idioma_idIdioma AND I.idIdioma = ".$idioma;
		
		echo $FocoCurso->selectFocoCursoSelect("required inf", $idFocoCurso, $sql);?>
          <span class="placeholder">Campo obrigatório</span>
          </p>
        <p>
          <label>Nível:</label>
          <?php 
			$sql = " INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo ";
			$sql .= "INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma AND I.idIdioma = ".$idioma;
		
			echo $NivelEstudo->selectNivelEstudoSelect("required inf", $nivel, $sql);?>
          <span class="placeholder">Campo obrigatório</span>
          </p>
          <?php } ?>
   
  <!--  <p>  <label>Nivel:</label>
    <div id="nivel"></div>
     <?php //echo $Idioma->selectIdiomaSelect("required",$idioma);?>
   </p>-->
   
   <div id="kitMaterial"></div>
        </p>
        <p> 
        <div id="nomeMaterial"></div>
        </p> 
   
   <p><label>Categoria:</label>
   <?php echo $Categoria->selectCategoriaSelect("required",$idCategoria);?>
   </p>
   <p><label>Sub-categoria:</label>
   <div id="subCategoria"></div>
   </p>
     
    <p><label>Tempo(minutos):</label>
     <input type="text" name="tempo" id="tempo"  class="hora" onsubmit="return false" style="width: 10%;" value="<?php echo $tempo?>" />
   </p>
       <p>
          <label>Título:</label>          
          <input type="text" name="titulo" id="titulo"  class="required" style="width: 80%;" onsubmit="return false" value="<?php echo $titulo?>" />
      <span class="placeholder">Campo Obrigatório</span>
 
        </p>
        
        <p>
          <label>Enunciado:</label>   
          <textarea name="enunciado_base" id="enunciado_base"><?php echo $enunciado?></textarea>
          <textarea name="enunciado" id="enunciado"/> 
          <input id="upload" type="file" name="upload" style="display: none;" onchange="" />      
<!--          <input type="text" name="enunciado" id="enunciado"  onsubmit="return false" style="width: 80%;" value="<?php //echo $enunciado?>" />-->
        </p>
		
        <p>
        <label> Questão vinculada (Pai)</label>
        <?php echo $Questao->selectQuestaoSelect("",$idQuestaoPai," AND questao_IdQuestao is null")?>
         
         <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
        </div>
        <div class="direita">
        <p><label>Inserir Imagem</label>
         <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_foto').click();" title="Adicionar" />
        <div id="visualizar">
          <?php if($foto != ''){?>
          <img src="<?php echo CAMINHO_UP?>imagem/questoes/miniatura-<?php echo $foto;?>" />
          <?php }?>
          <input type="hidden" name="foto_oculta" value="<?php echo $foto;?>" />
        </div>
        </p>
        
         <p><label>Inserir Áudio</label>
         <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_audio').click();" title="Adicionar" />
        <div id="visualizarM">
          <?php if($audio != ''){?>
         <video controls name="media">
         <?php echo "<source style=\"height: 20px;width: 100%;\" src=".CAMINHO_UP."imagem/questoes/". $audio." type=\"audio/mpeg\"/></video>";
           }?>
          <input type="hidden" name="audio_oculta" value="<?php echo $audio;?>" />
        </div>
        </p>
        
         <p><label>Inserir Áudio 2</label>
         <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_audio2').click();" title="Adicionar" />
        <div id="visualizarM2">
          <?php if($audio2 != ''){?>
         <video controls name="media">
         <?php echo "<source style=\"height: 20px;width: 100%;\" src=".CAMINHO_UP."imagem/questoes/". $audio2." type=\"audio/mpeg\"/></video>";
           }?>
          <input type="hidden" name="audio_oculta2" value="<?php echo $audio2;?>" />
        </div>
        </p>
        
         <p><label>Inserir Áudio 3</label>
         <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_audio3').click();" title="Adicionar" />
        <div id="visualizarM3">
          <?php if($audio3 != ''){?>
         <video controls name="media">
         <?php echo "<source style=\"height: 20px;width: 100%;\" src=".CAMINHO_UP."imagem/questoes/". $audio3." type=\"audio/mpeg\"/></video>";
           }?>
          <input type="hidden" name="audio_oculta3" value="<?php echo $audio3;?>" />
        </div>
        </p>
        
         <p><label>Inserir Áudio 4</label>
         <img src="<?php echo CAMINHO_IMG?>upload_foto.png" onclick="$('#add_audio4').click();" title="Adicionar" />
        <div id="visualizarM4">
          <?php if($audio4 != ''){?>
         <video controls name="media">
         <?php echo "<source style=\"height: 20px;width: 100%;\" src=".CAMINHO_UP."imagem/questoes/". $audio4." type=\"audio/mpeg\"/></video>";
           }?>
          <input type="hidden" name="audio_oculta4" value="<?php echo $audio4;?>" />
        </div>
        </p>
        
        
        <hr />
        
        <?php if  (($idQuestao > 0) && /*($tipoQ != 7)*/ ($valorFilhas[0]['idQuestao'] == '')) {
		echo "<p><center><legend>Cadastrar respostas :</legend></center>";
			require_once "../resposta/index.php";
		} elseif ($idQuestao > 0) {
		echo "<p><center><legend>Perguntas dependentes :</legend></center>	";
			require_once "perguntasD.php";	
			
		}?>
        </p>
        </p>
        
        </div>
        <div class="linha-inteira">
          <p>
        <button class="button blue" onclick="postForm_editor('enunciado', 'form_Questao', '<?php echo CAMINHO_CAD?>questoes/grava.php?id=<?php echo $idQuestao?>')">Salvar</button>
        
      </p>
  </div>
          </div>

    
    </form>
  </fieldset>
</div>
</div>
<script>
ativarForm();
viraEditor("enunciado");
function buscar(x){
  var idioma, retorno, idNivel;
  $( "#nivel" ).empty();
  if (x != '') {
	idNivel = x;
  } else {
  	idNivel = <?php echo $nivel?>;
  }
//  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
//  status = $("#status:checked").val();
  idioma = $("#idIdioma option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_CAD."questoes/select_nivel.php"?>",
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
buscar(<?php echo $nivel; ?>);

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_file').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
	}).submit();
});


/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_audio').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile').ajaxForm({
		target:'#visualizarFile' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_audio2').on('change', function(){
	$('#visualizarFile').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile2').ajaxForm({
		target:'#visualizarFile2' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_audio3').on('change', function(){
	$('#visualizarFile3').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile3').ajaxForm({
		target:'#visualizarFile3' // o callback será no elemento com o id #visualizar
	}).submit();
});

/* #imagem é o id do input, ao alterar o conteudo do input execurará a função baixo */
$('#add_audio4').on('change', function(){
	$('#visualizarFile4').html('Enviando...');
	/* Efetua o Upload sem dar refresh na pagina */ 
	$('#form_uploadFile4').ajaxForm({
		target:'#visualizarFile4' // o callback será no elemento com o id #visualizar
	}).submit();
});

function buscarSub(x){
  var idCategoria, retorno, idSubCategoria;
  $( "#subCategoria" ).empty();
  if (x != '') {
	idSubCategoria = x;
  } else {
  	idSubCategoria = <?php echo $subCategoria?>;
  }
	idCategoria = $("#idCategoria option:selected").val();
  //}
//  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
//  status = $("#status:checked").val();
//  idioma = $("#idCategoria option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_CAD."questoes/select_sub.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{idCategoria:idCategoria, idSubCategoria:idSubCategoria}   
  });
  retorno.done(function( html ) {
    $( "#subCategoria" ).append( html );
  });
//  grupos();
}
$('#idCategoria').attr('onchange', 'buscarSub()');
buscarSub(<?php echo $subCategoria?>);

function atualizaKitMaterialINF(){	
<?php if ($idIdioma == '') { ?>
	var idIdioma = $('#idIdioma').val();
<?php } else { ?>
	var idIdioma = '<?php echo $idIdioma?>';
<?php } ?>

	var idKitMaterial = '<?php echo $idKitMaterial?>';

	var idNivelEstudo = $('#IdNivelEstudo').val();
	var idFocoCurso = $('#idFocoCurso').val();
	if(idFocoCurso != 0){
	   $("#kitMaterial").show();
 //      $("#nomeMaterial").show();     
	$.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"atualizaKitMaterialINF", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso, idKitMaterial:idKitMaterial}, function(e){
		$('#kitMaterial').html(e);
	});
	}else{
	   $("#kitMaterial").hide();
	   $("#nomeMaterial").hide(); 
	}	
}


function Multifuncao(){
    atualizaKitMaterialINF();
 //   atualizarCargaHoraria();
}
function kitDescricao(kit){
<?php if ($idIdioma == '') { ?>
	var idIdioma = $('#idIdioma').val();
<?php } else { ?>
	var idIdioma = '<?php echo $idIdioma?>';
<?php } ?>

  var idNivelEstudo = $('#IdNivelEstudo').val();
  var idFocoCurso = $('#idFocoCurso').val();
  if (kit == null){  
//  $("#idKitMaterial option:selected").each(function() {
 //     idKitMaterial = $(this).val();
   idKitMaterial = $('#idKitMaterial').val();
//  });
  }else{
    idKitMaterial = kit;
  }

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"nomeMaterial", idIdioma:idIdioma, idNivelEstudo:idNivelEstudo, idFocoCurso:idFocoCurso, idKitMaterial:idKitMaterial}, function(e){
    $('#nomeMaterial').html(e);
    }); 
}

function focoDoCurso(){
  var idIdioma = $('#idIdioma').val();

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"focoDoCurso", idIdioma:idIdioma, semRequirido: 1}, function(e){
    $('#focoDoCurso').html(e);
    }); 
   Multifuncao();
}

function nivelDoCurso(){
  var idIdioma = $('#idIdioma').val();

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"nivelDoCurso", idIdioma:idIdioma}, function(e){
    $('#nivelDoCurso').html(e);
    }); 
	
	Multifuncao();
//	kitDescricao();
   
}

function idioma() {
	focoDoCurso();
	nivelDoCurso();
	Multifuncao();
}

$('#kitMaterial').attr('onchange', 'kitDescricao();');
$('#IdNivelEstudo').attr('onchange', 'atualizaKitMaterialINF();');
kitDescricao(<?= $idKitMaterial?>);

</script> 