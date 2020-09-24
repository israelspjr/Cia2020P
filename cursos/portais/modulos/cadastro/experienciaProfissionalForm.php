<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$ExperienciaProfissional = new ExperienciaProfissional();

$idExperienciaProfissional = $_GET['id'];	
$professor_idProfessor = $_SESSION['idProfessor_SS'];

if($idExperienciaProfissional!=''){
	
	$valorExperienciaProfissional = $ExperienciaProfissional->selectExperienciaProfissional(" WHERE idExperienciaProfissional = ".$idExperienciaProfissional);
	
	$professor_idProfessor = $valorExperienciaProfissional[0]['professor_idProfessor'];		
	$empresa = $valorExperienciaProfissional[0]['empresa'];
	$funcao = $valorExperienciaProfissional[0]['funcao'];
	$obs = $valorExperienciaProfissional[0]['obs'];				
}
	
?>

<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 --> <fieldset>
    <legend>Cadastro de experiencia profissional do professor</legend>
    <form id="form_experienciaProfissional" class="validate" action="" method="post" onsubmit="return false" >
      <input name="professor_idProfessor" type="hidden" value="<?php echo $professor_idProfessor?>" />
      <p>
        <label>Empresa:</label>
        <input type="text" name="empresa" id="empresa" class="required" value="<?php echo $empresa?>" />
        <span class="placeholder">Campo obrigatório</span>
      </p>
      <p>
        <label>Função:</label>
        <input type="text" name="funcao" id="funcao" class="required" value="<?php echo $funcao?>" />
        <span class="placeholder">Campo obrigatório</span>
      </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
      </p>
      <p>
        <button class="button blue" 
        onclick="enviadoOK();postForm('form_experienciaProfissional', '<?php echo "modulos/cadastro/experienciaProfissionalAcao.php?id=$idExperienciaProfissional"?>');" >Salvar</button>
        
             <button class="button blue" 
        onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/formacaoPerfil.php', '#centro');" >Fechar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>//ativarForm();
function enviadoOK() {
	alert("Conteúdo inserido/alterado com sucesso!");
}</script> 