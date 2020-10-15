<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$DemonstrativoPagamento = new DemonstrativoPagamento();	

$Configuracoes = new Configuracoes();

$config = $Configuracoes->selectConfig();
$idProfessor = $_SESSION['idProfessor_SS'];
?>
    
<fieldset>
  <legend>Demonstrativos</legend>
  <p>Prezado(a) Professor(a) </p>

<p>Finalizamos o cálculo para seu pagamento e pedimos que confira as informações do demonstrativo, com urgência.  Se você discordar do cálculo, <strong><font color="#FF0000">Clique em cima do demonstrativo para conferir e enviar a sua contestação</font></strong> ou entre em contato no email: <a href="<?php echo $config[0]['emailFinancas'];?>"><?php echo $config[0]['emailFinancas']?></a> para esclarecermos a divergência.</p>

<p>Se estiver tudo correto, não é necessário enviar mensagens. Seu pagamento estará disponível, na forma combinada (transferência, cheque etc), no quinto dia útil. </p>

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
       echo $DemonstrativoPagamento->selectDemonstrativoPagamentoTr_professor(" WHERE D.professor_idProfessor = $idProfessor order by idDemonstrativoPagamento DESC", "modulos/demonstrativoPagamento/demonstrativoPagamento.php", "modulos/demonstrativoPagamento/index.php", "#centro",1);			
			 
        ?>
      </tbody>
    
    </table>
  </div>
</fieldset>

<script>
//ativarForm();
//tabelaDataTable('tb_lista_demonstrativoPagamento2', 'simples');
/*
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
					 { "sType": "custom-date" }, null ]
  } );
} );
*/


</script>