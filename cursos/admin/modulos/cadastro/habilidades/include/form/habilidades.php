<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Habilidades = new Habilidades();
//$DecricaoHabilidades = new DescricaoHabilidades(); 

$idHabilidades = $_GET['id'];
$idProfessor = $_REQUEST['idProfessor'];	


if($idHabilidades!='' && $idHabilidades>0){
	
	$valorHabilidades = $Habilidades->selectHabilidades('WHERE idHabilidades='.$idHabilidades);
	
	$idHabilidades = $valorHabilidades[0]['idHabilidades'];
	$descricao = $valorHabilidades[0]['descricao'];
	$inativo = $valorHabilidades[0]['inativo'];	
	$pergunta = $valorHabilidades[0]['pergunta'];
	$tipo = $valorHabilidades[0]['tipo'];		
}
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <!--clientePf_idClientePf é a FK-->
  
  <fieldset>
    <legend>Interesse / Hobby</legend>
    <form id="form_Habilidades" class="validate" method="post" action="" onsubmit="return false" >
      
      <div class="esquerda">    
      <input type="hidden" id="idProfessor" name="idProfessor" value="<?php echo $idProfessor?>"/>   
      <input type="hidden" id="idHabilidades" name="idHabilidades" value="<?php echo $idHabilidades?>"/> 
      
      <p>
      <label>Habilidade Pai:</label>
      <?php echo $Habilidades->selectHabilidadesSelect()?>
      </p>
                 
        <p>
          <label>Descrição:</label>          
          <input type="text" name="descricao" id="descricao"  class="" onsubmit="return false" value="<?php echo $descricao?>" />
        </p>
        
        <p><label>Pergunta:</label>
          <input type="text" name="pergunta" id="pergunta"  class="" style="width:600px;" onsubmit="return false" value="<?php echo $pergunta?>" />
        </p>
        
        <p><label>Tipo de resposta:</label>
         <input type="radio" name="tipo" id="tipo" value="0" <?php if ($tipo == 0) { echo "checked='checked'"; } ?> /> Somente Habilidade.<br />
        <input type="radio" name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked='checked'"; } ?> /> Não / Sim mas sem experiência / Sim com experiência.<br />
        <input type="radio" name="tipo" id="tipo" value="2" <?php if ($tipo == 2) { echo "checked='checked'"; } ?> /> Não / Sim Qual?<br />
        <input type="radio" name="tipo" id="tipo" value="3" <?php if ($tipo == 3) { echo "checked='checked'"; } ?> /> Não / Sim mas sem experiência / Sim com experiência (escolas).
        </p>
        <p>
          <label>Inativo:</label>
          <input type="checkbox" name="inativo" id="inativo" onsubmit="return false" value="1" <?php if ($inativo == 1) { echo "checked=checked"; } ?>" />

        <p>
   <!--       </div>
      <div class="direita">
        
      </div>-->
      <p>
        <button class="button blue" onclick="postForm('form_Habilidades', '<?php echo CAMINHO_CAD?>habilidades/include/acao/habilidades.php?id=<?php echo $idHabilidades?>')">Salvar</button>
        
      </p>
      </div>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 