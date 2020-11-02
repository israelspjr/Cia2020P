<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$ProvaOn = new ProvaOn();
	$Idioma = new Idioma();
	$FocoCurso = new FocoCurso();
	$NivelEstudo = new NivelEstudo();
		
$idProva = $_REQUEST['id'];

if($idProva != '' && $idProva  > 0){

	$valor = $ProvaOn->selectProvaOn('WHERE idProvaOn='.$idProva);
		 $nome = $valor[0]['nome'];
		 $ordem = $valor[0]['ordem'];
		 $obs = $valor[0]['obs'];
		 $inativo = $valor[0]['inativo'];
		 $excluido = $valor[0]['excluido'];
		 $idIdioma = $valor[0]['idioma_IdIdioma'];
		 $IdNivelEstudo = $valor[0]['nivelEstudo_IdNivelEstudo'];
		 $idFocoCurso = $valor[0]['focoCurso_IdFocoCurso'];
		 $idKitMaterial = $valor[0]['kitMaterial_IdKitMaterial'];
		 
	
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Prova On-line</legend>
  
    <form id="form_Prova" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idProva ?>" />
	<div class="esquerda">
    			
                
                <p>
				<label>Nome:</label>
				<input type="text" name="nome" id="nome" class="" value="<?php echo $nome?>" />
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
		</div>
        <div class="direita">		
				<p>
				<label>Idioma:</label>
                
                <p onchange="idioma()"><?php echo $Idioma->selectIdiomaSelect("required", $idIdioma)?></p>
				
				</p> 
                
                	 <p>
        <label>Nível de estudo:</label>
        <div id="nivel">
        
        <?php 
		$sql = " INNER JOIN nivelEstudoIdioma AS NI ON NI.nivel_IdNivel = N.IdNivelEstudo ";
		$sql .= "INNER JOIN idioma AS I ON I.idIdioma = NI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;

		echo $NivelEstudo->selectNivelEstudoSelect("required inf", $IdNivelEstudo, $sql);

		?>        
        </div>
        
        </p>
    
        <p>
  		<div id="focoDoCurso">
        <label> Foco do Curso: </label>
		<?php 	
			
		$sql = "INNER JOIN focoCursoIdioma AS FI ON FI.focoCurso_idFocoCurso = F.idFocoCurso ";
		$sql .= "INNER JOIN idioma AS I ON I.idIdioma = FI.idioma_idIdioma AND I.idIdioma = ".$idIdioma;
		$sql .= " AND idFocoCurso = ".$idFocoCurso;
		
		echo $FocoCurso->selectFocoCursoSelect("required inf", $idFocoCurso, $sql);?>
        
        
        </div>
		  </p>     
           
           
        <p>
         <div id="kitMaterial"></div>
        </p>
        <p> 
        <div id="nomeMaterial"></div>
        </p> 
        
        </div>
        <div class="linha-inteira">
				
				<p>
				<label>Observação:</label>
				<textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
			<p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>	
				
	  
        <button class="button blue" onclick="postForm('form_Prova', '<?php echo CAMINHO_REL?>provas/grava.php')">Salvar</button>
        </div>
      </p>
    </form>
    
    <?php 
	if($idProva != '' && $idProva  > 0){ ?>
    <div class="linha-inteira">
        <?php require_once "questoes.php"?>  
        </div>
    <?php } ?>
  </fieldset>
</div>
<script>ativarForm();
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

    $.post('<?php echo CAMINHO_VENDAS?>planoAcao/include/acao/planoAcao.php',{acao:"focoDoCurso", idIdioma:idIdioma}, function(e){
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
atualizaKitMaterialINF();

</script> 

