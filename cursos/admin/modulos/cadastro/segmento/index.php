<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Segmento = new Segmento();

$nomeTb = "tb_lista_Segmento_".date('His');
?>

<fieldset>
  <legend>Segmento</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."segmento/formulario.php".$param?>', '<?php echo CAMINHO_CAD."segmento/index.php"?>', '#centro')" /> </div>
  <div class="lista">
    <table id="<?php echo $nomeTb?>" class="registros">
      <thead>
        <tr>
         <th>ID</th>
          <th>Descrição</th>
          <th>Status</th>
          <th>Sistema</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Segmento->selectSegmentoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Status</th>
          <th>Sistema</th>          
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('<?php echo $nomeTb?>', 'simples');</script> 
