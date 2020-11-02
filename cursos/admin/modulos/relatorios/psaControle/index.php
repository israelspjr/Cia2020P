<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$PsaProfessor = new PsaProfessor();
$PsaRegular = new PsaRegular();
$Gerente = new Gerente();

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno");
$arrItens_padrao[] = array(0 => "dataReferencia", 1 => "Data da pesquisa");
$arrItens_padrao[] = array(0 => "nomeProfessor", 1 => "Nome Professor");

$rsPsaProfessor = $PsaProfessor->selectPsaProfessor(" WHERE excluido = 0 AND inativo = 0 ");
foreach($rsPsaProfessor as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);

$rsPsaRegular = $PsaRegular->selectPsaRegular(" WHERE excluido = 0 AND inativo = 0 ");
foreach($rsPsaRegular as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);

?>

<fieldset>
  <legend>Controle de PSA</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    
      <!--<p><strong>Campos</strong></p>-->
      <p><strong>Filtros</strong></p>
      <div class="esquerda">
     <!--   <label>Selecionados:</label>-->
        <img src="<?php echo CAMINHO_IMG."menos.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
         <p>
          <label>Gerente:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p> 
        </div>
        <div class="direita">      
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
   <!--      <p>
            <label>Professor:</label>
            <select id="professor_idProfessor" name="professor_idProfessor">
                 <option value="-">Professor</option>  
            </select>
        </p> 
      
          	<?php foreach($arrItens_padrao as $iten){?>
          	    <input type="hidden" name="sel_lista_padrao[]" id="sel_lista_padrao" value="<?php echo $iten[0]?>" /> 
          	    <input type="hidden" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" value="<?php echo $iten[1]?>" />  
            
            <?php }?>                 	
     
          <p>
            <label>Data da pesquisa:</label>
            de
            <input type="text" name="dataReferencia" id="dataReferencia" class="data" value="" />
            a
            <input type="text" name="dataReferencia2" id="dataReferencia2" class="data" value="" />
          </p>
          <p>
          <Label>Mostrar comentários? </Label>
          <input type="checkbox" value="1" id="mostrarComentarios" name="mostrarComentarios" />
          </p>
        </div>
        <div class="direita">-->
         <p>
         <!-- <Label>Mostrar PSA Pendentes </Label>-->
          <input type="hidden" value="1" id="psaPendentes" name="psaPendentes" />
          </p>
   
          
           </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" onclick="geraRel()">
        Gerar relatório</button>
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
  professor();
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
  professor();
}
function professor(){
  var status, clientePj, grupo, retorno;
  $("#professor_idProfessor").empty();
  $("#professor_idProfessor").append("<option value='-'>Professor</option>");
  status = 0;
  clientePj = $( "#clientePj_idClientePj option:selected" ).val();
  grupo = $( "#grupo_idGrupo option:selected" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_RELAT."psa/select_professores.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,grupo:grupo}   
  });
  retorno.done(function( html ) {
    $( "#professor_idProfessor" ).append( html );
  });  
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#clientePj_idClientePj').attr('onchange','professor()');
$('#grupo_idGrupo').attr('onchange','professor()');

buscar();
grupos();
//professor();

function geraRel(){
addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."psa/include/resourceHTML/psa.php"?>', '#res_rel');
}
ativarForm();	
</script> 