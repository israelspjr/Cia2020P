<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Grupo.class.php");	
	
$Grupo = new Grupo();	
$idGgerenteTem = $_GET['id'];
$idGerente = $_GET['idGerente'];
?>
<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Vincular gerente a grupo</legend>
    <form id="form_GrupoClientePj" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idGerente" id="idGerente" value="<?php echo $idGerente?>" />
      <p>
        <label>Grupos particulares:</label>
        <?php
		$and = " WHERE
        G.inativo = 0
        AND G.idGrupo NOT IN (SELECT 
            COALESCE(GT.grupo_idGrupo, 0)
        FROM
            gerenteTem AS GT
        WHERE
            GT.gerente_idGerente = $idGerente
                AND (GT.dataExclusao IS NULL
                OR GT.dataExclusao = ''
                OR GT.dataExclusao >= CURDATE()))
        AND G.idGrupo IN (SELECT 
            GPJ.grupo_idGrupo
        FROM
            grupoClientePj AS GPJ
        WHERE
            GPJ.grupo_idGrupo = G.idGrupo
                AND (GPJ.dataFim IS NULL OR GPJ.dataFim = ''
                OR GPJ.dataFim >= CURDATE()))
        AND G.idGrupo IN(SELECT 
            COALESCE(GT.grupo_idGrupo, 0)
        FROM
            gerenteTem AS GT
        WHERE
            GT.dataExclusao IS NOT NULL
        OR GT.gerente_idGerente IS NULL)";		
		echo $Grupo->selectGrupoSelect(0, "required", $and); 
   	 	?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" onclick="postForm('form_GrupoClientePj', '<?php echo CAMINHO_CAD."gerente/include/acao/gerenteTem.php?id=$idGgerenteTem"?>')" >
        Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 