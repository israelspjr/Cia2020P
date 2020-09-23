<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$TextoEmailPadrao = new TextoEmailPadrao();
$caminhoAbrir = CAMINHO_MODULO . "configuracoes/textoemailpadrao/formulario.php";
$caminhoAtualizar = CAMINHO_MODULO . "configuracoes/textoemailpadrao/index.php";
$ondeAtualiza = "#centro";
$where = " WHERE 1";
$idPai = "";
$caminhoModulo = CAMINHO_MODULO . "configuracoes/textoemailpadrao/";

?>

<div id="cadastro_TextoEmailPadrao" class="">
	<fieldset>
		<legend>
			Texto E-mail Padrão
		</legend>
		<div class="menu_interno"> 
		  <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this,'<?php echo CAMINHO_MODULO."configuracoes/textoemailpadrao/formulario.php";?>','<?php echo CAMINHO_MODULO."configuracoes/textoemailpadrao/index.php";?>', '#cadastro_TextoEmailPadrao');" /> 
		  </div>
		<div class="lista">
			<table id="tb_lista_TextoEmailPadrao" class="registros">
				<thead>
					<tr>												
						<th>Título</th>						
            <th>Ativo</th>            
					</tr>
				</thead>
				<tbody>
					<?php
					echo $TextoEmailPadrao -> selectTextoEmailPadraoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
					?>
				</tbody>
				<tfoot>
					<tr>											
						<th>Título</th>
						<th>Ativo</th>						
					</tr>
				</tfoot>
			</table>
		</div>
	</fieldset>
	<script>
		tabelaDataTable('tb_lista_TextoEmailPadrao', 'simples');
	</script>
</div>
