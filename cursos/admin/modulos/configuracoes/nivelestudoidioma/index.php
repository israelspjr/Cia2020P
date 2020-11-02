<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelEstudoIdioma.class.php");

$NivelEstudoIdioma = new NivelEstudoIdioma();

?>
<div id="cadastro_NivelEstudoIdioma" class="">
<fieldset>
  <legend>Nível Estudo Idioma</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/nivelestudoidioma/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/nivelestudoidioma/index.php";?>', '#cadastro_NivelEstudoIdioma');" /> </div>
<div class="lista"><table id="tb_lista_NivelEstudoIdioma" class="registros">
    <thead>
      <tr>
       <th>idNivelEstudoIdioma</th><th>Nível</th><th>Idioma</th><th>Prova Oral</th><th>Prova On-line</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/nivelestudoidioma/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/nivelestudoidioma/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE n.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/nivelestudoidioma/";		
		
		echo $NivelEstudoIdioma->selectNivelEstudoIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idNivelEstudoIdioma</th><th>Nível</th><th>Idioma</th><th>Prova Oral</th><th>Prova On-line</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_NivelEstudoIdioma', 'config');</script> 
</div>