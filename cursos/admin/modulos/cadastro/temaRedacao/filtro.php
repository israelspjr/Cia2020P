<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//$TipoQuestao = new TipoQuestao();
$Idioma = new Idioma();
$NivelEstudo = new NivelEstudo();

?>

<fieldset>
  <legend>Filtros</legend>

  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_permissao" 
  onclick="abrirFormulario('div_form_permissao', 'img_form_permissao');" />
  
  <div class="agrupa" id="div_form_permissao">
    <form id="form_chamados"  class="validate" method="post" action="" onsubmit="return false" >
     <div class="esquerda">
  <!--    <p> <label> Tipo de questão:</label>
        <?php //echo $TipoQuestao->selectTipoQuestaoSelect();?></p>-->
        
         <p>
          <label>Status :</label>
          <select size="3" name="status" id="status">
            <option value="" >Todos</option>
            <option value="0" selected="selected" >Ativos</option>
            <option value="1" >Inativos</option>
          </select>
        </p>
        
      
        
       
        
     </div>
      <div class="direita">
      
        <p><label>Idioma</label>
        <?php echo $Idioma->selectIdiomaSelect();?>
        </p>
       
        <p><label>Nível</label>
        <div id="nivel"></div>
        <?php //echo $NivelEstudo->selectNivelEstudoSelectMult();?>
        </p>
     
      </div>     
      <div class="linha-inteira">
        <button class="button blue" id="bt" onclick="filtro_postForm('img_form_permissao', 'form_chamados', '<?php echo CAMINHO_CAD . "temaRedacao/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Cadastro de Temas</legend>
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
</script>
