<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

//$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];


$excluir = $_REQUEST['excluir'];
?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<fieldset>
		<legend>
        <?php
		
		if ($excluir == 1) {
		
		echo "	Tem certeza que deseja excluir os registros desse grupo? ";
		$x=1;
		} else {
		$x=0;
		echo "	Tem certeza que deseja atualizar os registros desse grupo? ";	
		}
		?>
		</legend>
		<form id="form_BancoHoras" class="validate" action="" method="post" onsubmit="return false" >

            <?php
                $atualCaminho = CAMINHO_REL."grupo/include/acao/excluirBanco.php?excluir=".$x."&idPlanoAcaoGrupo=".$idPlanoAcaoGrupo;
             ?>
				<button class="button blue" onclick="postForm('form_BancoHoras', '<?php echo $atualCaminho; ?>','<?php echo $caminhoAtualizar; ?>','tabelaBHDetalhe');">
					SIM
				</button>
                Clique em Fechar para sair.
			</p>
		</form>
	</fieldset>
</div>
<script>ativarForm();</script>
