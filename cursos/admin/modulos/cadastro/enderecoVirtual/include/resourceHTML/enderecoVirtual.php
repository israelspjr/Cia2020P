<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EnderecoVirtual.class.php");

$EnderecoVirtual = new EnderecoVirtual();
if($idClientePf!="")
$param = "idClientePf=$idClientePf";
if($idProfessor!="")
$param = "idProfessor=$idProfessor";
if($idFuncionario!="")
$param = "idFuncionario=$idFuncionario";
if($idContatoAdicional!="")
$param = "idContatoAdicional=$idContatoAdicional";

?>

<fieldset>
	<legend>
		Endereço virtual
	</legend>
	<div class="menu_interno">
		<img src="<?php echo CAMINHO_IMG."novo.png"?>" title="Nova mensagem"
		onclick="abrirNivelPagina(this, '<?php echo $caminhoAbrir."form/enderecoVirtual.php?".$param?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>')" />
	</div>
	<div class="lista">
		<table id="tb_lista_enderecoVirtual<?php echo $_GET['id']?>" class="registros">
			<thead>
				<tr>
					<th>Tipo</th>
					<th>Endereço</th>
					<th>Email Principal</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php echo $EnderecoVirtual -> selectEnderecoVirtualTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where); ?>
			</tbody>
			<tfoot>
				<tr>
					<th>Tipo</th>
					<th>Endereço</th>
					<th>Email Principal</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>
tabelaDataTable('tb_lista_enderecoVirtual<?php echo $_GET['id']?>', 'simples');</script>
