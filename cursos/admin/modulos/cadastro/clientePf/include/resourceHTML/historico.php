<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//$IntegranteGrupo = new IntegranteGrupo();
//$Ocorrencia = new Ocorrencia();

$camposNome = array("Nome", "Email", "Empresa", "Nome grupo", "Nível", "Idioma", "Valor Hora", "Professor", "Telefones", "Data entrada", "Data saída", "Notas", "Motivo", "Data retorno" );

$campos = array("nome", "email", "empresa", "nomeGrupo", "nivel", "idioma", "valorHora", "professor", "telefone", "dataEntrada", "dataSaida", "notas", "motivo", "dataRetorno");

?>

<fieldset>
<legend>
Histórico de participação em grupos
</legend>

<div id="lista_clientepf" class="lista">
  <?php //echo $IntegranteGrupo->selectIntegranteGrupoTr_historicoInd(" AND P.clientePf_idClientePf = ".$idClientePf,1,"", false,"",1,$campos,$camposNome);?>
</div>
</fieldset>
<!--<div>-->
 <script>
tabelaDataTable('tb_lista_res');
</script> 
