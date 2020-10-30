<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	
$CampanhaEmail = new CampanhaEmail();
$ClientePj = new ClientePj();
$ClientePf = new ClientePf();
$Segmento = new Segmento();


$idCampanhaEmail = $_GET['id'];	


if($idCampanhaEmail!='' && $idCampanhaEmail>0){
	
	$valorCampanhaEmail = $CampanhaEmail->selectCampanhaEmail('WHERE idCampanhaEmail='.$idCampanhaEmail);
	
	$idCampanhaEmail = $valorCampanhaEmail[0]['idCampanhaEmail'];
	$clientePjIdClientePj = $valorCampanhaEmail[0]['clientePj_idClientePj'];
	$clientePfIdClientePf = $valorCampanhaEmail[0]['clientePf_idClientePf'];
	$titulo = $valorCampanhaEmail[0]['titulo'];
	$texto = $valorCampanhaEmail[0]['texto'];	
	$dataEnvio = Uteis::exibirData($valorCampanhaEmail[0]['dataEnvio']);
	$assunto = $valorCampanhaEmail[0]['assunto'];
	$nomeEnvio = $valorCampanhaEmail[0]['nomeEnvio'];
	$inativo = $valorCampanhaEmail[0]['inativo'];
	$horaEnvio = $valorCampanhaEmail[0]['horaEnvio'];
	$emailEnvio = $valorCampanhaEmail[0]['emailEnvio'];
	
	
}
date_default_timezone_set('America/Sao_Paulo');

$horaR = explode(":",$horaEnvio);

if ($horaR[0] > 0) {
	$hora = $horaR[0];
	$minutos = $horaR[1];
} else {
	$hora = date("H") + 1;
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>Campanha Email Marketing</legend>
    <form id="form_CampanhaEmail" class="validate" method="post" action="" onsubmit="return false" >
    
   
    
    <div class="esquerda"> 
 
                      
        <p>
          <label>Título:</label>          
          <input type="text" name="titulo" id="titulo" class="required"  onsubmit="return false" value="<?php echo $titulo?>" />
      <span class="placeholder">Campo Obrigatório</span>
            
        <!--funcao retorna descricaoCampanhaEmail-->
        </p>
       
        <p>
          <label>Empresa à qual pertence:</label>
          <?php echo $ClientePj->selectClientePjSelect($clientePjIdClientePj, "");?> 
    </p>
      <p>
          <label>Cliente pessoa fisica à qual pertence:</label>
          <?php echo $ClientePf->selectClientePfSelect($clientePfIdClientePf, "");?> </p>
         
          <p>
           <label>Data de envio:</label>
          <input type="text" name="dataEnvio" id="dataEnvio" class=" required data" value="<?php echo $dataEnvio?>"  />
          <span class="placeholder">Campo Obrigatório</span>
        </p>
        <p>
           <label>Hora de envio:</label>
           <select name="hora" id="hora">
           <?php for ($x=0;$x<24;$x++) {
			   
			    if ($x == $hora) {
				   $checked = "selected";
			   } else {
				   $checked = "";  
			   } 
			   
			   if ($x <10) {
				$y = "0".$x;   
			   } else {
				$y = $x;   
     		   }
			   
			  
			  echo "<option $checked value=\"".$x."\" >".$y."</option>";
			   
			   
			   
		   }?>
           </select>
             <select name="minutos" id="minutos">
          <option value="00" <?php if ($minutos == 0) { echo "selected"; } ?>>00</option>
          <option value="15" <?php if ($minutos == 15) { echo "selected"; } ?>>15</option>
          <option value="30" <?php if ($minutos == 30) { echo "selected"; } ?>>30</option>
          <option value="45" <?php if ($minutos == 45) { echo "selected"; } ?>>45</option>
          </select>
          <input type="hidden" name="horaEnvio" id="horaEnvio" class=" required hora" value=""  />
          <!--<span class="placeholder">Campo Obrigatório</span>-->
        </p>
        <p>
          <label>Assunto:</label>          
          <input type="text" name="assunto" id="assunto"  class="required" onsubmit="return false" value="<?php echo $assunto?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoCampanhaEmail-->
        </p>
         <p>
          <label>Nome Remetente:</label>          
          <input type="text" name="nomeEnvio" id="nomeEnvio"  class="required" onsubmit="return false" value="<?php echo $nomeEnvio?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoCampanhaEmail-->
        </p>
          <p>
          <label>Email Remetente:</label>          
          <input type="text" name="emailEnvio" id="emailEnvio"  class="required" onsubmit="return false" value="<?php echo $emailEnvio?>" />
      <span class="placeholder">Campo Obrigatório</span>
        <!--funcao retorna descricaoCampanhaEmail-->
        </p>
        
         <p>
          <label>
            <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
            Inativo</label>
        </p>
        </div>
        <div class="esquerda">
        <label>Escolha os segmentos:</label>
        <?php echo $Segmento->totalSegmentoCheckbox("", $idCampanhaEmail) ?>
        
    
        
        </div>
         <div class="linha-inteira">
 <style>
 .validate p span {
	display:block; 
	 
 }
 
 </style>   
        <p>
          <label>Texto:</label>          
          <textarea name="valorTexto" id="valorTexto" style="display:block"></textarea>
                <textarea name="valorTexto_base" id="valorTexto_base" rows="6" cols="80"><?php echo $texto;?>
                </textarea>
      <span class="placeholder">Campo Obrigatório</span>
      
      <input name="image" type="file" id="upload" class="hidden" onchange="" style="display:none;">
        <!--funcao retorna descricaoCampanhaEmail-->
        </p>
        
      
        <p><label style="color:red">Antes de enviar Salve!</label></p>
          <p>
        <button class="button blue" onclick="enviar();postForm_editor('valorTexto','form_CampanhaEmail', '<?php echo CAMINHO_REL?>campanhaEmail/grava.php?id=<?php echo $idCampanhaEmail?>'); ">Salvar</button>
         <button class="button blue" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL?>campanhaEmail/disparoEmail.php?idCampanhaEmail=<?php echo $idCampanhaEmail?>', '', '')">Enviar Teste</button>
          <button class="button blue" onclick="postForm_editor('valorTexto','form_CampanhaEmail', '<?php echo CAMINHO_REL?>campanhaEmail/disparo.php?acao=disparar&idCampanhaEmail=<?php echo $idCampanhaEmail?>')">Enviar Agora</button>
           <button class="button blue" onclick="postForm_editor('valorTexto','form_CampanhaEmail', '<?php echo CAMINHO_REL?>campanhaEmailddisparo.php?acao=agendar&idCampanhaEmail=<?php echo $idCampanhaEmail?>')">Agendar Campanha</button>
        </div>
        </form>
    
<script>
function enviar() {
	var hora = $('#hora').val();
	var minutos = $('#minutos').val();
	$('#horaEnvio').val(hora+":"+minutos+":00");
}
ativarForm();
viraEditor("valorTexto");
</script> 
