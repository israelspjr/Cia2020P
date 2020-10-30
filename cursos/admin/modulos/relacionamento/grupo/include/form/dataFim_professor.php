<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$AulaGrupoProfessor = new AulaGrupoProfessor();
$Professor = new Professor();

$idProfessor = $_GET['idProfessor'];
$idAulaPermanenteGrupo = $_GET['idAulaPermanenteGrupo'];


if ($idAulaPermanenteGrupo) {

	$valorAulaGrupo = $AulaGrupoProfessor->selectAulaGrupoProfessor('WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo =' . $idAulaPermanenteGrupo. " AND professor_idProfessor = ".$idProfessor);
	//Uteis::pr($valorAulaGrupo);

	$Nome = $Professor->getNome($idProfessor);
	$dataFim = Uteis::exibirData($valorAulaGrupo[0]['dataFim']);
	$idAulaGrupoProfessor = $valorAulaGrupo[0]['idAulaGrupoProfessor'];

}
?>
<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Alterar data de saída do professor
		</legend>
		<form id="form_BancoHoras" class="validate" action="" method="post" onsubmit="return false" >
			<p>
				<label>Nome do Professor: </label>
				<?php echo $Nome;
				?>
			</p>

			<p>
				<label>Nova data de saída: </label>
				<input type="text" name="dataFim" id="dataFim" value="<?php echo $dataFim ?>" class="data" />
			</p>

			<p>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/dataFim_professor.php?id=$idAulaGrupoProfessor&idProfessor=$idProfessor"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
