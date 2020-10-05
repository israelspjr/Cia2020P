<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Relatorio = new Relatorio();
$grafico = new Grafico();
require_once "filtros.php";?>

<div id="relatorio_psa">

<?php
if ($psaPendentes == 1) {
	
echo $Relatorio->relatorioPsaPendente($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor);

} else {
echo $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4);

}
$final = 1;
?>
</table>
</div>

<?php if ($psaPendentes == 1) { ?>
	<script>
//	tabelaDataTable('tb_lista_res','simples');
	</script>
    
<?php } else { 
?>

<script>
 
/*$(document).ready( function() {
//	tabelaDataTable('tb_lista_res','simples');
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
        "aoColumns" : [ null, null, 
                { "sType": "custom-date" },
					 null, null, null, null, null, null ]
  } );
} );*/
</script>

<?php
}
$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where, $idProfessor);
?>

<?php 
$cont = 1;
  foreach($result_total as $pergunta => $val) {          
?>

<table id="Dados_consolidados_<?=$cont;?>">
<thead>
    <tr>
       <th></th><th colspan = "3"><?=$pergunta;?></th>        
    </tr>
     <tr>
       <th></th><th>Conceito</th><th>Respostas</th><th>(%)</th>       
    </tr>
</thead>
<tbody>    

<?php
if($pergunta == "NPS - Net Promoter Score"){
    $final = count($val);
}
$i=0;

foreach($val as $conceito => $respostas):    
    if($pergunta == "NPS - Net Promoter Score"){
        $final--;
        if($conceito <=6 && $conceito!="total") {  
            $detratores += $respostas;
        }else if($conceito>=9){
            $promotores += $respostas;
        }else{
            $neutro+= $respostas;
        }
    }
?>
<tr>
<td><?=$i?></td><td align="center"><?=$conceito?></td><td align="center"><?=$respostas?></td><td align="center"><?=round((($respostas*100)/$val['total']),2)."%"?></td>
</tr>  
<?php
if($final==0){
$d = round((($detratores*100)/$val['total']),2)."%";
$p = round((($promotores*100)/$val['total']),2)."%";
$total = $p - $d;   
echo "<tr><td>".($i+1)."</td><td>Detratores</td><td align=\"center\">$detratores</td><td align=\"center\">$d</td></tr>";
echo "<tr><td>".($i+2)."</td><td>Promotores</td><td align=\"center\">$promotores</td><td align=\"center\">$p</td></tr>";
echo "<tr><td>".($i+3)."</td><td>Resultado Final</td><td align=\"center\">&nbsp;</td><td align=\"center\">$total%</td></tr>";        
}
$i++;
endforeach;
?>
   
</tbody>
</table>
<br />
</div>
<script> 
//tabelaDataTable('Dados_consolidados_<?=$cont;?>', 'ordenaColuna_psa');
</script> 
<?php
$cont++;
  }
  

?>