<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Gerente = new Gerente();
$NivelEstudo = new NivelEstudo();
$clientepj = new ClientePj();

$mes = date('m');
$ano = date('Y');

?>

<fieldset>
  <legend>Filtros</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="esquerda">
        <p>
          <label>Empresas Ativas:</label>
          <input type="radio" name="status" id="status" value="0" onchange="buscar();" checked="checked">Ativo &nbsp;
          <input type="radio" name="status" id="status" value="1" onchange="buscar();">Inativo &nbsp;
          <input type="radio" name="status" id="status" value="-"  onchange="buscar();">Ambos      
        </p>
        <p>
          <label>Gerente:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
        <p>
         <strong>De: </strong>
        
        <select name="mes_ini" id="mes_ini" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
        
        <select name="ano_ini" id="ano_ini" class="required">
          <?php for($x = date('Y')+1; $x >= 2015; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
           <p>
          <strong>Até:</strong> 
        
        <select name="mes_fim" id="mes_fim" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
        
        <select name="ano_fim" id="ano_fim" class="required">
          <?php for($x = date('Y')+1; $x >= 2015; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
      <label>Tipo</label>
      <input type="radio" name="tipo" id="tipo" value="0"   >Resumido &nbsp;
          <input type="radio" name="tipo" id="tipo" value="1" checked="checked">Detalhado &nbsp;
      
        </div>   
     
      <div class="direita">
        
        <p>
          <label>Empresa:</label>
          <!--<?php echo $clientepj->selectClientePjSelect("","",$and);?>-->
          <select id="clientePj_idClientePj" name="clientePj_idClientePj" class="required">
            <option value="-">Empresas</option>            
          </select>
        </p>
        
       
       <p>
          <label>Grupos Ativos:</label>
            <input type="radio" name="statusG" id="statusG" value="0" onchange="professor();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="professor();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="2" onchange="professor();">Ambos      
        </p>
        
         <p>
        <label>Professor</label>
        <select id="professor_idProfessor" name="professor_idProfessor">
                 <option value="-">Professor</option>  
            </select>
        
        </p>
   <!--     <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
     <!--    <p>
            <label>Frequências: </label>
            <input name="frequencia" type="radio" value="-" checked="checked" selected>Todos</input><br />
            <input type="radio"  name="frequencia" value="1">Abaixo de <?php echo $FME?>%</input><br />
            <input type="radio" name="frequencia" value="2">Somente 100%</input><br />-->
      </div> 
      <div class="linha-inteira">
        <button class="button blue" onclick="Enviar()" >Buscar</button>
      </div>
    </form>
 

</fieldset>
<fieldset>
  <legend>Aulas pagas por professor</legend>
  <div id="lista_Grupos" class="lista">
  </div>
</fieldset>
<script>
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
function professor(){
  var status, clientePj, retorno;
  $("#professor_idProfessor").empty();
  $("#professor_idProfessor").append("<option value='-'>Professor</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_professor.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#professor_idProfessor" ).append( html );
	
  });
  
}
function Enviar(){
	if ($( "#clientePj_idClientePj" ).val() > 0) {
	
    filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_RELAT."aulasPagas/aulasPagas.php"?>', '', '#lista_Grupos');
	} else {
		alert("Selecione uma empresa");
	}
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','professor()');
//$('#grupo_idGrupo').attr('onchange','Enviar()');
buscar();
//professor();
ativarForm();
</script>



