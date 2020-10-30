<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
$BancoHoras = new BancoHoras();
$DiaAulaFF = new DiaAulaFF();
$FolhaFrequencia = new FolhaFrequencia();

$arrayRetorno = array();
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$pag = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoAcaoGrupo = $idPlanoAcaoGrupo");
$idGrupo = $pag[0]['grupo_idGrupo'];
$valorx2 = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);

if ($_REQUEST['excluir'] == "1") {

	$BancoHorasAulasRepostas->deleteBancoHorasAulasRepostas( " OR planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")");


} else {


}


$caminhoAtualizar = CAMINHO_REL."grupo/include/form/tabelaBH.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo;
$ondeAtualiza = 'tabelaBHDetalhe';

echo " <fieldset>
       <legend>Tabela Banco de Horas - Conferência - Refeito!</legend> </fieldset>
        <div>";
?>

        </div>
        <div>
 
<?php 
		echo $BancoHoras->bancoHorasTabela($idGrupo, $idPlanoAcaoGrupo);
		echo '</div>';
		
		$respostas = $BancoHoras->bancoHorasTo($idGrupo, $idPlanoAcaoGrupo);

		$saldoHoras = $respostas['saldo'];

if ($respostas['saldo'] <= 0) {
	
$saldoG = -1 *	$respostas['saldo'];
} else {
	
$saldoG = $respostas['saldo'];

}
	 
	if($saldoHoras == 0){
         $obs = "";
    }else if($saldoHoras > 0){
		 $obs = " a compensar";
	}else{
		$calcularHorasRestantes = 1;
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	
	echo "
        <div>
        <p>Mês de referência:  ".  date('m/Y', strtotime($respostas['dataReferenciaF'])) ."</p>
        <p>Total de horas não realizadas: <strong>". Uteis::exibirHoras($respostas['ocorrencia'])."</strong></p>
        <p>Total de horas repostas: <strong>". Uteis::exibirHoras($respostas['reposicao'])."</strong></p>
        <p>Total de horas expiradas: <strong>".Uteis::exibirHoras($respostas['expirada'])."</strong></p>
        <p>Saldo final de horas: <strong>".Uteis::exibirHoras($saldoG).$obs."</strong></p>"; ?>
        <img src="<?php echo CAMINHO_IMG . "devol.png"?>" title="Excluir Banco de Horas deste Grupo" onclick="deletarBanco(<?php echo $idPlanoAcaoGrupo ?>)" />&nbsp;&nbsp;&nbsp;&nbsp;
         <img src="<?php echo CAMINHO_IMG . "copy.png"; ?>" title="Gerar / Atualizar Banco de Horas deste Grupo"
        onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/excluirBanco.php?excluir=0&idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
        <img src="<?php echo CAMINHO_IMG . "contrato.png"; ?>" width="32" title="Alterar Prazo de validade de expiração deste grupo"
        onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/data_validade.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="<?php echo CAMINHO_IMG . "editar.png"; ?>" width="32" title="Editar Vencimentos"
                 onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/bancoHorasAll_validade.php?ids="?>'+AllIds(), '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />



<script>
jQuery(document).ready( function() {
    jQuery('#tb_lista_res6').dataTable( {
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		 "oLanguage" : {
		
		"sSearch":       "Buscar:",
	    "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ Registros",
		"sLengthMenu":   "_MENU_ Registros",
		 "sInfoFiltered": "(filtrado de _MAX_ Total de Registros)",
		 "sInfoEmpty":    "Mostrando de 0 até 0 de 0 Registros" ,
		 "oPaginate": {
            "sFirst":    "&lt;&lt;",
            "sPrevious": "&lt;",
            "sNext":     "&gt;",
            "sLast":     "&gt;&gt;"
        }},
        "sPaginationType" : "full_numbers", 
		"bInfo": true,
//		"order": [[ 1, "asc" ]],
		"bJQueryUI" : true,
        "aoColumns" : [  null, { "sType": "custom-date" }, null, null, null, null, null, null, null, null ]
    });
});
</script>