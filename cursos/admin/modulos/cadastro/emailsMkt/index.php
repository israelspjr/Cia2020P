<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$EmailsMkt = new EmailsMkt();
$Segmento = new Segmento();

$where .= " WHERE 1";
$ativo = $_POST['status'];

if ($ativo != '-') {
$where .= " AND E.inativo =" .$ativo;	

}

$idSegmento = $_POST['segmento_idSegmento'];
if ($idSegmento != '-') {
$where .= " AND segmento_idSegmento = ".$idSegmento;	
	
}

$nomeTb = "tb_lista_EmailsMkt_".date('His');

//$totais = ( $_POST['totais'] == "1" ? 1 : 0);

?>



  <div class="lista">
    <table id="emailsTB" class="registros">
      <thead>
        <tr>
     <!--     <th>DDD</th>-->
          <th>Nome</th>
          <th>Nome do Cliente</th>
          <th>Email</th>
          <th>Segmento</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $EmailsMkt->selectEmailsMktTr($where);?>
      </tbody>
      <tfoot>
        <tr>
     <!--     <th>DDD</th>-->
         <th>Nome</th>
          <th>Nome do Cliente</th>
          <th>Email</th>
          <th>Segmento</th>
          <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  
  
 
  <table id="emailsTR" class="registros">
      <thead>
        <tr>
     <!--     <th>DDD</th>-->
          <th>Segmento</th>
          <th>Total</th>
  			<th></th>      
        </tr>
      </thead>
      <tbody> 
  <?php 
  echo $Segmento->totalSegmento($where,1);
  
 ?>
    </tbody>
	<tfoot>
      <tr>
     <!--     <th>DDD</th>-->
          <th>Segmento</th>
          <th>Total</th>
          <th></th>
        </tr>
     </tfoot>
     </table>
     </div>
<script> tabelaDataTable('emailsTB', 'simples');
tabelaDataTable('emailsTR', 'simples');
</script> 
