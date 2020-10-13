<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");
	
$AcompanhamentoCurso = new AcompanhamentoCurso();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();	

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];

$idGrupo = $PlanoAcaoGrupo->getNomeGrupo($idPlanoAcaoGrupo, true);

//Gerar Total com Debito e Credito
$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

foreach($ids AS $valor) {
$valorX[] = $valor['idPlanoAcaoGrupo'];		
}

$valorx2 = implode(', ',$valorX);

$camposSelect = array("CONCAT(PA.mes, '/', PA.ano) AS periodo", "PR.nome AS nomeProfessor");

$idClientePf = $_SESSION['idClientePf_SS'];	

?>
<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  --><button class="button gray" onclick="postForm('form_rel_pf', '<?php echo "modulos/acompanhamento/acompanhamentoAcao.php"?>')"> Exportar relatório</button>
  <fieldset>
    <legend>Relatórios de desempenho</legend>
    <div class="lista">
        <?php 
					$caminhoAbrir = "modulos/acompanhamento/relatorioDesempenho.php";
					$caminhoAtualizar = "modulos/acompanhamento/acompanhamento.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo;
					$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo in ( ".$valorx2.") order by idAcompanhamentoCurso DESC";
					
					echo $AcompanhamentoCurso->selectAcompanhamentoCursoTr_aluno($caminhoAbrir, $caminhoAtualizar, "", $where,1, $idClientePf);
					?>
  </div>
  </fieldset>
</div>
<script>
//tabelaDataTable('tb_lista_res', 'simples');
</script>