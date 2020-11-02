<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();
$ItemProva = new ItenProva();
$Gerente = new Gerente();
$mes = date('m');
$ano = date('Y');

//PADRÃO Aplicadas
$arrItens_padrao[] = array(0 => "empresa", 1 => "Empresa");
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno");
$arrItens_padrao[] = array(0 => "idioma", 1 => "Idioma");
$arrItens_padrao[] = array(0 => "nivel", 1 => "Nível");
$arrItens_padrao[] = array(0 => "inicioEstagio", 1 => "Inicio do estágio");
$arrItens_padrao[] = array(0 => "prova", 1 => "Prova");
$arrItens_padrao[] = array(0 => "itemProva", 1 => "Item da Prova");
$arrItens_padrao[] = array(0 => "nota", 1 => "Nota");
$arrItens_padrao[] = array(0 => "nomeProfessor", 1 => "Nome do Professor");
$arrItens_padrao[] = array(0 => "material", 1 => "Material *");
$arrItens_padrao[] = array(0 => "unidadeFinal", 1 => "Unidade Final *");
$arrItens_padrao[] = array(0 => "unidadeAtual", 1 => "Unidade Atual *");
$arrItens_padrao[] = array(0 => "obsMaterial", 1 => "ObsMaterial *");
$arrItens_padrao[] = array(0 => "dataAplicacao", 1 => "Data de Aplicação");
$arrItens_padrao[] = array(0 => "obsProva", 1 => "ObsProva");
$arrItens_padrao[] = array(0 => "anexo", 1 => "Anexo");

//Padrão Opcional
$arrItens_opcional[] = array(0 => "novaData", 1 => "Nova data Prevista de aplicação");
$arrItens_opcional[] = array(0 => "dataPrevista", 1 => "Data Prevista de aplicação");
?>

<fieldset>
  <legend>Relatório de Avaliações</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_rel" 
onclick="abrirFormulario('div_form_rel', 'img_form_rel');" />
  <div class="agrupa" id="div_form_rel">
    <form id="form_rel" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Tipo de relatório</strong></p>
        
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
         <p><strong>Filtros</strong></p>
        <p>
          <label><input type="radio" name="tipoRel" id="tipoRel_item" value="item" checked="checked" onchange="Oculta(0)" />Por item da avaliação</label>
          <label><input type="radio" name="tipoRel" id="tipoRel_media" value="media" onchange="Oculta(1)" />Média final da avaliação (Selecionar 1 mês depois do início do estágio)</label>
        </p>
          <p id="item">
               <?php echo $ItemProva->selectItenProvaSelectMulti("",""," group by nome")?>             
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
          <label for="sogrupo">
            <input type="checkbox" name="semPeri" id="semPeri" value="1"/> Não considerar período </label><br />
            	 <p>
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>  
        </div>
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
          <label>Empresa:</label>         
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
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
        <div id="nivel"></div>
        
        </p>
          <p>
            <label>Professor:</label>
            <select id="professor_idProfessor" name="professor_idProfessor">
                 <option value="-">Professor</option>  
            </select>
        </p> 
        
        
        <p>
            <label><input type="radio" name="status" value="1"  checked="checked"  />Aplicadas</label>
            <label><input type="radio" name="status" value="2" id="agendada"/>Agendadas (Sem Alunos)</label>
            <label for="sogrupo">
            <input type="checkbox" name="pror" id="pror" value="1"/> Somente as prorrogadas </label><br />
           <label><input type="radio" name="status" value="3" />Ambas</label>
        </p>
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
    postForm_relatorio('img_form_Grupos', '', 'form_rel', '<?php echo CAMINHO_RELAT."prova/include/resourceHTML/prova.php"?>', '#res_rel');

}
function Oculta(val){
    if(val==0){
        $("#item").show();
    }else{
        $("#item").hide();
    }
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
  
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj option:selected" ).val();
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

function nivelP(){
  var grupo, retorno;
  $("#nivel").empty();
  $("#nivel").append("<label>Nível:</label>");
  status = 0;
 // clientePj = $( "#clientePj_idClientePj option:selected" ).val();
  grupo = $( "#grupo_idGrupo option:selected" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_nivel.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{grupo:grupo}   
  });
  retorno.done(function( html ) {
    $( "#nivel" ).append( html );
  });  
}


$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
$('#grupo_idGrupo').attr('onchange','professor()');
$('#grupo_idGrupo').attr('onchange','nivelP()');
buscar();
grupos();
ativarForm();

function agendadas() {
	$('#agendada').attr('checked','checked');
	
}
</script> 