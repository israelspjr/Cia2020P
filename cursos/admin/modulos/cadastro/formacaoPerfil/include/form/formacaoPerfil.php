<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FormacaoPerfil = new FormacaoPerfil();
$Certificacoes = new Certificacoes();
$CertificadoCurso = new CertificadoCurso();
$Escola = new Escola();

$idFormacaoPerfil = $_GET['id'];	

$clientePfIdClientePf = $_GET['idClientePf'];
$professorIdProfessor = $_GET['idProfessor'];

if($idFormacaoPerfil!=''){
	
	$valorFormacaoperfil = $FormacaoPerfil->selectFormacaoperfil("WHERE idFormacaoPerfil=".$idFormacaoPerfil);
	
	//CHAVES ESTRANGEIRAS
	$clientePfIdClientePf = $valorFormacaoperfil[0]['clientePf_idClientePf'];		
	$professorIdProfessor = $valorFormacaoperfil[0]['professor_idProfessor'];
	
	$formacao = $valorFormacaoperfil[0]['formacao'];
	$curso = $valorFormacaoperfil[0]['curso'];
	$instituicao = $valorFormacaoperfil[0]['instituicao'];
	$obs = $valorFormacaoperfil[0]['obs'];
	$finalizado = $valorFormacaoperfil[0]['finalizado'];
}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Formação escolar</legend>
    <form id="form_formacaoPerfil" class="validate" method="post" onsubmit="return false" >
      <input name="clientePf_idClientePf" type="hidden" value="<?php echo $clientePfIdClientePf?>" />
      <input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
       <p>
     <label>Formação:</label>
    <?php echo $CertificadoCurso->selectCertificadoCursoSelect("required", $formacao, "WHERE nivel = 1")?>
     </p>
       <p>
        <label>Curso:</label>
       <?php echo $CertificadoCurso->selectCertificadoCursoSelect("required", $certificado, "WHERE formacao = 1", 1)?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Instituição:</label>
     	<?php echo $Escola->selectEscolaselect()?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
      <p>
      <label>Finalizado:</label>
      <input type="radio" value="1" name="finalizado" id="finalizdo" <?php if ($finalizado == 1) { echo "checked"; }?>/>Sim
      <input type="radio" value="0" name="finalizado" id="finalizdo" <?php if ($finalizado == 0) { echo "checked"; }?>/>Não
      </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs ?></textarea>
        <span class="placeholder">Campo Obrigatório</span> 
     </p>
        <button class="button blue" onclick="postForm('form_formacaoPerfil', '<?php echo CAMINHO_CAD?>formacaoPerfil/include/acao/formacaoPerfil.php?id=<?php echo $idFormacaoPerfil?>')">Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
