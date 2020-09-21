<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
error_reporting(E_ALL);
$Relatorio = new Relatorio();
//$grafico = new Grafico();
require_once "filtrosR.php";?>
<div class="linha-inteira">
<div class="esquerda">    
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo "modulos/psa/psaRAcao.php"?>')"> Exportar relatório</button>
</div>

</div>
<div id="relatorio_psa">

<?php

echo $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito);

$final = 1;
?>
</table>
</div>

<script>
//tabelaDataTable('tb_lista_res','simples');

</script>

<?php

$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where, $idProfessor);
?>

<div style="width:100%">
<?php 
$cont = 1;
$y = 1;
  foreach($result_total as $pergunta => $val) {          
$gerentes = "";
?>

<div id="pergunta_<?=$pergunta?>" style="width:100%;">
<table><tr><td style="width:250px;padding-right:80px;">
<table id="Dados_consolidados_<?=$cont;?>">
<thead>
    <tr>
       <th></th><th><?=$pergunta;?></th><th></th><th></th>
    </tr>
     <tr>
       <th></th><th>Conceito</th><th>Respostas</th><th>(%)</th>               
    </tr>
</thead>
<tbody>  


<?php

if($pergunta == "NPS - Net Promoter Score"){
    $final = 12; //count($val);
}
$i=0;

foreach($val as $conceito => $respostas) {

	if (is_array($respostas)) {
//	Uteis::pr($respostas);
	$gerentes .= '<div id="pergunta_'.$conceito.'" style="">
<table id="Gerentes_'.$y.'">
<thead>
    <tr>
       <th></th><th>'.$conceito.'</th><th></th><th></th>
    </tr>
     <tr>
       <th></th><th>Conceito</th><th>Respostas</th><th>(%)</th>               
    </tr>
</thead>
<tbody>  ';
$x = 0;
foreach($respostas as $conceito2 => $respostas2) {
$gerentes .= '<tr>
<td>'.$x.'</td><td align="center">'.$conceito2.'</td><td align="center">'.$respostas2.'</td><td align="center">'.round((($respostas2*100)/$respostas['total']),2)."%".'</td>
</tr>'; 
$x++;  
	}
$html .= '</tbody>
</table>
</div>   ';
} else {
  
    if($pergunta == "NPS - Net Promoter Score"){
        $final--;
        if($conceito <=6 && $conceito!="total" && $conceito!="Prefiro Não Avaliar") {  
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
if(($final==0) && ($pergunta == "NPS - Net Promoter Score")){
$d = round((($detratores*100)/$val['total']),2)."%";
$p = round((($promotores*100)/$val['total']),2)."%";
$total = $p - $d;   
echo "<tr><td>".($i+1)."</td><td>Detratores</td><td align=\"center\">$detratores</td><td align=\"center\">$d</td></tr>";
echo "<tr><td>".($i+2)."</td><td>Promotores</td><td align=\"center\">$promotores</td><td align=\"center\">$p</td></tr>";
echo "<tr><td>".($i+3)."</td><td>Resultado Final</td><td align=\"center\">&nbsp;</td><td align=\"center\">$total%</td></tr>";        
}
$i++;
	}



$y++;	
	}
	
?>
   
</tbody>
</table>
</td>
<td>
<?php echo  $gerentes;?>
</td>
</tr>
</table>
</div>
</tr>
<br />

</div>
<hr />

<script> 

  $('#Dados_consolidados_<?=$cont;?>').dataTable( {
	  
	  searching: false, 
	  paging: false, 
	  info: false,
	  bSort: true,
	  aaSorting : [[1, 'asc']],
	  columnDefs: [
	   { type: 'natural', targets: 1 },
       { type: 'natural', targets: 2 },
	   { type: 'natural', targets: 3 }
   ],
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		"iDisplayLength": -1,
		 "oLanguage" : {
		 "oPaginate": {
        "sFirst":    "&lt;&lt;",
        "sLast":     "&gt;&gt;"
    }},
 } );

</script> 
<?php
$cont++;

  }

  for($x=0;$x<=$y;$x++) {

?>
<script> 

  $('#Gerentes_<?=$x;?>').dataTable( {
	  
	  searching: false, 
	  paging: false, 
	  info: false,
	  bSort: true,
	  aaSorting : [[1, 'asc']],
	  columnDefs: [
	   { type: 'natural', targets: 1 },
       { type: 'natural', targets: 2 },
	   { type: 'natural', targets: 3 }
   ],
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		"iDisplayLength": -1,
		 "oLanguage" : {
		 "oPaginate": {
        "sFirst":    "&lt;&lt;",
        "sLast":     "&gt;&gt;"
    }},
 } );

</script> 	  
	  
<?php 	  
  }
?>
</div>