<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$RelatorioNovo = new RelatorioNovo();
$grafico = new Grafico();
require_once "../acao/filtros.php";?>
<div class="linha-inteira">
<div class="esquerda">    
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."novaPsa/include/acao/psa.php"?>')"> Exportar relatório</button>
</div>
<div class="direita">
 <!--   <button class="button gray" onclick="GerarGrafico()">Gerar Gráfico</button>-->
</div>
</div>
<div id="relatorio_psa">
<script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/natural.js"></script>
<?php

echo $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito,"",$idIdioma);


$final = 1;
?>
</table>
</div>
<div id="geral">
<script>
tabelaDataTable('tb_lista_res','simples');
 
</script>


<?php
$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where, $idProfessor, 4);


?>
<div style="width:100%">
<?php 
$cont = 1;
$y = 1;
  foreach($result_total as $pergunta => $val) {          
$gerentes = "";
//Uteis::pr($val);
?>

<div id="pergunta_<?=$pergunta?>" style="width:100%;">
<table><tr><td style="width:250px;padding-right:80px;">
<table id="Dados_consolidados_<?=$cont;?>">
<thead>
    <tr>
       <th><?=$pergunta;?></th><th></th><th></th>
    </tr>
     <tr>
       <th>Conceito</th><th>Respostas</th><th>(%)</th>               
    </tr>
</thead>
<tbody>  


<?php

if($pergunta == "NPS - Net Promoter Score"){
    $final = 12; //count($val);
}
$i=0;
$notasGerais = 0;
//sort($val);
foreach($val as $conceito => $respostas) {

	if (is_array($respostas)) {
	
	$gerentes .= '<div id="pergunta_'.$conceito.'" style="">
<table id="Gerentes_'.$y.'">
<thead>
    <tr>
       <th>'.$conceito.'</th><th></th><th></th>
    </tr>
     <tr>
       <th>Conceito</th><th>Respostas</th><th>(%)</th>               
    </tr>
</thead>
<tbody>  ';
$x = 0;

foreach($respostas as $conceito2 => $respostas2) {
Uteis::pr((int)$conceito2."-".(int)$respostas2);
$notasGerais += $conceito2 * $respostas2;
echo "<hr>";
echo "notas:".$notasGerais;
$gerentes .= '<tr>
<td align="center">'.$conceito2.'</td><td align="center">'.$respostas2.'</td><td align="center">'.round((($respostas2*100)/$respostas['total']),2)."%".'</td>
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
<td align="center"><?=$conceito?></td><td align="center"><?=$respostas?></td><td align="center"><?=round((($respostas*100)/$val['total']),2)."%"?></td>
</tr>  
<?php
if(($final==0) && ($pergunta == "NPS - Net Promoter Score")){
$d = round((($detratores*100)/$val['total']),2)."%";
$p = round((($promotores*100)/$val['total']),2)."%";
$total = $p - $d;   
echo "<tr><td>Detratores</td><td align=\"center\">$detratores</td><td align=\"center\">$d</td></tr>";
echo "<tr><td>Promotores</td><td align=\"center\">$promotores</td><td align=\"center\">$p</td></tr>";
echo "<tr><td>Resultado Final</td><td align=\"center\">&nbsp;</td><td align=\"center\">$total%</td></tr>";        
}
$i++;
	}



$y++;	
	}
	
//Uteis::pr( $respostas); 


?>


   <tr><td>Média</td><td></td><?php echo $mediaTotal;?><td><?php echo $val['total'];?></td></tr>
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
	  aaSorting : [[2, 'asc']],
	  columnDefs: [
	   { type: 'natural', targets: 1 },
       { type: 'natural', targets: 2 }/*,
	   { type: 'natural', targets: 3 }*/
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
       { type: 'natural', targets: 2 }/*,
	   { type: 'natural', targets: 3 }*/
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