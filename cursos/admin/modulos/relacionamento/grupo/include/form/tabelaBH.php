<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

ini_set('max_execution_time', 6000);

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$BancoHoras = new BancoHoras();
$FolhaFrequencia = new FolhaFrequencia();

$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
$validade = $valorPlanoAcaoGrupo[0]['dataValidade'];

$idGrupo = $_REQUEST['idGrupo'];

$respostas = $BancoHoras->bancoHorasTo($idGrupo, $idPlanoAcaoGrupo);

if ($respostas['saldo'] <= 0) {
	
$saldoG = -1 *	$respostas['saldo'];
} else {
	
$saldoG = $respostas['saldo'];

}

$caminhoAtualizar = CAMINHO_REL."grupo/include/form/tabelaBH.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idGrupo=".$idGrupo;
$ondeAtualiza = 'tabelaBHDetalhe';
?>
<div class="conteudo_nivel" id="tabeBHDetalhe">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
 <div id="tabelaBHDetalhe">
     <fieldset>
       <legend>Tabela Banco de Horas - Conferência</legend> </fieldset>
        <div>
        <p>Mês de referência:  <?php echo  date('m/Y', strtotime($respostas['dataReferenciaF'])) ?></p>
        <?php if ($validade != '') { ?>
        <p>Prazo de validade deste grupo: <?php echo $validade?> meses</p>
        <?php } ?>
        <p>Total de horas não realizadas: <strong><?php echo Uteis::exibirHoras($respostas['ocorrencia'])?></strong></p>
        <p>Total de horas repostas: <strong><?php echo Uteis::exibirHoras($respostas['reposicao'])?></strong></p>
        <p>Total de horas expiradas: <strong><?php echo Uteis::exibirHoras($respostas['expirada'])?></strong></p>
        <p>Saldo final de horas: <strong><?php echo Uteis::exibirHoras($saldoG).$respostas['obs'];?></strong></p>
        <img src="<?php echo CAMINHO_IMG . "devol.png"; ?>" title="Excluir / Atualizar Banco de Horas deste Grupo"
        onclick="deletarBanco(<?php echo $idPlanoAcaoGrupo?>)"; />&nbsp;&nbsp;&nbsp;&nbsp;
      <!--   <img src="<?php echo CAMINHO_IMG . "copy.png"; ?>" title="Gerar / Atualizar Banco de Horas deste Grupo"
        onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/excluirBanco.php?excluir=0&idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />-->
        <img src="<?php echo CAMINHO_IMG . "contrato.png"; ?>" width="32" title="Alterar Prazo de validade de expiração deste grupo"
        onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/data_validade.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="<?php echo CAMINHO_IMG . "editar.png"; ?>" width="32" title="Editar Vencimentos"
                 onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/bancoHorasAll_validade.php?ids="?>'+AllIds(), '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
        </div>
        <div id="msg"></div>
 
<div id="tabelaResultado">
 <?php
 
		echo $BancoHoras->bancoHorasTabela($idGrupo, $idPlanoAcaoGrupo);
		
?>
</div>


</div>
 
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
		"bJQueryUI" : true,
        "aoColumns" : [  null, { "sType": "custom-date" }, null, null, null, null, null, null, null, null ]
    });
});

function AllIds(){
    camposMarcados = new Array();
    $("input[type=checkbox][name='idh[]']:checked").each(function(){
        camposMarcados.push($(this).val());
    });
    return camposMarcados;
}

function deletarBanco(x) {
var result = window.confirm('Tem certeza? Aguarde alguns segundos pelo processamento direto pelo servidor!!!');
 if (result == true) {
	 
$.ajax({
    url: "<?php echo CAMINHO_REL."grupo/include/acao/excluirBanco.php"?>",
    type: "POST",
    data: "idPlanoAcaoGrupo="+x+"&excluir=1",
    dataType: "html"

}).done(function(resposta) {
    console.log(resposta);
	$('#tabelaBHDetalhe').html(resposta);
		});
 	 }
}
</script>