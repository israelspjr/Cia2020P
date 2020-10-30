<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();
$Professor = new Professor();

$idDiasBuscaAvulsa = $_REQUEST['idDiasBuscaAvulsa'];
$idBuscaAvulsa = $_GET['idBuscaAvulsa'];

if ($idBuscaAvulsa) {
	$rsBuscaAvulsa = $BuscaAvulsa -> selectBuscaAvulsa(" WHERE idBuscaAvulsa = $idBuscaAvulsa");
	$idIdioma = $rsBuscaAvulsa[0]['idioma_idIdioma'];
}
?>

<div id="cadastro" class="">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<div id="abas">
		<div id="aba_avulsa" divExibir="div_pesquisa_avulsa" class="aba_interna ativa"
			onclick="carregarModulo('<?=CAMINHO_REL."busca/avulsa/include/form/pesquisa.php?idBuscaAvulsa=$idBuscaAvulsa&idDiasBuscaAvulsa=$idDiasBuscaAvulsa";?>', '#div_pesquisa_avulsa')" >
			Pesquisa Avulsa
		</div>
		<div id="aba_avulsa" divExibir="div_opcoes_avulsa" class="aba_interna" 
		onclick="carregarModulo('<?=CAMINHO_REL."busca/avulsa/include/resourceHTML/opcao.php?idBuscaAvulsa=$idBuscaAvulsa&idDiasBuscaAvulsa=$idDiasBuscaAvulsa&idIdioma=$idIdioma";?>', '#div_opcoes_avulsa')" >
			Opções escolhidas
		</div>
	</div>
	<div id="modulos_planoAcao" class="conteudo_nivel">
		<div id="div_pesquisa_avulsa" class="div_aba_interna">
			<?php
			require_once '../form/pesquisa.php';
			?>
		</div>		
		<div id="div_opcoes_avulsa" class="div_aba_interna" style="display:none"></div>
	</div>
</div>
<script>ativarForm();</script>
