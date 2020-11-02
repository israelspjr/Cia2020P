<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//$Gerente = new Gerente();
$Professor = new Professor();
?>

<fieldset>
  <legend>Relatório Relação Grupos X Professor</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_troca" class="validate" method="post" action="" onsubmit="return false" >        
      <div class="esquerda">
      <label>Professor:</label>
      <?php echo $Professor->selectProfessorSelect("", "", "");?>
      </div>
 <!--         <p>
          <label>Gerente:</label>
          <?php //echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>       
        <p>
          <label>Empresa:</label>         
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
        <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>       
      </div>
    
        <div class="esquerda">
          <p>
            <label>Data da Aula:</label>
            Início: <input type="text" name="dataReferencia" id="dataReferencia" class="required data" value="" />
            Término: <input type="text" name="dataReferencia2" id="dataReferencia2" class="required data" value="" />
          </p>     
          <p>
          <input type="checkbox" name="reposicao" id="reposicao" value="1" />Aulas de reposição
          </p>    
        </div>-->
        
    </form>
  </div>
  <div class="linha-inteira" >
        <button class="button blue" onclick="geraRel()"> Gerar Relatório</button>
      </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> /*
function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = 0;
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
  status = 0;
  clientePj = $( "#clientePj_idClientePj option:selected" ).val();
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
$('#grupo_idGrupo').attr('onchange','geraRel()');
buscar();
grupos();*/

function geraRel(){
    postForm_relatorio('img_form_Grupos', '', 'form_rel_troca', '<?php echo CAMINHO_RELAT."gruposAntigos/grupos.php"?>', '#res_rel');
}
ativarForm();
</script>