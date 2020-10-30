<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();

$idPlanoAcaoGrupo = $_GET['id'];
?>

<fieldset>
	<legend>
		Alunos
	</legend>
	<div class="menu_interno">

		<img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/integranteGrupo.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/integranteGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_integranteGrupo');" />

		<img src="<?php echo CAMINHO_IMG . "pasta.png"; ?>" title="HISTÓRICO DE INTEGRANTES" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/resourceHTML/integranteGrupo_historico.php?id=".$idPlanoAcaoGrupo?>', '<?php echo CAMINHO_REL."grupo/include/resourceHTML/integranteGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_integranteGrupo');" />

	</div>
	<div class="lista">
		<table id="tb_lista_AlunosGrupo" class="registros">
			<thead>
				<tr>
					<th>Nome</th>
                    <th>Data Entrada </th>
                    <th>1º nível que estudou</th>
				    <th>Frequência</th>
				    <th>Avaliações</th>
                    <th>Data da última PSA Respondida</th>
					<th>Pesquisa de satisfação</th>
					<th>Subvenção</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
$where .= " AND (dataSaida > CURDATE() OR dataSaida IS NULL OR dataSaida = '') ";
echo $IntegranteGrupo->selectIntegranteGrupoTr($where)
				?>
			</tbody>
			<tfoot>
				<tr>
					<th>Nome</th>
                    <th>Data Entrada </th> 
                    <th>1º nível que estudou</th>                   
					<th>Frequência</th>
					<th>Avaliações</th>
                    <th>Data da última PSA Respondida</th>
					<th>Pesquisa de satisfação</th>
					<th>Subvenção</th>
					<th></th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>
tabelaDataTable('tb_lista_AlunosGrupo', 'simples');

function cancelarA(x) {
 var y = confirm("Deseja realizar esse cancelamento?");	
	
	if (y == true) {
		retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/include/acao/cancelarA.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{integrante:x}   
  });
  retorno.done(function( html ) {
	  alert("Cancelamento feito com sucesso!");
	  carregarModulo('<?php echo CAMINHO_REL."grupo/include/resourceHTML/integranteGrupo.php?id=".$idPlanoAcaoGrupo?>', '#div_integranteGrupo');
	  
  //  $( "#nivel" ).append( html );
  });	
		
	}
	
}

</script>