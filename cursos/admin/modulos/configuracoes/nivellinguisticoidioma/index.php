<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelLinguisticoIdioma.class.php");

$NivelLinguisticoIdioma = new NivelLinguisticoIdioma();

?>
<div id="cadastro_NivelLinguisticoIdioma" class="">
<fieldset>
  <legend>Nivel Linguístico Idioma</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/nivellinguisticoidioma/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/nivellinguisticoidioma/index.php";?>', '#cadastro_NivelLinguisticoIdioma');" /> </div>
<div class="lista"><table id="tb_lista_NivelLinguisticoIdioma" class="registros">
    <thead>
      <tr>
	  <th>idNivelLinguisticoIdioma</th><th>Nivel Linguístico</th><th>Idioma</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/nivellinguisticoidioma/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/nivellinguisticoidioma/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE n.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/nivellinguisticoidioma/";		
		
		echo $NivelLinguisticoIdioma->selectNivelLinguisticoIdiomaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idNivelLinguisticoIdioma</th><th>Nivel Linguístico</th><th>Idioma</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_NivelLinguisticoIdioma', 'config');</script> 
</div>