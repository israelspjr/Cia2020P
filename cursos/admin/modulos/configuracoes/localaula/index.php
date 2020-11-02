<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/LocalAula.class.php");

$LocalAula = new LocalAula();

?>

<div id="cadastro_LocalAula" class="">
  <fieldset>
    <legend>Local Aula</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/localaula/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/localaula/index.php";?>', '#cadastro_LocalAula');" /> </div>
    <div class="lista">
      <table id="tb_lista_LocalAula" class="registros">
        <thead>
          <tr>
            <th>idLocalAula</th>
            <th>Local</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/localaula/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/localaula/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/localaula/";		
		
		echo $LocalAula->selectLocalAulaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idLocalAula</th>
            <th>Local</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_LocalAula', 'config');</script> 
</div>
