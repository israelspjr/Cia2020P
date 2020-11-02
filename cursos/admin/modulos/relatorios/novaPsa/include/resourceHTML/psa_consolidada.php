<fieldset>    
<?php
$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where);
$json = json_encode($result_total) 
?>
<script>
   var jsonA = <?php echo $json;?>;
   $.ajax({
        type: "POST",
        url: "<?php echo CAMINHO_RELAT."psa/getDados.php";?>",
        data: {data:jsonA}, 
        cache: false,

        success: function(){
            alert("OK");
        }
    }); 
</script> 
<?php 
$cont = 1;
  foreach($result_total as $pergunta => $val):   
?>


<div id="Consolidado_<?=$pergunta;?>">
<table id="Dados_consolidados_<?=$cont;?>">
<thead>
    <tr>
       <th colspan = "3"><?=$pergunta;?></th>        
    </tr>
     <tr>
       <th>Conceito</th><th>Respostas</th><th>(%)</th>       
    </tr>
</thead>
<tbody>    
<?php
foreach($val as $conceito => $respostas):
?>
<tr>
<td align="center"><?=$conceito?></td><td align="center"><?=$respostas?></td><td align="center"><?=round((($respostas*100)/$val['total']),2)."%"?></td>
</tr>  
<?php
endforeach;
?>
   
</tbody>
</table><br />
<script> 
tabelaDataTable('Dados_consolidados_<?=$cont;?>', 'simples');
</script> 
</div>
<?php
$cont++;
endforeach;
?>
</fieldset>