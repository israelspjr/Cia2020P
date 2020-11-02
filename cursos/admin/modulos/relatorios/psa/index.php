<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$PsaProfessor = new PsaProfessor();
$PsaRegular = new PsaRegular();
$Gerente = new Gerente();
$NotasTipoNota = new NotasTipoNota();

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno");
$arrItens_padrao[] = array(0 => "dataReferencia", 1 => "Data da pesquisa");
$arrItens_padrao[] = array(0 => "nomeProfessor", 1 => "Nome Professor");

$rsPsaProfessor = $PsaProfessor->selectPsaProfessor(" WHERE excluido = 0 AND inativo = 0 AND tipo = 1");
foreach($rsPsaProfessor as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);

$rsPsaRegular = $PsaRegular->selectPsaRegular(" WHERE (excluido = 0 AND inativo = 0 AND tipo = 1) OR (idPsa = 7) ");
foreach($rsPsaRegular as $valor) $arrItens_padrao[] = array(0 => $valor['titulo'], 1 => $valor['titulo']);


?>

<fieldset>
  <legend>Relatório de PSA Antigo</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
    
      <!--<p><strong>Campos</strong></p>-->
      <p><strong>Filtros</strong></p>
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
         <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p> 
          <p>
            <label>Professor:</label>
            <select id="professor_idProfessor" name="professor_idProfessor">
                 <option value="-">Professor</option>  
            </select>
        </p> 
         <p>
            <label>Período de PSA respondida (Não inclui PSA pendentes):</label>
            de
            <input type="text" name="dataReferencia" id="dataReferencia" class="data" value="" />
            a
            <input type="text" name="dataReferencia2" id="dataReferencia2" class="data" value="31/08/2018" disabled=disabled/>
          </p>
           <p>
          <Label>Mostrar comentários? </Label>
          <input type="checkbox" value="1" id="mostrarComentarios" name="mostrarComentarios" />
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
            <option value="-">Empresas</option>            
          </select>
        </p>
        <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
            <div id="grupo_idAlunos" name="grupo_idAlunos">

            </div>
  
            
            <p>
            <label>Nota:</label>
         
            <?php echo $NotasTipoNota->selectNotasTipoNotaSelect("","", " AND (tipoNota_idTipoNota = 1) OR (tipoNota_idTipoNota = 4)") ?>
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
function geraRel(){

	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."psa/include/resourceHTML/psa.php"?>', '#res_rel');

}


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

function quesitoF(){
		$('#quesito').attr('class', 'required');
	
}


$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
//$('#clientePj_idClientePj').attr('onchange','professor()');
$('#grupo_idGrupo').attr('onchange','professor();alunosGrupo();');
$('#idNotasTipoNota').attr('onchange', 'quesitoF()');

buscar();
grupos();
//professor();


ativarForm();	
</script> 