<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DemonstrativoPagamento.class.php");


$DemonstrativoPagamento = new DemonstrativoPagamento();

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
if (($_REQUEST['emAberto'] == "") || (!isset($_REQUEST['emAberto']))){
	$emAberto = 0;
} else {
	$emAberto = 1;
}


?>
<div class="linha-inteira">
<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_PAG."baixa/include/acao/baixaExcel.php?ano=".$ano."&mes=".$mes."&emAberto=".$emAberto.""?>')"> Exportar relatório</button>
</div>
<p><strong><?php echo "$mes/$ano"?></strong></p>
 <div class="lista">
<!--<table id="tb_lista_Demonstrativo" class="registros">
  <thead>
    <tr>
      <th>Professor</th>
      <th>Valor</th>
      <th>Forma de pagamento</th>
    </tr>
  </thead>
  <tbody>-->
  <?php
  echo $DemonstrativoPagamento->selectDemonstrativoPagamentoTr(" WHERE mes = $mes AND ano = $ano", $emAberto);
  
  ?>
 <!-- </tbody>
  <tfoot>
    <tr>
      <th>Professor</th>
      <th>Valor</th>
      <th>Forma de pagamento</th>
    </tr>
  </tfoot>
</table>-->
</div>

<script>
ativarForm();

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
        "aoColumns" : [ null, null, null , null
                ]
  } );
} );
</script> 