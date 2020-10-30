<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$BancoHoras = new BancoHoras();
$DiaAulaFF = new DiaAulaFF();
$FolhaFrequencia = new FolhaFrequencia();

$idFolhaFrequencia = $_REQUEST['idFolhaFrequencia'];

$vff = $FolhaFrequencia->selectFolhaFrequencia(" Where idFolhaFrequencia = ".$idFolhaFrequencia);
$idPlanoAcaoGrupo = $vff[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
$idGrupo = $valorPlanoAcaoGrupo[0]['grupo_idGrupo'];

//$idGrupo = $_REQUEST['idGrupo'];

$respostas = $BancoHoras->bancoHorasTo($idGrupo, $idPlanoAcaoGrupo);

if ($respostas['saldo'] <= 0) {
	
$saldoG = -1 *	$respostas['saldo'];
} else {
	
$saldoG = $respostas['saldo'];

}
 
?>
   
 <fieldset>
   <legend>Tabela Banco de Horas </legend> 
    <div>
    <p>Mês de referência:  <?php echo  date('m/Y', strtotime($respostas['dataReferenciaF'])) ?></p>
	<p>Total de horas não realizadas: <strong><?php echo Uteis::exibirHoras($respostas['ocorrencia'])?></strong></p>
	<p>Total de horas repostas: <strong><?php echo Uteis::exibirHoras($respostas['reposicao'])?></strong></p>	
	<p>Total de horas expiradas: <strong><?php echo Uteis::exibirHoras($respostas['expirada'])?></strong></p>	
	<p>Saldo final de horas: <strong><?php echo Uteis::exibirHoras($saldoG).$respostas['obs'];?></strong></p>
    </div>
 </fieldset>
