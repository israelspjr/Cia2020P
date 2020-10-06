<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

	$Complemento = new ComplementoAbordagem();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$PlanoAcaoComplemento = new PlanoAcaoComplemento();
	$Professor = new Professor();
	
//	$idPlanoAcao = $_GET['id'];

 $where = " WHERE P.idProfessor = " . $_SESSION['idProfessor_SS'] . " AND PAG.inativo = 0 AND G.inativo = 0  ORDER BY PAG.idPlanoAcaoGrupo";

	$valorTotal = $Professor->selectGrupoProfTr_query($where);
//	Uteis::pr($valor);
?>
<div style="padding: 15px;">
<fieldset>
  <legend>Complemento de Abordagem Mêtricas e Cronogramas</legend>
  </fieldset>
  <div>
<?php 

 echo $Complemento->selectAbordagemCheckbox($idPlanoAcao); 
?>
</div>
</div>
<iframe id="abordagem" name="abordagem" style="display:none"></iframe></div>
