<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcao = new PlanoAcao();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idPlanoAcaoGrupo = $_GET['id'];	

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	
//$idNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo);	
$idPlanoAcaoGrupo_atual = $PlanoAcaoGrupo->getPAG_atual($idGrupo);
$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo_atual);

?>

<fieldset>
  <legend>Iniciar mudança de estágio</legend>
  <form id="form_iniciarMudanca" class="validate" action="" method="post" onsubmit="return false" >
  	<input type="hidden" name="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
    
    <?php 
		if( $idPlanoAcaoGrupo == $idPlanoAcaoGrupo_atual ){
			
			$rs = $PlanoAcaoGrupo->verificaMudancaEstagio(" AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo ");
			if( !$rs ){ ?>
				<p>
					<button class="button blue" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."relacionamento/mudanca/cadastro.php?id=$idPlanoAcao"?>', '<?php echo CAMINHO_MODULO."relacionamento/grupo/include/resourceHTML/iniciarMudanca.php?id=$idPlanoAcaoGrupo"?>', '#ini_mudanca')" >Iniciar mudança de estágio</button>
					</p>
			<?php }else{?>
            
            <?php
			$sql = "SELECT idPlanoAcao, mesReferenciaMudanca, anoReferenciaMudanca FROM planoAcao WHERE grupo_idGrupo = ".$idGrupo." order by idPlanoAcao desc";
			$rs = Uteis::executarQuery($sql);
			$idAtual = $rs[0]['idPlanoAcao'];
			$mes = $rs[0]['mesReferenciaMudanca'];
			$ano = $rs[0]['anoReferenciaMudanca'];
			
			?>
				
        <p><strong>Mudança de estágio já foi iniciada</strong> (<?php echo $rs[0]['mesReferenciaMudanca']."/".$rs[0]['anoReferenciaMudanca']?>)</p>
        <p>
        <button class="button blue" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."vendas/planoAcao/cadastro.php?id=".$idAtual."','".CAMINHO_MODULO."relacionamento/grupo/include/resourceHTML/iniciarMudanca.php?id=$idPlanoAcaoGrupo"?>','#ini_mudanca')" ?>Clique aqui para acessar o Plano de Ação </button>
        
        
        
			<?php }
			
		}else{
				echo "<p>Para iniciar a mudança de estágio é necessário estar no nível atual do grupo.</p>";
		}?>
    
  </form>
</fieldset>
<script>
ativarForm();
</script>