<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Aviso = new Aviso();

$caminhoAbrir = CAMINHO_CAD."aviso/include/form/aviso.php";
$caminhoAtualizar = CAMINHO_MODULO."meusAvisos/index.php?id=".$_SESSION['idFuncionario_SS']; 
$onde = "#centro";
$where = " WHERE funcionario_idFuncionario = ".$_SESSION['idFuncionario_SS'];

?>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."aviso/include/form/aviso.php?$param"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $onde?>')" /> </div>
<fieldset>
  <legend>Avisos</legend>
  <div class="lista">
    <table id="tb_lista_aviso" class="registros">
      <thead>
        <tr>
          <th></th>
          <th>Quem me avisou</th>
          <th>Titulo</th>
          <th>Data do aviso</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Aviso->selectAvisoTr($caminhoAbrir, $caminhoAtualizar, $onde, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Quem me avisou</th>
          <th>Titulo</th>
          <th>Data do aviso</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('tb_lista_aviso', 'ordenaColuna');</script> 
