<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BancoHoras = new BancoHoras();
//$Professor = new Professor();
$FolhaFrequencia = new FolhaFrequencia();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$clientepj = new ClientePj();
$Professor = new Professor();

$idBancoHoras = $_GET['id'];

$sql = "SELECT BH.horas, DF.dataAula, O.sigla FROM bancoHoras as BH 
inner join diaAulaFF as DF on BH.diaAulaFF_idDiaAulaFF = DF.idDiaAulaFF
inner join ocorrenciaFF as O on DF.ocorrenciaFF_idOcorrenciaFF = O.idOcorrenciaFF
where idBancoHoras =".$idBancoHoras;

$rs2 = Uteis::executarQuery($sql);

//Uteis::pr ($rs2);

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
//echo $idPlanoAcaoGrupo;


$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}
//Uteis::pr($valorX);

$valorx2 = implode(', ',$valorX);

//Uteis::pr($valorx2);

$sql = "select  distinct(P.nome), FF.professor_idProfessor from folhaFrequencia AS FF
INNER join professor AS P on P.idProfessor = FF.professor_idProfessor
 where planoAcaoGrupo_idPlanoAcaoGrupo in ( ".$valorx2 .")";
 
 	$rs = Uteis::executarQuery($sql);
	
for ($x=0;$x<count($rs);$x++) {
	
$idProf[] = $rs[$x]['professor_idProfessor'];
}

$idProf2 = implode(',', $idProf);
 

if ($idDiasAulaFF) {

	$valorBancoHoras = $BancoHoras-> selectBancoHoras('WHERE idBancoHoras=' . $idBancoHoras);
	//Uteis::pr($valorBancoHoras);

	$Professor_NomeProfessorRep = Uteis::exibirHoras($valorBancoHoras[0]['professor_NomeProfessorRep']);
//	$dataExpira = Uteis::exibirData($valorBancoHoras[0]['dataExpira']);

}

$where = "WHERE FF.planoAcaoGrupo_idPlanoAcaoGrupo in ( ".$valorx2 .")  
				 AND FF.professor_idProfessor in ( ".$idProf2 .")
                 AND DFF.reposicao = 1
                 AND FF.finalizadaPrincipal = 1";
/*AND (DFF.dataAula is not Null AND DFF.dataAula <= '" . $dataReferenciaFinal . "') 
				AND DFF.idDiaAulaFF NOT IN (" . implode(",", $jaForamInseridos) . ") 
				ORDER BY DFF.dataAula ASC";*/
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
			Inserir/ Alterar professor de reposição
		</legend>
		<form id="form_BancoHoras" class="validate" action="" method="post" onsubmit="return false" >
        
        		
		
        		<label>Ocorrência: <?php echo $rs2[0]['sigla']; ?></label> 
                <label>Data:  <?php echo $rs2[0]['dataAula']; ?>     </label>
                <label>Horas: <?php echo $rs2[0]['horas']; ?>  </label>      

	<!--		<p>
				<label>Professor: </label>
                <select id="idProfessor" name="idProfessor">
                <option value"-">Selecione</option>
                <?php /*for ($x=0;$x<count($rs);$x++) {
					echo "<option value=".$rs[$x]['professor_idProfessor'].">".$rs[$x]['nome']."</option>";
				}*/
				?>
                </select>               				
			</p>-->
			<p><label> Gere a Folha de frequência para que o professor e a aula de reposição apareça aqui ou selecione o professor que irá fazer assumir a ocorrência.</label></p>
		
        	 <p>
          <label>Dias Repostos:</label>
              <?php echo $BancoHoras->selectBancoHorasReposicaoTr($where); ?>
          </p>
          
          <label> Professor</label>
          <p>
			<?php echo $Professor->selectProfessorSelect(); ?>
            </p>
            
            <p>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo CAMINHO_REL."grupo/include/acao/professor_reposicao.php?id=$idBancoHoras&idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>');">
					Enviar
				</button>
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
