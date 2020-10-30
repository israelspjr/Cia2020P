<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idPlanoAcaoGrupo = $_REQUEST['id'];   
$DiaAulaFF = new DiaAulaFF();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();

$idGrupo = $PlanoAcaoGrupo->getIdGrupo($idPlanoAcaoGrupo);	

$ids = $PlanoAcaoGrupo->getPAG_total($idGrupo);

for ($x=0;$x<count($ids);$x++) {
	$valorX[] = $ids[$x]['idPlanoAcaoGrupo'];
}

$valorx2 = implode(', ',$valorX);

$caminhoAtualizar = CAMINHO_REL."grupo/include/resourceHTML/ff_banco.php?id=".$idPlanoAcaoGrupo;
$ondeAtualiza = "#div_aulas";

//Uteis::pr($valorx2);
?>

<fieldset>
<legend>Créditos ou Débitos Atribuidos ao Banco de horas deste Grupo</legend>   
  <div class="lista">
    <p><img src="<?php echo CAMINHO_IMG."mais2.png";?>" title="Adicionar Horas" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_REL."grupo/include/form/bancoHoras_lancamentos.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>', '<?php echo $caminhoAtualizar ?>', '<?php echo $ondeAtualiza ?>');" /> 
    <table id="tb_lista_credeb" class="registros">
    <thead>
        <tr>          
          <th>Tipo</th>
          <th>Horas</th>
          <th>Data Inserção</th>
          <th>Sigla</th>
          <th>Obs</th>
          <th>Editar</th> 
          <th></th>      
        </tr>
      </thead>
      <tbody>
        <?php       
            echo $DiaAulaFF->CreditosDebitosBH(CAMINHO_REL."grupo/include/", $caminhoAtualizar, $ondeAtualiza, $valorx2, $podeExcluir = false);
        ?>
         <tr>          
          <th>Tipo</th>
          <th>Horas</th>
          <th>Data Inserção</th>
          <th>Sigla</th>
          <th>Obs</th>
          <th>Editar</th> 
          <th></th>      
        </tr>
        </tbody>
        </table>     
  </div>
</fieldset>
<script>
tabelaDataTable('tb_lista_credeb');
</script>