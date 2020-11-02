<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Relatorio = new Relatorio();
$grafico = new Grafico();
$professor = new Professor();
require_once "../acao/filtros.php";?>
<?php
$result_total =  $Relatorio->relatorioPsaConsolidado("", $where, $idProfessor);
$cont = 1;

$i = 0;
//echo '<hr>';
//print_r($result_total);
?>
<?php foreach($result_total as $pergunta=>$respostas) { 
	if ($i == 0 ) {
?>
      <div id="chart_div<?php echo $i; ?>"></div>
      <script type="text/javascript">

          // Load the Visualization API and the corechart package.
          google.charts.load('current', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.charts.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

              // Create the data table.
              var data = new google.visualization.DataTable();
              data.addColumn('string');
              data.addColumn('number');
              data.addRows([
                  <?php $i2 = 1;
                  foreach($respostas as $k=>$v) {
                    if ($k<>'total'){ ?>
                  ['<?php echo $v; ?> - <?php echo $k ?>', <?php echo $v; ?>]<?php echo ($i2<(count($respostas)))? ",\r":"\r"; ?>
                  <?php }
                  $i2++;
                   } ?>
              ]);

              // Set chart options
              var options = {'title':'<?php echo $pergunta.'\nPeriodo de: '.$dataReferencia.' à '.$dataReferencia2; ?>',
                  'width':600,
                  'height':500,
                  sliceVisibilityThreshold:0};

              // Instantiate and draw our chart, passing in some options.
              var chart = new google.visualization.PieChart(document.getElementById('chart_div<?php echo $i; ?>'));
              chart.draw(data, options);
          }
      </script>
<?php $i++; } ?>


<!--
<?php }//foreach($result_total as $pergunta => $val) { ?>
    <table id="Dados_consolidados_<?=$cont;?>">
<thead>
    <tr>
       <th></th><th colspan = "3"><?=$pergunta;?></th>
    </tr>
     <tr>
       <th></th>
         <th>Conceito</th><th>Respostas</th>
       <th>(%)</th>
    </tr>
</thead>
<tbody>




<?php
/*
if($pergunta == "NPS - Net Promoter Score"){
    $final = count($val);
}
$i=0;

foreach($val as $conceito => $respostas):    
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
if($final==0){
$d = round((($detratores*100)/$val['total']),2)."%";
$p = round((($promotores*100)/$val['total']),2)."%";
$total = $p - $d;   
echo "<tr><td>".($i+1)."</td><td>Detratores</td><td align=\"center\">$detratores</td><td align=\"center\">$d</td></tr>";
echo "<tr><td>".($i+2)."</td><td>Promotores</td><td align=\"center\">$promotores</td><td align=\"center\">$p</td></tr>";
echo "<tr><td>".($i+3)."</td><td>Resultado Final</td><td align=\"center\">&nbsp;</td><td align=\"center\">$total%</td></tr>";        
}
$i++;
endforeach; */
?>
-->   
</tbody>
</table>
<br />
</div>
<script> 
//tabelaDataTable('Dados_consolidados_<?=$cont;?>', 'ordenaColuna_psa');
</script> 
<?php
//$cont++;
//  }
?>
-->