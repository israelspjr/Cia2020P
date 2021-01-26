<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
$DemonstrativoPagamento = new DemonstrativoPagamento();	

//$idProfessor = $_SESSION['idProfessor_SS'];

?>
    
<fieldset>
  <legend>Demonstrativos</legend>
 
  <div class="lista">        
    <table id="tb_lista_demonstrativoPagamento2" class="registros">
      <thead>
        <tr>
          <th>Mês demonstrativo</th>
          <th>Mês extenso</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>	
        <?php 	            
       echo $DemonstrativoPagamento->selectDemonstrativoPagamentoTr_professor(" WHERE D.professor_idProfessor = $idProfessor order by idDemonstrativoPagamento DESC", CAMINHO_CAD."professor/contratado/include/form/demonstrativoPagamento.php", "","","", 1); //CAMINHO_MODULO."demonstrativoPagamento/index.php", "#centro");			
			 
        ?>
      </tbody>
    
    </table>
  </div>
</fieldset>

<script>
ativarForm();
//tabelaDataTable('tb_lista_demonstrativoPagamento2', 'simples');

$(document).ready( function() {
  $('#tb_lista_demonstrativoPagamento2').dataTable( {
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
        "aoColumns" : [ 
					 { "sType": "custom-date" }, null, null ]
  } );
} );



</script>