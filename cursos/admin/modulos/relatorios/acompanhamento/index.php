<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$Grupo = new Grupo();
$Gerente = new Gerente();
$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();
$ClientePf = new ClientePf();

$mes = date('m');
$ano = date('Y');

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "idioma", 1 => "Idioma / Nível");
$arrItens_padrao[] = array(0 => "diasHorario", 1 => "Dias e Horários");
$arrItens_padrao[] = array(0 => "inicioNivel", 1 => "Início do Nível");
$arrItens_padrao[] = array(0 => "terminoNivel", 1 => "Termíno do Nível");
$arrItens_padrao[] = array(0 => "professor", 1 => "Professor");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno(s)");
$arrItens_padrao[] = array(0 => "dataEntrada", 1 => "Data Entrada");
$arrItens_padrao[] = array(0 => "dataSaida", 1 => "Data Saída");

//Opcionais
$arrItens_opcional[] = array(0 => "frequencia", 1 => "Trazer frequência mensal");
?>

<fieldset>
  <legend>Relatório de desempenho geral</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
   <!--                 <label>Selecionados:</label>
        <img src="<?php echo CAMINHO_IMG."menos2.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
        <p>
          <select multiple="multiple" name="sel_lista_padrao[]" id="sel_lista_padrao" size="10" >
          	<?php foreach($arrItens_padrao as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
          <select multiple="multiple" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" style="display:none;">          	
          </select>
        </p>   -->
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
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>  
        <p>
        <Label> <input type="checkbox" id="frequencia" name="frequencia" />Trazer Frequência mensal </Label>
        </div>
        <div class="direita">
    <!--               <label>Disponiveis para selecionar:</label>
        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="10" >
            <?php foreach($arrItens_opcional as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
        </p>-->
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
           <p>       
           <div id="grupo_idAlunos" name="grupo_idAlunos">
           </div></p>
            <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-" onchange="grupos();">Ambos      
        </p>
   <!--    </p> 
            <label>Desconsiderar nível atual:</label>
            <input type="hidden" name="mostrarTudo" id="mostrarTudo" value="1" checked/>
          <!--  Sim
            <input type="radio" name="mostrarTudo" id="mostrarTudo" value="0" checked/>
            Não</p>-->
         <p>
            <label>Habilidades:</label>
            <select id="idTipoQualidadeComunicacao" name="idTipoQualidadeComunicacao" multiple="multiple">
            <option value="-">Selecione</option>
             <option value="1">Compreensão Oral</option>
              <option value="2">Gramática</option>
               <option value="3">Pronúncia</option>
                <option value="4">Vocabulário</option>
            </select>
  
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
    postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."acompanhamento/include/resourceHTML/acompanhamento.php"?>', '#res_rel');

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
  grupos();
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
//professor();

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