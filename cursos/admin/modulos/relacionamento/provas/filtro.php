<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoQuestao = new TipoQuestao();
$Idioma = new Idioma();
$NivelEstudo = new NivelEstudo();
$ProvaOn = new ProvaOn();
$FocoCurso = new FocoCurso();
$KitMaterial = new KitMaterial();

$idProva = $_REQUEST['idProva'];
$idIdioma = $_REQUEST['idIdioma'];

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

//Kit Material

 $sql = " INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma;
  $sql .= " AND INF.nivelEstudo_IdNivelEstudo = ".$IdNivelEstudo." AND INF.focoCurso_idFocoCurso = ".$idFocoCurso;
  $sql .= " INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";  
  $sql .= " AND KMINF.kitMaterial_idKitMaterial = K.idKitMaterial";
  $sql .= " INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = KMINF.kitMaterial_idKitMaterial AND KMD.excluido = 0";
  $sql .= " INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF";
  $sql .= " AND MDINF.materialDidatico_idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico";
  $sql .= " INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMaterialDidatico";
  $sql .= " WHERE K.idKitMaterial = ".$idKitMaterial;
  
  				$nomeMaterial = $KitMaterial->selectKitMaterialDescricao($sql);


?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<fieldset>
  <legend>Filtros</legend>
<div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Questão" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."questoes/formulario.php".$param?>', '<?php echo CAMINHO_CAD."questoes/filtro.php"?>', '#centro')" /> </div>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_permissao" 
  onclick="abrirFormulario('div_form_permissao', 'img_form_permissao');" />
  
  <div class="agrupa" id="div_form_permissao">
    <form id="form_chamados"  class="validate" method="post" action="" onsubmit="return false" >
    <input type="hidden" id="idIdioma" name="idIdioma" value="<?php echo $idIdioma?>" />
    <input type="hidden" id="IdNivelEstudo" name="IdNivelEstudo" value="<?php echo $IdNivelEstudo?>" />
    <input type="hidden" id="idFocoCurso" name="idFocoCurso" value="<?php echo $idFocoCurso?>" />
    <input type="hidden" id="idKitMaterial" name="idKitMaterial" value="<?php echo $idKitMaterial?>" />
    
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
      
        <p><label>Idioma: <?php echo $Idioma->getNome($idIdioma);?></label></p>
       
        <p><label>Nível de estudo: <?php echo $NivelEstudo->getNome( $IdNivelEstudo );?></label></p>
        
        <p><label>Foco do curso: <?php echo $FocoCurso->getNome($idFocoCurso); ?> </label></p>
        
        <p><label>Kit Material: <?php echo $nomeMaterial ?></label></p>
     
      </div>     
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_permissao', 'form_chamados', '<?php echo CAMINHO_REL . "provas/questoesInserir.php?idProva=".$idProva?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Cadastro de questões</legend>
  <div id="lista_res" class="lista"></div>
</fieldset>
</div>
<script>
/*function buscar(){
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
}*/
ativarForm();
eventDestacar(1);
//$('#idIdioma').attr('onchange', 'buscar()');
//buscar();
</script>
