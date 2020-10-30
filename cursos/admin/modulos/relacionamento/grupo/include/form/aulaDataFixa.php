<?php

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PlanoAcaoGrupo.class.php");


$PlanoAcaoGrupo = new PlanoAcaoGrupo();
 
    
$idPlanoAcaoGrupo = $_GET['id'];
$valorPlanoAcaoGrupo = $PlanoAcaoGrupo->selectPlanoAcaoGrupo(" WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
$planoAcao_idPlanoAcao = $valorPlanoAcaoGrupo[0]['planoAcao_idPlanoAcao'];

?>

<fieldset>
  <legend>Novo dia de frequência data a data</legend>
  <form id="form_escolherTipoSimulacao" class="validate" action="" method="post" onsubmit="return false" >
    
     <input type="hidden" name="acao" id="acao" value="escolherTipoSimulacao" />
     <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo?>" />
     
     <p>
      <label for="tipoSimulacao1">
      <input type="radio" name="tipoSimulacao" id="tipoSimulacao1" value="1" onchange="escolherTipoSimulacao()" />
      Frequencia semanal</label>
    
      <label for="tipoSimulacao2">
      <input type="radio" name="tipoSimulacao" id="tipoSimulacao2" value="2" onchange="escolherTipoSimulacao()" />
      Data por data</label>
    </p>
  </form>
  
  <div id="res"></div>

</fieldset>

<script>

function escolherTipoSimulacao(){	
	postForm('form_escolherTipoSimulacao', '<?php echo CAMINHO_REL."grupo/include/acao/aulaDataFixa.php"?>', '', '#res');		
}

ativarForm();
</script> 