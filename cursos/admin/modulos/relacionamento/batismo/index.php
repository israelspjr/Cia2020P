<?php  

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Batismo.class.php");

$Batismo = new Batismo();

?>

<fieldset>
  <legend>Batizar grupos</legend>
</fieldset>
<div class="lista">
  <table id="tb_lista_Batismo" class="registros">
    <thead>
      <tr>
        <th>Id do plano de ação</th>
        <th>Idioma</th>
        <th>Nível</th>
        <th>Empresa</th>
        <th>Data da proposta</th>
        <th>Data de aprovação do plano</th>
        <th>Visualizar plano de ação</th>        
      </tr>
    </thead>
    <tbody>
      <?php echo $Batismo->selectBatismoTr();?>
    </tbody>
    <tfoot>
      <tr>
        <th>Id do plano de ação</th>
        <th>Idioma</th>
        <th>Nível</th>
        <th>Empresa</th>
        <th>Data da proposta</th>
        <th>Data de aprovação do plano</th>
        <th>Visualizar plano de ação</th>        
      </tr>
    </tfoot>
  </table>
</div>
<script>
	tabelaDataTable('tb_lista_Batismo');
</script> 
