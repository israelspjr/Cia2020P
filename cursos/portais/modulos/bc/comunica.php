<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$Comunica = new Comunica();
$Idioma = new Idioma();
//$DecricaoHabilidades = new DescricaoHabilidades(); 

$idArquivos = $_GET['id'];	


if($idArquivos!='' && $idArquivos>0){
	
	$valorArquivos = $Comunica->selectArquivos('WHERE idArquivos='.$idArquivos);
	
	$idArquivos = $valorArquivos[0]['idArquivos'];
	$descricao = $valorArquivos[0]['nomeArquivo'];
	$inativo = $valorArquivos[0]['ativo'];		
	$link = $valorArquivos[0]['link'];
	$bc = $valorArquivos[0]['bc'];
}
?>
<!--<div id="comunica">
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>Comunicação</legend>
    <form id="form_Habilidades" class="validate" method="post" action="" onsubmit="return false" >
      
      <div class="esquerda">                 
        <p>
          <label>Descrição:</label>          
          <input type="text" name="descricao" id="descricao"  class="required" onsubmit="return false" style="width:600px" value="<?php echo $descricao?>" />
          <span class="placeholder">Campo Obrigatório</span> </p>      
        </p>
        
        <p>
          <label>Link:</label>          
          <input type="text" name="link" id="link"  class="required" onsubmit="return false" value="<?php echo $link?>" style="width:600px"/>
          <span class="placeholder">Campo Obrigatório</span> </p>      
        </p>
        
        <p>
        <Label>idioma:</Label>
        <?php echo $Idioma->selectIdiomaSelect(); ?>
        </p>
        </form>
  </fieldset>
      <p>
        <button class="Bblue" onclick="postForm('form_Habilidades', 'modulos/bc/acao.php')">Salvar</button>    <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/bc/index', '#centro');">Fechar</button>
        
      </p>
      </div>
   
</div>
<script>
function fecharForm() {
$('#comunica').html('');
$('#comunica').hide();	
	
}

ativarForm();</script> 