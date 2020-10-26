<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapasProcessoSeletivoProfessor.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ProcessoSeletivoProfessorComEtapas.class.php");	
	
	
	$EtapasProcessoSeletivoProfessor = new EtapasProcessoSeletivoProfessor();
	$ProcessoSeletivoProfessorComEtapas = new ProcessoSeletivoProfessorComEtapas();
	
	$idProcessoSeletivoProfessorComEtapas = $_GET['id'];
	$processoSeletivoProfessor_idProcessoSeletivoProfessor = $_GET['idProcessoSeletivoProfessor'];	
	
	if($idProcessoSeletivoProfessorComEtapas!=''){		
		$valorProcessoSeletivoProfessorComEtapas = $ProcessoSeletivoProfessorComEtapas->selectProcessoSeletivoProfessorComEtapas("WHERE idProcessoSeletivoProfessorComEtapas = ".$idProcessoSeletivoProfessorComEtapas);
			
		$processoSeletivoProfessor_idProcessoSeletivoProfessor = $valorProcessoSeletivoProfessorComEtapas[0]['processoSeletivoProfessor_idProcessoSeletivoProfessor'];
		$etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf = $valorProcessoSeletivoProfessorComEtapas[0]['etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf'];		
		$status = $valorProcessoSeletivoProfessorComEtapas[0]['status'];
		$dataReferencia = Uteis::exibirData($valorProcessoSeletivoProfessorComEtapas[0]['dataReferencia']);		
		$obs = $valorProcessoSeletivoProfessorComEtapas[0]['obs'];				
	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Cadastro dos dados da etapa do processo seletivo do professor</legend>
    <form id="form_processoSeletivoProfessorComEtapas" class="validate" method="post" onsubmit="return false" >
    	<input type="hidden" name="processoSeletivoProfessor_idProcessoSeletivoProfessor" id="processoSeletivoProfessor_idProcessoSeletivoProfessor" value="<?php echo $processoSeletivoProfessor_idProcessoSeletivoProfessor?>" />
      <p>
        <label>Etapa:</label>
        <?php 
		if($idProcessoSeletivoProfessorComEtapas==""){;
			$whereP = " WHERE inativo = 0 AND idEtapasProcessoSeletivoProfessor NOT IN (";
			$whereP .= "	SELECT COALESCE(etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf,0) FROM processoSeletivoProfessorComEtapas ";
			$whereP .= "	WHERE processoSeletivoProfessor_idProcessoSeletivoProfessor = ".$processoSeletivoProfessor_idProcessoSeletivoProfessor;
			$whereP .= ")";
			echo $EtapasProcessoSeletivoProfessor->selectEtapasProcessoSeletivoProfessorSelect($whereP, "required", $etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf);
		}else{
			$etapaSelecionada =  $EtapasProcessoSeletivoProfessor->selectEtapasProcessoSeletivoProfessor(" WHERE idEtapasProcessoSeletivoProfessor = ".$etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf);
			echo "<strong>".$etapaSelecionada[0]['nome']."</strong>";
			echo "<input type=\"hidden\" name=\"idEtapasProcessoSeletivoProfessor\" id=\"idEtapasProcessoSeletivoProfessor\" value=\"".$etapasProcessoSeletivoProf_idEtapasProcessoSeletivoProf."\" />";
			
		}
?><span class="placeholder">Campo Obrigatório</span>
      </p>
      <p>
        <label>Data de referência:</label>
        <input type="text" name="dataReferencia" id="dataReferencia_etapa" class="required data" value="<?php echo $dataReferencia?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Status:</label>
        <select name="status" id="status" class="">
          <option value="" >Selecione</option>
          <option value="1" <?php echo $status == 1 ? "selected" : "" ?>>aprovado</option>
          <option value="2" <?php echo $status == 2 ? "selected" : "" ?> >reprovado</option>
        </select><span class="placeholder">Campo Obrigatório</span>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" class="" cols="40" rows="4"><?php echo $obs?></textarea>
      </p>
      <p>
        <button class="button blue" onclick="postForm('form_processoSeletivoProfessorComEtapas', '<?php echo CAMINHO_CAD."professor/"?>include/acao/processoSeletivoProfessorComEtapas.php?id=<?php echo $idProcessoSeletivoProfessorComEtapas?>');" >Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>
	ativarForm();
</script> 