<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$Comunica = new Comunica();
$Idioma = new Idioma();
$Segmento = new Segmento();
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
        <Label>Categoria:</Label>
        <?php echo $Segmento->selectSegmentoSelectBc(); ?>
        </p>
        
        <p>
        <Label>idioma(Arquivos de VPG):</Label>
        <?php echo $Idioma->selectIdiomaSelect(); ?>
        </p>
        
        
        <p>
          <label>Ativo:</label>
          <input type="checkbox" name="inativo" id="inativo" onsubmit="return false" value="1" <?php if ($inativo == 1) { echo "checked=checked"; } ?> />

        <p>
        
         <p>
          <label>Banco de conhecimento:</label>
          <input type="checkbox" name="bc" id="bc" onsubmit="return false" value="1" <?php if ($bc == 1) { echo "checked=checked"; } ?> />

        <p>
   <!--       </div>
      <div class="direita">
        
      </div>-->
      <p>
        <button class="button blue" onclick="postForm('form_Habilidades', '<?php echo CAMINHO_CAD?>comunica/include/acao/comunica.php?id=<?php echo $idArquivos?>')">Salvar</button>
        
      </p>
      </div>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 