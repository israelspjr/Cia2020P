<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");


$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$BancoHoras = new BancoHoras();
$DiaAulaFF = new DiaAulaFF();
$FolhaFrequencia = new FolhaFrequencia();
$BancoHoras = new BancoHoras();

$idPlanoAcaoGrupo = $_REQUEST['id'];

$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
$validade = $valorPlanoAcaoGrupo[0]['dataValidade'];

$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);

$respostas = $BancoHoras->bancoHorasTo($idGrupo, $idPlanoAcaoGrupo);

if ($respostas['saldo'] <= 0) {
	
$saldoG = -1 *	$respostas['saldo'];
} else {
	
$saldoG = $respostas['saldo'];

}

	 
?>

<!--<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 --><fieldset>
   <legend>Tabela Banco de Horas - Conferência</legend> </fieldset>
    <div>
    <p>Mês de referência:  <?php echo  date('m/Y', strtotime($respostas['dataReferenciaF'])) ?></p>
   <p>Total de horas não realizadas: <strong><?php echo Uteis::exibirHoras($respostas['ocorrencia'])?></strong></p>
        <p>Total de horas repostas: <strong><?php echo Uteis::exibirHoras($respostas['reposicao'])?></strong></p>
        <p>Total de horas expiradas: <strong><?php echo Uteis::exibirHoras($respostas['expirada'])?></strong></p>
        <p>Saldo final de horas: <strong><?php echo Uteis::exibirHoras($saldoG).$respostas['obs'];?></strong></p>
     </div>
    <p>&nbsp;
    
    </p>

<script>

//tabelaDataTable('tb_lista_res6');

</script>