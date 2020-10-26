<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$FolhaFrequencia = new FolhaFrequencia();
$DiaFP = new DiaFP();

$idDiaFP = $_GET['id'];
$idFolhaFrequencia = $_GET['idFolhaFrequencia'];

if($idDiaFP){
	
	$valorDiaFP = $DiaFP->selectDiaFP(" WHERE idDiaFP = ".$idDiaFP);
	
	$dataAula = $valorDiaFP[0]['dataAula'];
	$horaRealizada = Uteis::exibirHorasInput($valorDiaFP[0]['horaRealizada']);
	$obs = $valorDiaFP[0]['obs'];
	$valorDiaFP[0][''];
	
}

$valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = ".$idFolhaFrequencia);
	$idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$idProfessor = $valorFolhaFrequencia[0]['professor_idProfessor'];
	$dataReferencia = $valorFolhaFrequencia[0]['dataReferencia'];
		$data = explode("-", $dataReferencia);
		$mesRef = $data[1];
		$anoRef = $data[0];	

$diasNoMes = Uteis::totalDiasMes($mesRef, $anoRef);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Inserir reposição</legend>
    <form id="form_DiaAulaReposicaoBancoHoras" class="validate" method="post" action="" onsubmit="return false" >
      
      <input type="hidden" name="idFolhaFrequencia" id="idFolhaFrequencia" value="<?php echo $idFolhaFrequencia?>"/>      
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>"/>      
      <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor?>"/>      
      
      <input type="hidden" name="acao" id="acao" value="reposicao"/> 
      
      <p>
        <label>Dia:</label>
        <select name="dataAula" id="dataAula" class="required" >
          <option value="">Selecione</option>
          <?php for($dia=1; $dia <= $diasNoMes; $dia++){
				 $d = str_pad($dia, 2, '0', STR_PAD_LEFT);
				 $diaAtual = "$anoRef-$mesRef-$d"?>
          <option value="<?php echo $diaAtual?>" <?php echo $diaAtual == $dataAula ? "selected" : ""?> > <?php echo $dia?></option>
          <?php }?>
        </select>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Total de Horas repostas:</label>
        <input type="text" name="horasDadas" id="horasDadas" class="required hora" value="<?php echo $horaRealizada?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Informações sobre a reposição (Obrigátorio)+ conteúdo da aula (Opcional):</label>
        <textarea name="obs" id="obs" class="required" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" 
        onclick="postForm('form_DiaAulaReposicaoBancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/DiaFP.php?idDiaFP=".$idDiaFP?>')" >Salvar</button>
        
      </p>
    </form>
  </fieldset>
</div>
<script>
ativarForm();
</script> 
