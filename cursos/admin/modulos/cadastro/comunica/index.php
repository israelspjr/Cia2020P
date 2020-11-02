<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Comunica = new Comunica();
$Segmento = new Segmento();

$nomeTb = "tb_lista_habilitade";

$caminhoAtualizar = CAMINHO_CAD."comunica/index.php";
$ondeAtualiza = "#centro";
$caminhoAbrir = CAMINHO_CAD."comunica/include/form/comunica.php";
?>

<fieldset>
  <legend>Comunicação com Professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova Comunicação" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."comunica/include/form/comunica.php";?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" /> </div>
  <div class="lista">
    <table id="<?php echo $nomeTb?>" class="registros">
      <thead>
        <tr>
          <th>Descrição</th>
          <th>Link</th>
          <th>Idioma</th>
          <th>Banco Conhecimento</th>
          <th>Professor que inseriu? </th>
          <th>Categoria</th>
          <th>Status </th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Comunica->selectArquivosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, 0, 0);?>
      </tbody>
      <tfoot>
        <tr>
          <th>Descrição</th>
          <th>Link</th>
          <th>Idioma</th>
          <th>Banco Conhecimento</th>
           <th>Professor que inseriu? </th>
           <th>Categoria</th>
          <th>Status </th>
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>

<fieldset>
  <legend>Categorias</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem" 
  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."comunica/formulario.php".$param?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" /> </div>
  <div class="lista">
    <table id="categoria" class="registros">
      <thead>
        <tr>
         <th>ID</th>
          <th>Descrição</th>
          <th>Status</th>
      <!--    <th>Sistema</th>-->
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Segmento->selectSegmentoTrBc($where, $caminhoAbrir, $caminhoAtualizar, $ondeAtualiza );?>
      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Status</th>
    <!--      <th>Sistema</th>          -->
          <th></th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>

<script> tabelaDataTable('<?php echo $nomeTb?>', 'simples');
tabelaDataTable('categoria', 'simples');
</script> 
