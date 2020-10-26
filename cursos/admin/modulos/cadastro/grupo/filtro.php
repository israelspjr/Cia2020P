<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$Grupo = new Grupo();
$Gerente = new Gerente();
$clientepj = new ClientePj();
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
        </div>   
     
      <div class="direita">
        
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
    url:"<?php echo CAMINHO_CAD."grupo/select_cliente.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#clientePj_idClientePj" ).append( html );
  });
  
}
function Enviar(){
    filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_CAD."grupo/index.php"?>', '', 'lista_Grupos')
}
$('#idGerente').attr('onchange', 'buscar()');
buscar();
ativarForm();
</script>