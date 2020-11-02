<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Relatorio.class.php");

$Relatorio = new Relatorio();

//$caminhoAbrir = CAMINHO_REL."grupo/include/resourceHTML/itemAcompanhamento.php";
//$caminhoAtualizar = "click";
//$onde = "#geraRel"; 

require_once "../acao/filtros.php";?>

<div class="linha-inteira">
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."informacoes/include/acao/informacoes.php"?>')"> Exportar relatório</button>
</div>

<?php
echo $Relatorio->relatorioInformacoes($where, "", "",$mesIni, $mesFim);
?>

<script> 
$(document).ready( function() {
  $('#tb_lista_res').dataTable( {
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
        "aoColumns" : [ null, null, null, null, null, null, null, null, null, null,
                { "sType": "custom-date" }
					  ]
  } );
} );
//tabelaDataTable('tb_lista_res');
</script> 
