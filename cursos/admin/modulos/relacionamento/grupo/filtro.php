<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Gerente = new Gerente();
$NivelEstudo = new NivelEstudo();
$clientepj = new ClientePj();

$Idioma = new Idioma();
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
          <label>Coordenador:</label>
          <?php echo $Gerente->selectGerenteSelect("", $gerente, " WHERE inativo = 0");?>
        </p>
        <p>
        <input type="hidden" name="aluno" id="aluno" value="1"  /><!--Mostrar alunos-->
        <p>
      <label> Tipo de contrato:       </label>
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="-" checked="checked">Todos <br>
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="0">Prazo indeterminado <br>
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="1">Pacote de horas <br>
      <input type="radio" name="tipoContrato" id="tipoContrato" class="required" value="2">Prazo Determinado  <br> </p>
        </div>   
     
      <div class="direita">
        
        <p>
          <label>Empresa:</label>
          <!--<?php echo $clientepj->selectClientePjSelect("","",$and);?>-->
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
        <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="2" onchange="grupos();">Ambos      
        </p>
        <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
        <p>
        <label>Idioma:</label>
        <?php echo $Idioma->selectIdiomaSelectMult(); ?>
        </p>
        
        
      </div> 
      <div class="linha-inteira">
        <button class="button blue" onclick="Enviar()" >Buscar</button>
      </div>
    </form>
 

</fieldset>
<fieldset>
  <legend>Grupos</legend>
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
  grupos();
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
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
  
}
function Enviar(){
    filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_REL."grupo/index.php"?>', '', 'lista_Grupos')
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
$('#grupo_idGrupo').attr('onchange','Enviar()');
buscar();
grupos();
ativarForm();
</script>