<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$FolhaFrequencia = new FolhaFrequencia();

$idPlanoAcaoGrupo = $_GET['id'];
//echo $idPlanoAcaoGrupo;

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);	
$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}
//Uteis::pr($valorX);

$valorx2 = implode(', ',$valorX);

//Uteis::pr($valorx2);

$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/ff_banco.php?id=".$idPlanoAcaoGrupo;
$ondeAtualiza = "#div_aulas";
?>

<fieldset>
	<legend>
		Folhas de frequência
	</legend>
	<div class="menu_interno"><img src="<?php echo CAMINHO_IMG . "novo.png"; ?>" title="Gerar folha de frequencia manualmente" 
	onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/novaff.php?idPlanoAcaoGrupo=$idPlanoAcaoGrupo"?>', '<?php echo $caminhoAtualizar?>', '<?php echo $ondeAtualiza?>');" />
         <img src="<?php echo CAMINHO_IMG . "editar.png"; ?>" width="32" title="Desfinalizar todas FFs selecionadas"
                 onclick="postForm('', '<?php echo CAMINHO_REL."grupo/include/acao/desfinalizar.php?ids="?>'+AllIds())" />
		
	</div>
	<div class="lista">
		<table id="tb_lista_FolhaFrequencia" class="registros">
			<thead>
				<tr>
					<th></th>
					<th>Período</th>
					<th>Professor</th>
					<th>Finalizada</th>
					<th>Finalizada[financeiro]</th>
                    <th>Horas Regulares</th>
                    <th>Ação</th>
				</tr>
			</thead>
			<tbody>
				<?php
$caminhoAbrir = CAMINHO_REL."grupo/include/form/folhaFrequencia_abas.php";
//$where = " WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo;
echo $FolhaFrequencia->selectFolhaFrequenciaTrTotal($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $valorx2);// $idPlanoAcaoGrupo)
				?>
			</tbody>
			<tfoot>
				<tr>
					<th></th>
					<th>Período</th>
					<th>Professor</th>
					<th>Finalizada</th>
					<th>Finalizada[financeiro]</th>
                    <th>Horas Regulares</th>
                    <th>Ação</th>
				</tr>
			</tfoot>
		</table>
	</div>
</fieldset>
<script>tabelaDataTable('tb_lista_FolhaFrequencia', 'ordenaColuna');
ativarForm();

function finalizarProfessorPri(finalizar, id, idProfessor){
	postForm('', '<?php echo CAMINHO_REL."grupo/include/acao/folhaFrequencia.php"?>', '<?php echo "&acao=finalizarProfessorPri&tipo=1&id="?>'+id+'<?php echo "&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo."&idProfessor="?>'+idProfessor+'<?php echo "&finalizar="?>'+finalizar);	
}

function AllIds(){
    camposMarcados = new Array();
    $("input[type=checkbox][name='idh[]']:checked").each(function(){
        camposMarcados.push($(this).val());
    });
    return camposMarcados;
}

</script>

