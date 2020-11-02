<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$Grupo = new Grupo();
$Gerente = new Gerente();
$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();

$mes = date('m');
$ano = date('Y');

$arrItens = array();

//PADRÃO
$arrItens_padrao[] = array(0 => "grupo", 1 => "Grupo");
$arrItens_padrao[] = array(0 => "valorHora", 1 => "Valor Hora");
$arrItens_padrao[] = array(0 => "nivel", 1 => "Nível / Idioma");
$arrItens_padrao[] = array(0 => "horasMes", 1 => "Horas no mês");
$arrItens_padrao[] = array(0 => "diasHoras", 1 => "Dias / Horários");
$arrItens_padrao[] = array(0 => "professor", 1 => "Professor");
$arrItens_padrao[] = array(0 => "registroF", 1 => "Registro Funcionário");
$arrItens_padrao[] = array(0 => "aluno", 1 => "Aluno(s)");
$arrItens_padrao[] = array(0 => "nf", 1 => "NF");
$arrItens_padrao[] = array(0 => "inicio", 1 => "Início do módulo");
$arrItens_padrao[] = array(0 => "fim", 1 => "Previsão de término do módulo");

//OPCIONAL
$arrItens_opcional[] = array(0 => "totalModulo", 1 => "Carga horária do módulo");
$arrItens_opcional[] = array(0 => "totalAssistido", 1 => "Total Assistido");
$arrItens_opcional[] = array(0 => "saldoBanco", 1 => "Banco de Horas");
$arrItens_opcional[] = array(0 => "aceite", 1 => "Data do Aceite");
$arrItens_opcional[] = array(0 => "email", 1 => "E-mail");
$arrItens_opcional[] = array(0 => "frequencia", 1 => "Frequência");
$arrItens_opcional[] = array(0 => "valorEmpresa", 1 => "Valor Empresa");
$arrItens_opcional[] = array(0 => "valorAluno", 1 => "Valor Aluno");
$arrItens_opcional[] = array(0 => "transporte", 1 => "Transporte / Acréscimos");
$arrItens_opcional[] = array(0 => "abatimentos", 1 => "Abatimentos");
$arrItens_opcional[] = array(0 => "material", 1 => "Material Valor");
$arrItens_opcional[] = array(0 => "materialNome", 1 => "Material Nome");
$arrItens_opcional[] = array(0 => "funcao", 1 => "Função");
$arrItens_opcional[] = array(0 => "totalAluno", 1 => "Total Aluno");
$arrItens_opcional[] = array(0 => "centroC", 1 => "Centro de Custo");
$arrItens_opcional[] = array(0 => "devolucao", 1 => "Devolução");
$arrItens_opcional[] = array(0 => "cobranca", 1 => "Cobrança");
$arrItens_opcional[] = array(0 => "desempenho", 1 => "Nota de desempenho");

?>

<fieldset>
  <legend>Relatório de informações de rateio dos grupos</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >     
      <p><strong>Campos</strong></p>
      <div class="esquerda">
        <label>Selecionados:</label>
        <img src="<?php echo CAMINHO_IMG."menos2.png"?>" name="delIten" id="delIten" title="Remover iten" onclick="addIten('#sel_lista_padrao', '#sel_lista_opcional')"/>
        <p>
          <select multiple="multiple" name="sel_lista_padrao[]" id="sel_lista_padrao" size="15" >
          	<?php foreach($arrItens_padrao as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
          <select multiple="multiple" name="sel_lista_padraoNome[]" id="sel_lista_padraoNome" style="display:none;">          	
          </select>
        </p>        
      </div>
      <div class="direita">
        <label>Disponiveis para selecionar:</label>
        <img src="<?php echo CAMINHO_IMG."mais2.png"?>" name="delIten" id="delIten" title="Adicionar iten" onclick="addIten('#sel_lista_opcional', '#sel_lista_padrao')"/>
        <p>
          <select multiple="multiple" name="sel_lista_opcional" id="sel_lista_opcional" size="15" >
            <?php foreach($arrItens_opcional as $iten){?>
            	<option value="<?php echo $iten[0]?>" ><?php echo $iten[1]?></option>
            <?php }?>
          </select>
        </p>
      </div>
 
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">Periodo:
           <p>
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+2; $x >= 2013; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
          </p>
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
            <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-" onchange="grupos();">Ambos      
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
	postForm_relatorio('img_form_rel', 'sel_lista_padrao', 'form_rel_pf', '<?php echo CAMINHO_RELAT."rateio/include/resourceHTML/rateio.php"?>', '#res_rel')
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
function Enviar(){
    filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_REL."grupo/index.php"?>', '', '#lista_Grupos')
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
buscar();
grupos();
ativarForm();
</script> 