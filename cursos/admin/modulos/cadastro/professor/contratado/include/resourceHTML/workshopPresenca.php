<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
$Presenca = new WorkshopPresenca();
$caminhoAtualizar = CAMINHO_CAD."professor/contratado/include/resourceHTML/workshopPresenca.php?idProfessor=".$idProfessor;
$ondeAtualiza = "#div_workshop";
//echo $idProfessor;
$where = " WHERE professor_idProfessor = ".$idProfessor;

?>

<fieldset>
  <legend>Capacitações / Workshops</legend>
  <div class="menu_interno">
    <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem"
    onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."professor/contratado/include/form/aba.php?idProfessor=".$idProfessor; ?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" />
  </div>
  <div class="lista">
    <table id="tb_lista_inscricao" class="registros">
      <thead>
        <tr>
          <th>Tipo</th>
          <th>Data Evento</th>
          <th>Duração</th>
          <th>Aprovado?</th>
          <th></th>                 
        </tr>
      </thead>
      <tbody>
        <?php echo $Presenca->selectPresencaProfessorTr($where);?>
      </tbody>
      <tfoot>
       <tr>
           <th>Tipo</th>
          <th>Data Evento</th>
          <th>Duração</th>
          <th>Aprovado?</th>
          <th></th>                
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
  tabelaDataTable('tb_lista_inscricao');
</script> 