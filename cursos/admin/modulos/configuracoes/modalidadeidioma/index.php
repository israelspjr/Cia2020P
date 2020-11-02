<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ModalidadeIdioma.class.php");

$ModalidadeIdioma = new ModalidadeIdioma();

?>

<div id="cadastro_ModalidadeIdioma" class="">
  <fieldset>
    <legend>Modalidade Idioma</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/modalidadeidioma/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/modalidadeidioma/index.php";?>', '#cadastro_ModalidadeIdioma');" /> </div>
    <div class="lista">
      <table id="tb_lista_ModalidadeIdioma" class="registros">
        <thead>
          <tr>
            <th>idModalidadeIdioma</th>
            <th>Modalidade</th>
            <th>Idioma</th>
            <th>Valor Hora Padrão</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/modalidadeidioma/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/modalidadeidioma/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE mi.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/modalidadeidioma/";		
		
		echo $ModalidadeIdioma->selectModalidadeIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idModalidadeIdioma</th>
            <th>Modalidade</th>
            <th>Idioma</th>
            <th>Valor Hora Padrão</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ModalidadeIdioma', 'config');</script> 
</div>
