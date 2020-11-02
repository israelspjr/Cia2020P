<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EditoraMaterialDidatico.class.php");

$EditoraMaterialDidatico = new EditoraMaterialDidatico();

?>
<div id="cadastro_EditoraMaterialDidatico" class="">

<fieldset>
  <legend>Editora Material Didático</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/editoramaterialdidatico/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/editoramaterialdidatico/index.php";?>', '#cadastro_EditoraMaterialDidatico');" /> </div>
<div class="lista"><table id="tb_lista_EditoraMaterialDidatico" class="registros">
    <thead>
      <tr>
	  <th>ID</th><th>Editora</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/editoramaterialdidatico/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/editoramaterialdidatico/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/editoramaterialdidatico/";		
		
		echo $EditoraMaterialDidatico->selectEditoraMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th><th>Editora</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_EditoraMaterialDidatico', 'config');</script> 
</div>