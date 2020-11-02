<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//$Grupo = new Grupo();
$Idioma = new Idioma();
$gerente = new Gerente();


$mes = date('m');
$ano = date('Y');
?>

<fieldset>
  <legend>Relatório de Política de idiomas assinada</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
         <p>
          <label>Gerente:</label>
          <?php echo $gerente->selectGerenteSelect();?>
      </p>    
          <p>
          <label><strong>De: </strong></label>
        <label>Mês:</label>
        <select name="mes" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
     
        <label>Ano:</label>
        <select name="ano" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
      
   <!--       <p>
            <label>Idioma:</label>
            <?php echo $Idioma->selectIdiomaSelectMult("", "", " AND disponivelAula = 1")?></p>-->
   <!--       <p>
            <label>Grupo:</label>
            <?php // echo $Grupo->selectGrupoSelectMult("", "", " WHERE inativo = 0")?></p>-->
  <!--        <p>
            <label>Tipo:</label>
            <select name="filtroTipo[]" id="filtroTipo" multiple="multiple" >
              <option value="" >Selecione</option>
              <option value="1" >Fechamento</option>
              <option value="2" >Reversão</option>
              <option value="3" >Pendente</option>
            </select>
          </p>-->
        </div>
        <div class="direita"> 
                <p>
          <label>Empresa:</label>        
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
        <p>
        <label>Status</label>
        <input type="radio" name="status" id="status" value="0" onchange="grupos();" checked="checked">Ativo &nbsp;
          <input type="radio" name="status" id="status" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="status" id="status" value="-"  onchange="grupos();">Ambos    
                        </p>
         <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
              <p>
          <label><strong>Até:</strong> </label>
        <label>Mês:</label>
        <select name="mes_fim" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
      </p>
      <p>
        <label>Ano:</label>
        <select name="ano_fim" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
        </div>
      </div>
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."politica/index.php"?>', '#res_rel')">Gerar relatório</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> 
function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = $("#status:checked").val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_cliente.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#clientePj_idClientePj" ).append( html );
  });
  
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#status:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#status').attr('onchange', 'grupos()');
grupos();
ativarForm();
buscar();
</script> 