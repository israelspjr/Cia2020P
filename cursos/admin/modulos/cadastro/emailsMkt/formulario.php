<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	
$EmailsMkt = new EmailsMkt();
$ClientePj = new ClientePj();
$Segmento = new Segmento();


$idEmailsMkt = $_GET['id'];	


if($idEmailsMkt!='' && $idEmailsMkt>0){
	
	$valorEmailsMkt = $EmailsMkt->selectEmailsMkt('WHERE idEmailsMkt='.$idEmailsMkt);
	
	$idEmailsMkt = $valorEmailsMkt[0]['idEmailsMkt'];
	$clientePjIdClientePj = $valorEmailsMkt[0]['clientePj_idClientePj'];
	$nome = $valorEmailsMkt[0]['nome'];
	$valor = $valorEmailsMkt[0]['valor'];
	$inativo = $valorEmailsMkt[0]['inativo'];
	$idSegmento = $valorEmailsMkt[0]['segmento_idSegmento'];
	
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>EmailsMkt</legend>
    
    <div class="esquerda"> 
    <form id="form_EmailsMkt" class="validate" method="post" action="" onsubmit="return false" >
 
                      
        <p>
          <label>Nome:</label>          
          <input type="text" name="descricao" id="descricao"   onsubmit="return false" value="<?php echo $nome?>" />
      
        <!--funcao retorna descricaoEmailsMkt-->
        </p>
        <p>
          <label>Valor:</label>          
          <input type="text" name="valor" id="valor"  class="required" onsubmit="return false" value="<?php echo $valor?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoEmailsMkt-->
        </p>
        <p>
          <label>Empresa à qual pertence:</label>
          <?php echo $ClientePj->selectClientePjSelect($clientePjIdClientePj, "");?> <span class="placeholder">Campo Obrigatório</span> </p>
          <p>
           <label>Segmento à qual pertence:</label>
          <?php echo $Segmento->selectSegmentoSelect("required", $idSegmento);?>  </p>
        
         <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
          <p>
        <button class="button blue" onclick="postForm('form_EmailsMkt', '<?php echo CAMINHO_CAD?>emailsMkt/grava.php?id=<?php echo $idEmailsMkt?>')">Salvar</button>
        </div>
        </form>
         <div class="direita">
      <!--  <form id="form_EmailsMktCsv" class="validate" method="post" action="" onsubmit="return false" >-->
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <label><span style="color:red;">Escolha o segmento antes de enviar o Arquivo CSV</span></label>
        <p>
   <!--       <label>Empresa à qual pertence:</label>
          <?php echo $ClientePj->selectClientePjSelect($clientePjIdClientePj, "required");?> <span class="placeholder">Campo Obrigatório</span> </p> </p>-->
        
        <p><img src="<?php echo CAMINHO_IMG."csv.png";?>" title="Upload de arquivo EXCEL (.CSV)" 
		onclick="$('#formCsv #csvFile').click()" /></p>
        
          <form id="formCsv" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_CAD?>emailsMkt/acao.php" >
      <input type="hidden" id="acao" name="acao" value="cadastrar" style="display:none;"/>
      <input type="hidden" id="clientePj" name="clientePj" value="" style="display:none;"/>
      <input type="file" name="csvFile" id="csvFile" onchange="uploadCsv();" style="display:none;"/>
      <input type="hidden" name="segmento" id="segmento" size="80" value = ""/>
    </form>
        </div>
      </p>
      <div>
      <label>Cole aqui os emails (um por linha):</label>
      <p><textarea name="emails" id="emails" rows="10" cols="30"></textarea></p>
      <button class="button blue" name="Enviar" id="Enviar" onclick="enviar()">Enviar </button>
      <div id="resultado"></div>
      </div>
      
   
  </fieldset>
</div>

<script>ativarForm();</script> 
<script>
$('#clientePj_idClientePj').attr('onchange','clientePj()');
$('#segmento_idSegmento').attr('onchange','segmento()');

function clientePj() {
	 var id = $('#clientePj_idClientePj').val();
	 $('#clientePj').val(id);
}

function segmento() {
	 var id = $('#segmento_idSegmento').val();
	 $('#segmento').val(id);
}

function uploadCsv(){
	 
    if( confirm('Deseja fazer o upload desse arquivo?') ){
      postFileForm('formCsv');
    }
}

function enviar() {
	var id = $('#segmento_idSegmento').val();
	
	if (id == '') {
		alert("Escolha UM segmento");
		return false;
	} else {
	var texto = $('#emails').val();
	var acao = 'emails';
	
 retorno = $.ajax({
    url:"<?php echo CAMINHO_CAD."emailsMkt/acao.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{id:id,acao:acao,texto:texto}   
  });
  retorno.done(function( html ) {
    $( "#resultado" ).html("");
    $( "#resultado" ).append( html );
  });
 	
	}
}
/*
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
  
}*/
  
</script>