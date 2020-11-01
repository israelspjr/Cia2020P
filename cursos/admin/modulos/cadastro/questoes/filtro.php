<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoQuestao = new TipoQuestao();
$Idioma = new Idioma();
$NivelEstudo = new NivelEstudo();
$FocoCurso = new FocoCurso();

?>

<fieldset>
  <legend>Filtros</legend>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Questão" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."questoes/formulario.php".$param?>', '<?php echo CAMINHO_CAD."questoes/filtro.php"?>', '#centro')" /> </div>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_permissao" 
  onclick="abrirFormulario('div_form_permissao', 'img_form_permissao');" />
  
  <div class="agrupa" id="div_form_permissao">
    <form id="form_chamados"  class="validate" method="post" action="" onsubmit="return false" >
     <div class="esquerda">
      <p> <label> Tipo de questão:</label>
        <?php echo $TipoQuestao->selectTipoQuestaoSelect();?></p>
        
         <p>
          <label>Status :</label>
          <select size="3" name="status" id="status">
            <option value="" >Todos</option>
            <option value="0" selected="selected" >Ativos</option>
            <option value="1" >Inativos</option>
          </select>
        </p>
        
      <p>
      <label><input type="checkbox" value="1" name="dependentes" id="dependentes" />
      Mostrar perguntas dependentes 
      </label>
      </p>
        
       
        
     </div>
      <div class="direita">
      
        <p><label>Idioma</label>
        <p onchange="idioma()"><?php echo $Idioma->selectIdiomaSelect();?></p>
        </p>
    
    	 <p><label>Nível</label>
        <div id="nivel"></div>
        <?php //echo $NivelEstudo->selectNivelEstudoSelectMult();?>
        </p>
    
        <p>
  		<div id="focoDoCurso"></div>
		  </p>     
           
           
        <p>
         <div id="kitMaterial"></div>
        </p>
        <p> 
        <div id="nomeMaterial"></div>
        </p> 
      
    
        
     
      </div>     
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_permissao', 'form_chamados', '<?php echo CAMINHO_CAD . "questoes/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Cadastro de questões</legend>
  <div id="lista_res" class="lista"></div>
</fieldset>

<script>
function buscar(){
  var idioma, retorno;
  $( "#nivel" ).empty();
//  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
//  status = $("#status:checked").val();
  idioma = $("#idIdioma option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_CAD."questoes/select_nivel.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{idioma:idioma}   
  });
  retorno.done(function( html ) {
    $( "#nivel" ).append( html );
  });
//  grupos();
}
ativarForm();
eventDestacar(1);
$('#idIdioma').attr('onchange', 'buscar()');


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
