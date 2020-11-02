<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Gerente = new Gerente();

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "professor", 1 => "Professor que saiu");
//$arrItens_padrao[] = array(0 => "diaSemana", 1 => "Dia Na Semana");
$arrItens_padrao[] = array(0 => "dataTroca", 1 => "Data da Troca");
//$arrItens_padrao[] = array(0 => "dataUltima", 1 => "Data Última Aula");
$arrItens_padrao[] = array(0 => "motivo", 1 => "Motivo");
$arrItens_padrao[] = array(0 => "subMotivo", 1 => "Sub Motivo");
$arrItens_padrao[] = array(0 => "professorAtual", 1 => "Professor Atual");

?>

<fieldset>
  <legend>Relatório de troca de professor e professor reposição</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_troca" class="validate" method="post" action="" onsubmit="return false" >        
      <div class="direita">
        
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
          <label>Gerente:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
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
          <p><strong>Campos</strong></p>
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
            <label>Data da Troca:</label>
            Início: <input type="text" name="dataReferencia" id="dataReferencia" class="required data" value="" />
            Término: <input type="text" name="dataReferencia2" id="dataReferencia2" class="required data" value="" />
          </p>     
          <p>
          <input type="checkbox" name="reposicao" id="reposicao" value="1" />Aulas de reposição
          </p>  
          <p>
          <label>Selecione o motivo:</label>
          <select name="motivo" id="motivo">
          <option value="-">Selecione</option>
          <option value="1"> Alteração de dia / horário </option>
          <option value="2"> Insatisfação Aluno ou RH </option>
          <option value="3"> Professor deixou o grupo </option>
          <option value="4"> Decisão CI (Coordenação) </option>
          <option value="5"> Previsto em contrato </option>
          <option value="13"> Grupo Fechou </option>          
          </select>
             </p>  
              <div id="sub1" name="sub1" style="display:none">
          <label>Escolha o Sub-motivo: </label>
          <select name="subMotivo" id="subMotivo" >
          <option value="">Selecione</option>
          <option value="6">Emprego CLT/ Passou em concurso </option>
          <option value="7">Indisponibilidade de agenda </option>
          <option value="8">Mudou de região/ cidade </option>
          <option value="9">Problemas de saúde </option>
          <option value="10">Não adaptação ao método</option>
          </select>
          </div>
          
           <div id="sub2" name="sub2" style="display:none">
          <label>Escolha o Sub-motivo: </label>
          <select name="subMotivo2" id="subMotivo2" >
          <option value="">Selecione</option>
          <option value="11">Pedagógico </option>
          <option value="12">Comportamental</option>
          </select>
          </div>
          
          </p>                      
        </div>
        <div class="linha-inteira" >
        <button class="button blue" onclick="geraRel()"> Gerar Relatório</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="lista_res" class="lista" ></div>
</fieldset>
<script> 
  function geraRel(){
	  if (($('#dataReferencia').val() != '') && ($('#dataReferencia').val() != '')) {
	addItenPersonalizado('#sel_lista_padrao', '#sel_lista_padraoNome');
	selecionaTudoSelect('sel_lista_padrao', 'sel_lista_padraoNome');
	postForm_relatorio('img_form_Grupos', 'sel_lista_padrao', 'form_rel_troca', '<?php echo CAMINHO_RELAT."grupo_professor/include/resourceHTML/troca.php"?>', '#lista_res')
	  } else {
			alert("Falta data de inicio ou data fim");  
	  }
}	


function submenu() {
var a = $('#motivo').val();	
	if (a == 3) {
		$('#subMotivo1').attr("class", "required");
		$('#sub1').show();
		$('#sub2').hide();
	} else if(a == 4) {
		$('#sub1').hide();
		$('#subMotivo2').attr("class", "required");
		$('#sub2').show();	
		
	} else {
		$('#sub1').hide();
		$('#sub2').hide();	
	}
	
	
}
$('#motivo').attr('onchange', 'submenu()');
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
grupos();

//function geraRel(){
//    postForm_relatorio('img_form_Grupos', '', 'form_rel_troca', '<?php echo CAMINHO_RELAT."grupo_professor/include/resourceHTML/troca.php"?>', '#res_rel');
//}
ativarForm();
</script>