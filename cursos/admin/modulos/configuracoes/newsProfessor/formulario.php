<?php
//pagina conteudo o formulario 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

	
	$NewsProfessor = new NewsProfessor();
//	$TipoAtividadeExtra = new TipoAtividadeExtra();
		
$idNewsProfessor = $_REQUEST['id'];

if($idNewsProfessor != '' && $idNewsProfessor  > 0){

	$valor = $NewsProfessor->selectNewsProfessor('WHERE idNewsProfessor='.$idNewsProfessor);
	
	$idAtividadeExtra = $valor[0]['idNewsProfessor'];
//		 $tipoAtividadeExtra_idTipoAtividadeExtra = $valor[0]['tipoAtividadeExtra_idTipoAtividadeExtra'];
		 $grupo = $valor[0]['grupo'];
		 $excluido = $valor[0]['inativo'];
		 $texto = $valor[0]['news'];
		 $portal = $valor[0]['portal'];
		 $popup = $valor[0]['popup'];
		 
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro de News Portal do Professor</legend>
    <form id="form_AtividadeExtra2" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idNewsProfessor ?>" />
      
      <div class="esquerda">
				<p>
                 <label>Somente professor com grupo:</label>
        <strong><input type="checkbox" id="grupo" name="grupo" value="1" <?php if($grupo==1){ echo "checked";}?>/></strong></p>
        
        <p><label>Portal</label>
        <select name="portal" id="portal">
        <option value="1" <?php if($portal == 1){ echo "selected=\"selected\""; } ?>>Portal do professor</option>
        <option value="2" <?php if($portal == 2){ echo "selected=\"selected\""; } ?>>Portal do RH</option>
        <option value="3" <?php if($portal == 3){ echo "selected=\"selected\""; } ?>>Portal do aluno</option>
        
        </select>        
        	 <p> <label>News Inativa:</label>
        <strong><input type="checkbox" id="inativo" name="inativo" value="1" <?php if($excluido==1){ echo "checked";}?>/></strong>
             </p>
        </div>
        <div class="direita">
        <p> <label>Ativar Pop-up:</label>
        <strong><input type="checkbox" id="popup" name="popup" value="1" <?php if($popup==1){ echo "checked";}?>/></strong>
        
        
        </p>
        </div>
        <div class="linha-inteira">
                
				<p>
				<label>Texto:</label>
				<textarea name="texto_base" id="texto_base" class="tinymce" ><?php echo $texto?></textarea>
				<textarea name="texto" id="texto" class="" ></textarea>								

			</p>
				
				
			
	  
        <button class="button blue" onclick="postForm_editor('texto', 'form_AtividadeExtra2', '<?php echo CAMINHO_MODULO?>configuracoes/newsProfessor/grava.php')">Salvar</button>
        
      </p>
      </div>
    </form>
  </fieldset>
</div>
<script>
viraEditor('texto');
ativarForm();</script> 

