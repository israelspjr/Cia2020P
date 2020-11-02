<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$Presenca = new WorkshopPresenca();
$caminhoAtualizar = CAMINHO_EVENTOS."inscricao/index.php";
$ondeAtualiza = "#centro";

?>

<fieldset>
  <legend>Inscrições para Workshop</legend>
  <div class="menu_interno">
    <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem"
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_EVENTOS."inscricao/aba.php"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" />
  </div>
  <div class="lista">
    <table id="tb_lista_inscricao" class="registros">
      <thead>
        <tr>
          <th>Evento</th>
          <th>Tipo</th>
          <th>Participante</th>          
          <th>Data Evento</th>
          <th>Confirmado</th>
          <th>Data Confirmação</th>
          <th>Presente</th>
          <th></th>                 
        </tr>
      </thead>
      <tbody>
        <?php echo $Presenca->selectPresencaTr($where);?>
      </tbody>
      <tfoot>
       <tr>
           <th>Evento</th>
          <th>Tipo</th>
          <th>Participante</th>          
          <th>Data Evento</th>
          <th>Confirmado</th>
          <th>Data Confirmação</th>
          <th>Presente</th>
          <th></th>                
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
  tabelaDataTable('tb_lista_inscricao');
</script> 