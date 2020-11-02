<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$Gerente = new Gerente();

$mes = date('m');
$ano = date('Y');
?>

<fieldset>
  <legend>Relatório Lucratividade Real</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
        <p>
          <select name="mes" id="mes" >
            <?php for($x=1; $x <= 12; $x++){ ?>
            <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
            <?php }?>
          </select>
          <span class="placeholder"></span>
          <select name="ano" id="ano" >
            <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
            <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
            <?php } ?>
          </select>
          <span class="placeholder"></span></p>
         <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
        <p>
          <label>Empresa:</label>       
          <select id="clientePj_idClientePj" name="clientePj_idClientePj[]" size="5" multiple="multiple">
            <option value="-">Empresas</option>            
          </select>
        </p>   
      
      </div>
      <div class="direita">
        
         <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo" size="5">
                 <option value="-">Grupos</option>  
            </select>
        </p>
     <p>
          <label>Grupos CLT:</label>
          <input type="radio" name="gclt" id="gclt" value="-" onchange="grupos();" checked="checked" >Ambos &nbsp;
          <input type="radio" name="gclt" id="gclt" value="1" onchange="grupos();">Mostrar &nbsp;
          <input type="radio" name="gclt" id="gclt" value="0" onchange="grupos();">Não mostrar      
        </p>
    
        </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."fatconsolidado/include/resourceHTML/fatconsolidado.php"?>', '#res_rel')">Gerar relatório</button> 
    <!--    <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."fatconsolidado/include/resourceHTML/fatconsolidadoComparativo.php"?>', '#res_rel')">Gerar relatório Comparativo</button>         -->
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
  grupos();
}/*
function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = 0;
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php //echo CAMINHO_RELAT."recebiveis/select_cliente.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#clientePj_idClientePj" ).append( html );
  });
  grupos();
}*/
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = 0;
  clientePj = $( "#clientePj_idClientePj option:selected" ).val();
  grupoClt = $('input[name=gclt]:checked', '#form_rel_pf').val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
     url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj, gerente:gerente,grupoClt:grupoClt}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#grupo_idGrupo').attr('onchange','Enviar()');
buscar();
grupos();
ativarForm();
</script> 