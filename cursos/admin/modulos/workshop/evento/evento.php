<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$evento = new Workshop();
$caminhoAtualizar = CAMINHO_EVENTOS."evento/evento.php";
$ondeAtualiza = "#centro";

?>

<fieldset>
  <legend>Cadastro Workshop</legend>
  <div class="menu_interno">
    <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem"
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_EVENTOS."evento/form_evento.php"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" />
  </div>
  <div  class="lista">
    <table id="tb_lista_evento" class="registros">
      <thead>
        <tr>
          <th>Evento</th>
          <th>Data</th>          
          <th>Vagas</th>
          <th>Inicio</th>
          <th>Termino</th> 
          <th>Finalizado</th>                
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $evento->selectWorkShopTr($where);?>
      </tbody>
      <tfoot>
         <tr>
          <th>Evento</th>
          <th>Data</th>          
          <th>Vagas</th>
          <th>Inicio</th>
          <th>Termino</th>
          <th>Finalizado</th>
          <th></th>
          <th></th>      
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_evento');
</script> 