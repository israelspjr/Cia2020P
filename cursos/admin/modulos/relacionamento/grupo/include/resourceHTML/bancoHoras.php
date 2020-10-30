 <?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$BancoHoras = new BancoHoras();	
$DiaAulaFF = new DiaAulaFF();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$FolhaFrequencia = new FolhaFrequencia();

$idPlanoAcaoGrupo = $_GET['id'];

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

$valorFolha = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.") AND finalizadaPrincipal = 1 order by dataReferencia DESC");

$dataReferenciaF = $valorFolha[0]['dataReferencia'];

if (empty($dataReferenciaF)) {
$dataReferenciaF = "2016-01-01";	
}



?>
<div>
<fieldset>
  <legend>Banco de horas</legend>
   </fieldset>
  <div class="lista">
  	<?php 
  	
	//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND PAG.idPlanoAcaoGrupo in (".$valorx2.") 
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$idGrupo.")";
	?>
    <div>
    <p>Mês de referência:  <?php echo  date('m/Y', strtotime($dataReferenciaF)) ?></p>
    <button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_REL."grupo/include/acao/bancoHoras.php?id=".$idPlanoAcaoGrupo.""?>')"> Exportar relatório</button>
      </div>
 <fieldset>
<legend>Tabela Banco de Horas simplificada</legend>   
        <?php 	
 		echo $BancoHoras->selectBancoHorasTrNovo($where, false, $valorx2,$idPlanoAcaoGrupo);
        ?>
</fieldset>
   <table id="tb_lista_" class="registros">
        </table>
  </div>

</div>
<script>
$(document).ready( function() {
  $('#tb_lista_res3').dataTable( {
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
        "aoColumns" : [  {"asSorting": [ "asc" ] },  null, null,
					 null, null, null, null, null, null, null, null ]
  } );
} );
</script>

