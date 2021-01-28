<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$ClientePf = new ClientePf();
$Gerente = new Gerente();

$mes = date('m');
$ano = date('Y');

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "data", 1 => "Data");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno/Grupo");
$arrItens_padrao[] = array(0 => "aspecto", 1 => "Aspecto");
$arrItens_padrao[] = array(0 => "revertida", 1 => "Revertida em");
$arrItens_padrao[] = array(0 => "acao", 1 => "Ação");

?>
 <input type="hidden" name="status" id="status" value="0" onchange="buscar();" checked="checked">
   <input type="hidden" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >
    
<fieldset>
  <legend>Relatório de Reversão ACES</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    <input type="hidden" name="FME" id="FME" value="" >
    <!--   <p><strong>Tipo de relatório</strong></p>-->
      <div class="linha-inteira">
      <div class="esquerda">
      <label>Selecionados:</label>
        <img src="<?php echo CAMINHO_IMG."menos2.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
        <p>
          <select multiple="multiple" name="sel_lista_padrao[]" id="sel_lista_padrao" size="10" >
          	<?php foreach($arrItens_padrao as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
          <select multiple="multiple" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" style="display:none;">          	
          </select>
        </p>   
        Revertida em:
         <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2013; $x-- ){?>
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
                <?php for($x = date('Y')+1; $x >= 2013; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
          <label>Tipo de resultado: (Não aparece desistentes):</label>
          <input type="radio" name="tipoR" value="0" />Somente Revertidas</br>
          <input type="radio" name="tipoR" value="1" />A reverter</br>
          <input type="radio" name="tipoR" value="2" checked />Ambas</br>
          
         
          
          </p>
            <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
        </div>
        <div class="direita">
        <label>Disponiveis para selecionar:</label>
        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="5" >
            <?php foreach($arrItens_opcional as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
        </p>     
          <p>
            <label>Empresa:</label>
           <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>   </select></p>
          <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
                  <p>
           <div id="grupo_idAlunos" name="grupo_idAlunos">
          </div></p>
            
             <input type="checkbox" name="desistente" value="1" /> Somente Desistentes. 

        </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel2" onclick="geraRel()">Gerar relatório</button>        
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script>

function geraRel(){
	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."reversaoPsa/include/resourceHTML/reversaoPsa.php"?>', '#res_rel');
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
  
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
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
  
/*  retorno = $.ajax({
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
	
  });*/
  
  alunos();
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
 ativarForm();</script> 