<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Certificacoes = new Certificacoes();
$Idioma = new Idioma();
$CertificadoCurso = new CertificadoCurso();

$idCertificacoes = $_GET['id'];	

$professorIdProfessor = $_GET['idProfessor'];

if($idCertificacoes!=''){
	
	$valorCertificacoes = $Certificacoes->selectCertificacoes("WHERE idCertificacoes=".$idCertificacoes);
	
	//CHAVES ESTRANGEIRAS
	$professorIdProfessor = $valorCertificacoes[0]['professor_idProfessor'];
	
	$certificado = $valorCertificacoes[0]['certificado'];
	$ano = $valorCertificacoes[0]['ano'];
	$tipo = $valorCertificacoes[0]['tipo'];
	$idIdioma = $valorCertificacoes[0]['idIdioma'];
}
	
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  --><fieldset>
    <legend>Certificações</legend>
    <form id="form_Certificacoes" class="validate" method="post" onsubmit="return false" >
       <input name="professor_idProfessor" type="hidden" value="<?php echo $professorIdProfessor?>" />
      <p>
        <label>Certificado:</label>
       <?php echo $CertificadoCurso->selectCertificadoCursoSelect("required", $certificado, "WHERE certificacao = 1")?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Ano:</label>
        <input type="text" name="ano" id="ano" class="required" value="<?php echo $ano ?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Tipo:</label>
        <input type="radio" name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked='checked'"; }?> /> Nacional 
        <input type="radio" name="tipo" id="tipo" value="2" <?php if ($tipo == 1) { echo "checked='checked'"; }?> /> Internacional
    
      <!--  <input type="text" name="instituicao" id="instituicao" class="required" value="<?php echo $instituicao ?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>-->
      <p>
        <label>Idioma:</label>
        <?php echo $Idioma->selectIdiomaSelect("",$idIdioma); ?>
       <!-- <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs ?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>-->
      <p>
        <button class="Bblue" onclick="enviadoOK();postForm('form_Certificacoes', 'modulos/cadastro/certificacoesAcao.php?id=<?php echo $idCertificacoes?>')">Salvar</button>
        <button class="button gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/formacaoPerfil.php', '#centro');">Fechar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
