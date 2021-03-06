﻿<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idProfessor = $_GET['idProfessor'];

$Relatorio = new Relatorio();

$dataReferencia = "01/09/2018";
$dataReferencia2 = date("d/m/Y");
$mostrarComentarios = 1;
 
//$campos = array("Grupos", "aluno", "dataReferencia", "Nome Professor","PROFESSOR", "ATENDIMENTO", "QUALIDADE DA AULA", "RESULTADO DO CURSO", "NPS - Net Promoter Score");

//$camposNome = array("Grupos", "aluno", "dataReferencia", "Nome Professor", "PROFESSOR", "ATENDIMENTO", "QUALIDADE DA AULA", "RESULTADO DO CURSO", "NPS - Net Promoter Score");
 

$where .= " AND DATE(PIG.dataReferencia) BETWEEN '".Uteis::gravarData($dataReferencia)."' AND '".Uteis::gravarData($dataReferencia2)."' ";
//echo $where;
?>

<div id="cadastro_Grupo" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
  <!--  <div id="aba_div_principais" divExibir="div_principais" class="aba_interna ativa"></div>-->
    </div>
     <div id="modulos_Grupo" class="conteudo_nivel">
 
 
 <div id="relatorio_psa">
<fieldset>
  <legend>Resultado da pesquisa</legend>
</fieldset>
<div class="linha-inteira">
<div class="esquerda">    
	<button class="button gray" onclick="postForm('form_rel_pf', '<?php echo CAMINHO_RELAT."novaPsa/include/acao/psa.php"?>')"> Exportar relatório</button>
</div>
<div class="direita">
</div>
</div>
<div id="relatorio_psa">
<script src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/natural.js"></script>
<?php

echo $Relatorio->relatorioPsa($gerente, $where, $campos, $camposNome, "", $mostrarComentarios, $idProfessor, 4, $idNotasTipoNota, $quesito);


$final = 1;
?>
</table>
</div>

<script>
 
$(document).ready( function() {
  $('#tb_lista_res').dataTable( {
	  columnDefs: [
       { type: 'natural', targets: 4 },
	   { type: 'natural', targets: 5 },
	   { type: 'natural', targets: 6 },
	   { type: 'natural', targets: 7 },
	   { type: 'natural', targets: 8 },
	   { type: 'natural', targets: 9 },
   ],
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		"iDisplayLength": 50,
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
} );
</script>


<?php
//}

$result_total =  $Relatorio->relatorioPsaConsolidado($gerente, $where, $idProfessor, 4);

?>

<?php 
$cont = 1;
  foreach($result_total as $pergunta => $val) {          
?>

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
if(($final==0) && ($pergunta == "NPS - Net Promoter Score")){
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
<!--</div>-->
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
?>

</div>
</div>
</div>