<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Habilidades = new Habilidades();

$nomeTb = "tb_lista_habilitade";

$caminhoAtualizar = CAMINHO_CAD."habilidades/index.php";
$ondeAtualiza = "#centro";
$caminhoAbrir = CAMINHO_CAD."habilidades/include/form/habilidades.php";
?>

<fieldset>
  <legend>Interesses e Hobbys</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Habilidade" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."habilidades/include/form/habilidades.php";?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" /> </div>
  <div class="lista">
    <table id="<?php echo $nomeTb?>" class="registros">
      <thead>
        <tr>
          <th>Descrição</th>
          <th>Habilidade Pai </th>
          <th>Pergunta</th>
          <th>Tipo</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Habilidades->selectHabilidadesTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Descrição</th>
          <th>Habilidade Pai </th>          
           <th>Pergunta</th>
          <th>Tipo</th>
          <th>Status</th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script> tabelaDataTable('<?php echo $nomeTb?>', 'simples');</script> 
