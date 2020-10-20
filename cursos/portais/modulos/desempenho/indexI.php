<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Professor = new Professor();
$Grupo = new Grupo();
$Gerente = new Gerente();
$TipoQualidadeComunicacao = new TipoQualidadeComunicacao();
$ClientePf = new ClientePf();
$ClientePj = new ClientePj();
$GerenteTem = new GerenteTem();
$Gerente = new Gerente();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$IntegranteGrupo = new IntegranteGrupo();


$mes = date('m');
$ano = date('Y');

$valorCliente = $ClientePj->selectClientePj(" WHERE idClientePj =".$_SESSION['idClientePj_SS']);


$nomePj = $valorCliente[0]['razaoSocial'];
$valorGerente = $GerenteTem->selectGerenteTem( " WHERE clientePj_idClientePj = ".$valorCliente[0]['idClientePj']." AND dataExclusao is null");
$nomeGerente = $Gerente->getNomeGerente($valorGerente[0]['gerente_idGerente']);

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];

?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>-->

<fieldset>
  <legend>Relatório de desempenho geral</legend>
     <p>  <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/charts.php', '#centro');" >Fechar </button>
</p>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
           <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
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
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
          <label>Gerente:</label>
          <?php echo $nomeGerente?>
          <?php //echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>  
        <p>
        <Label> <input type="checkbox" id="frequencia" name="frequencia" />Trazer Frequência mensal </Label>
        </div>
        <div class="direita">
           <p>
          <label>Empresa:</label>    
          <p><?php echo $nomePj;?> </p>    
     <!--     <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>-->
        </p>
         <p>
            <label>Grupo:</label>
            <p><div id="grupoInicial"><?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo,"");?>
            <input type="hidden" id="grupo_idGrupoInicial" value="<?php echo $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo,true);?>"/></div></p>
            <label>Escolher outro:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
            </p>
           <p>       
           <div id="grupo_idAlunos" name="grupo_idAlunos">
           <label>Aluno:</label>
           <?php echo $IntegranteGrupo->getNomePF($idIntegranteGrupo)?>
           <input type="hidden" id="idIntegranteGrupo" name="idIntegranteGrupo" value="<?php echo $idIntegranteGrupo?>"/>
           </div></p>
            <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-" onchange="grupos();">Ambos      
        </p>
       </p> 
            <label>Mostrar todos os níveis:</label>
            <input type="radio" name="mostrarTudo" id="mostrarTudo" value="1" checked//>
            Sim
            <input type="radio" name="mostrarTudo" id="mostrarTudo" value="0" >
            Não</p>
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
        <button class="bBlue" id="geraRel" onclick="zerarCentro();postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo "modulos/desempenho/acompanhamento.php"?>', 'res_rel');">Gerar relatório</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
 
  <div id="res_rel" class="lista" ></div>
</fieldset>
</div>
<script> /*
function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = 0;
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_MODULO."select_cliente.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#clientePj_idClientePj" ).append( html );
  });
  grupos();
}*/
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
//  $("#grupoInicial").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = 0;
  clientePj = <?php echo $valorCliente[0]['idClientePj'];?> //$( "#clientePj_idClientePj option:selected" ).val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
    url:"<?php echo "../portais/modulos/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });  
}

function alunosGrupo(){
  var status, idGrupo, retorno;
  $("#grupo_idAlunos").empty();
  $("#grupo_idAlunos").append("<option value='-'>Alunos</option>");
  status = $("#statusG:checked").val();
  idGrupo = $("#grupo_idGrupo").val();
  retorno = $.ajax({
    url:"<?php echo "../portais/modulos/select_alunosGrupo.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,idGrupo:idGrupo}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idAlunos" ).append( html );
  });
  
}

//$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
$('#grupo_idGrupo').attr('onchange','alunosGrupo()');
//buscar();
grupos();
//ativarForm();
</script> 