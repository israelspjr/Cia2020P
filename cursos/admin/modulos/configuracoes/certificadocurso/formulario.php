<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$CertificadoCurso = new CertificadoCurso();
		
$idCertificadoCurso = $_REQUEST['id'];

if($idCertificadoCurso != '' && $idCertificadoCurso  > 0){

	$valor = $CertificadoCurso->selectCertificadoCurso('WHERE idCertificadoCurso='.$idCertificadoCurso);
	
	$idCertificadoCurso = $valor[0]['idCertificadoCurso'];
		 $titulo = $valor[0]['titulo'];
		 $conteudo = $valor[0]['conteudo'];
		 $inativo = $valor[0]['inativo'];
		 $dataCadastro = $valor[0]['dataCadastro'];
		 $excluido = $valor[0]['excluido'];
		 $nivel = $valor[0]['nivel'];
		 $area = $valor[0]['area'];
		 $certificacao = $valor[0]['certificacao'];
		 
	
}

?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro - Certificado Curso</legend>
    <form id="form_CertificadoCurso" class="validate"  method="post" onsubmit="return false" >
      
	  	 <input name="id" type="hidden" value="<?php echo $idCertificadoCurso ?>" />
        		<p>
				<label>Título:</label>
				<input type="text" name="titulo" id="titulo" class="required" value="<?php echo $titulo?>" style="width:600px"/>
				<span class="placeholder">Campo Obrigatório</span>
				</p> 
				
				<p>
				<label>Obs:</label>
				  <input type="text" name="conteudo" id="conteudo" cols="40"  rows="4" value="<?php echo $conteudo?>" style="width:600px"/>
				</p>
		 <p>
				<label for="inativo">Clique aqui se está relacionado a um nivel de estudo</label>
				  <input type="checkbox" name="nivel" id="nivel" value="1" <?php if($nivel != 0){ ?> checked="checked" <?php } ?> />
				</p>
                 <p>
				<label for="inativo">Clique aqui se está relacionado a uma área de experiência</label>
				  <input type="checkbox" name="area" id="area" value="1" <?php if($area != 0){ ?> checked="checked" <?php } ?> />
				</p>
                 <p>
				<label for="inativo">Clique aqui se está relacionado a uma certificação</label>
				  <input type="checkbox" name="certificacao" id="certificacao" value="1" <?php if($certificacao != 0){ ?> checked="checked" <?php } ?> />
				</p>
                 <p>
				<label for="inativo">Clique aqui se está relacionado a um curso de formação</label>
				  <input type="checkbox" name="formacao" id="formacao" value="1" <?php if($formacao != 0){ ?> checked="checked" <?php } ?> />
				</p>
                
                
		
         <p>
				<label for="inativo">Inativo</label>
				  <input type="checkbox" name="inativo" id="inativo" value="1" <?php if($inativo != 0){ ?> checked="checked" <?php } ?> />
				</p>
				 
				
				
	  
        <button class="button blue" onclick="postForm('form_CertificadoCurso', '<?php echo CAMINHO_MODULO?>configuracoes/certificadocurso/grava.php')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 

