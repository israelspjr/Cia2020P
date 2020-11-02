<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$ClientePf = new ClientePf();
$Gerente = new Gerente();

$mes = date('m');
$ano = date('Y');
?>
 <input type="hidden" name="status" id="status" value="0" onchange="buscar();" checked="checked">
   <input type="hidden" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >
    
<fieldset>
  <legend>Relatório de frequência</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    <input type="hidden" name="FME" id="FME" value="" >
       <p><strong>Tipo de relatório</strong></p>
      <div class="linha-inteira">
      <div class="esquerda">
        <p>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_porAula" value="porAula" />
            Frequência por aula</label>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_mensal" value="mensal" checked="checked" />
            Frequência mensal </label>
        </p>
         <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
            <label>Até:
              <select name="mes_fim" id="mes_fim" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
          <label>Tipo de resultado:</label>
          <input type="radio" name="tipoR" value="0" checked/>Detalhado</br>
          <input type="radio" name="tipoR" value="1" id="resumido"/>Resumido</br>
          <br />
          <input type="checkbox" name="alunosN" value="1" onclick="toggleCheckbox(this)" /> Não mostrar alunos.
          </p>
            <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
        </div>
        <div class="direita">
          <p>
            <label>Empresa:</label>
           <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>   </select></p>
             <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-" onchange="grupos();">Ambos      
        </p>
          <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
            <p>
          <label>Status Alunos:</label>
          <input type="radio" name="statusA" id="statusA" value="0" onchange="alunosS();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusA" id="statusA" value="1" onchange="alunosS();">Inativo &nbsp;
          <input type="radio" name="statusA" id="statusA" value="-" onchange="alunosS();">Ambos      
        </p>
        
                  <p>
         <!--   <label>Alunos:</label>-->
           <div id="grupo_idAlunos" name="grupo_idAlunos">
               <!--  <option value="-">Alunos</option>  
            </select>-->
            </div></p>
            <p>
            OU
			<label>
            Verificar frequência individual
            </label>
            <?php echo $ClientePf->selectClientePfSelect("","",""); ?>
            <p>
            <label>Frequências: </label>
            <input name="frequencia" type="radio" value="-" checked="checked" selected onclick="freqRealJust(0)" id="frequenciaE">Todos</input>
            <br />
            	<div> 
            		<div>
                    	<input type="radio"  name="frequencia" value="1" onclick="freqRealJust(1)">Abaixo de <span id="FMEh" style="	margin-top: 5px;"> </span> frequência com justificativa </input><br />
                        <input type="radio"  name="frequencia" value="3" onclick="freqRealJust(1)">Abaixo de <span id="FMEh1" style=" margin-top: 5px;"> </span> frequência real (s/justificativa) </input>
                   <!--     <div id="FreqRealJust" style="display:none">
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="FreqReal" id="FreqReal" value="1" />Frequência real (s/justificativa)<br />
                        &nbsp;&nbsp;&nbsp;<input type="radio" name="FreqReal" id="FreqReal2" value="2" />Frequência com justificativa
                        </div>-->
                   </div>
               </div>
            <br />
            <input type="radio" name="frequencia" value="2" onclick="freqRealJust(2)">Somente 100%</input><br />
        </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', 'tipoRel', 'form_rel_pf', '<?php echo CAMINHO_RELAT."frequencia/include/resourceHTML/frequencia.php"?>', '#res_rel')">Gerar relatório</button>          
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script>
function freqRealJust(x) {
if (x == 1) {
	$('#FreqRealJust').show();
} else {
	$('#FreqRealJust').hide();
	$('#FreqReal').attr('checked',false);
	$('#FreqReal2').attr('checked',false);
}
		
	
}
function toggleCheckbox(element)
 {
//   element.checked = !element.checked;
   $('#resumido').attr('checked',"checked");
//   $('input[name=frequencia]:checked', '#form_rel_pf').val("-");
//   $('#frequenciaE').attr('checked',"checked");
 }


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
  
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_frequencia.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#FME" ).val( html );
	$( "#FMEh" ).empty();
    $( "#FMEh" ).append( html );
	$( "#FMEh1" ).empty();
    $( "#FMEh1" ).append( html );
	
	
  });
  
  alunos();
}

function alunosS() {
	
}

function alunos(){
  var status, clientePj, retorno;
  $("#grupo_idAlunos").empty();
  $("#grupo_idAlunos").append("<option value='-'>Alunos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_alunos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idAlunos" ).append( html );
  });
  
}

function alunosGrupo(){
  var status, idGrupo, retorno;
  $("#grupo_idAlunos").empty();
  $("#grupo_idAlunos").append("<option value='-'>Alunos</option>");
  status = $("#statusG:checked").val();
  idGrupo = $("#grupo_idGrupo").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_alunosGrupo.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,idGrupo:idGrupo}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idAlunos" ).append( html );
  });
  
}

$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
$('#grupo_idGrupo').attr('onchange','alunosGrupo()');
buscar();
grupos();
ativarForm();
</script> 