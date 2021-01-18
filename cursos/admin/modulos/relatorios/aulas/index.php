<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");


$TipoEnderecoVirtual = new TipoEnderecoVirtual();
$PsaProfessor = new PsaProfessor();
$PsaRegular = new PsaRegular();
$Gerente = new Gerente();
$NotasTipoNota = new NotasTipoNota();

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "dataAula", 1 => "Data Aula Assistida");
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "status", 1 => "Status");
$arrItens_padrao[] = array(0 => "nota", 1 => "Nota");
$arrItens_padrao[] = array(0 => "professorAssistido", 1 => "Professor Assistido");
$arrItens_padrao[] = array(0 => "quemAssistiu", 1 => "Quem Assistiu");
$arrItens_padrao[] = array(0 => "atencao", 1 => "O que mais chamou sua atenção?");
$arrItens_padrao[] = array(0 => "tecnicas", 1 => "Quais técnicas e práticas vistas você pretende implementar nas suas aulas?");
$arrItens_padrao[] = array(0 => "atitudes", 1 => "Quais atitudes positivas você conseguiu observar?");
$arrItens_padrao[] = array(0 => "diferente", 1 => "O que você faria de diferente ?");
$arrItens_padrao[] = array(0 => "pergunta5", 1 => "Usou VPG ou algo semelhante ao VPG?");
$arrItens_padrao[] = array(0 => "pergunta6", 1 => "Alunos estavam envolvidos com a aula?");
$arrItens_padrao[] = array(0 => "pergunta7", 1 => "A aula foi dinâmica e alegre?");
$arrItens_padrao[] = array(0 => "pergunta8", 1 => "Prof usou diferentes recursos?");


$arrItens_opcional[] = array(0 => "feedback", 1 => "Feedback");

?>

<fieldset>
  <legend>Relatório de Aulas Assistidas</legend>
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
        
    
          <label>Gerente:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p> 
          <p>
            <label>Professor:</label>
            <select id="professor_idProfessor" name="professor_idProfessor">
                 <option value="-">Professor</option>  
            </select>
        </p> 
         <p>
            <label>Período:</label>
            de
            <input type="text" name="dataReferencia" id="dataReferencia" class="data" value="" />
            a
            <input type="text" name="dataReferencia2" id="dataReferencia2" class="data" value="" />
          </p>
          
         
          
        </div>
        <div class="direita">  
            <p><strong>Campos</strong></p>
              <label>Disponiveis para selecionar:</label>
        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="10" >
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
            
               <p>
      <label>Status:</label>
      <input type="radio" id="status" name="status" value="1" <?php if($status == 1) { echo "checked"; } ?>/> <img src="<?php echo CAMINHO_IMG."excelente.png"?>" title="Aula excelente"/> 
      <input type="radio" id="status" name="status" value="2" <?php if($status == 2) { echo "checked"; } ?> /> <img src="<?php echo CAMINHO_IMG."boa.png"?>" title="Aula Boa, mas pode ser melhor"/> 
      <input type="radio" id="status" name="status" value="3" <?php if($status == 3) { echo "checked"; } ?>/> <img src="<?php echo CAMINHO_IMG."regular.png"?>" title="Aula Regular, muitos pontos a melhorar (vetar professor)"/> 
      <input type="radio" id="status" name="status" value="4" <?php if($status == 4) { echo "checked"; } ?>/> <img src="<?php echo CAMINHO_IMG."ruim.png"?>" title="Aula Ruim (vetar professor e verificar trocas)"/> 
     </p>
     <p>
     <label>Nota: </label>
     <select id="idNotasTipoNota" name="idNotasTipoNota" class="">
     	<option value="">Selecione</option>
     	<option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <!--<option value="18">Prefiro Não Avaliar</option>-->
     </select>
     <?php //echo $NotasTipoNota->selectNotasTipoNotaSelect("", $status2, " AND tipoNota_idTipoNota = 4 ") ?>

            </div>
            
  
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
$('#grupo_idGrupo').attr('onchange','professor();');
//$('#idNotasTipoNota').attr('onchange', 'quesitoF()');


buscar();
grupos();
//professor();

function geraRel(){
	

	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."aulas/aulas.php"?>', '#res_rel');

}
ativarForm();	


</script> 