<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
$ClientePj = new ClientePj();
$idGrupo = $_REQUEST['idGrupo'];
$idPlanoAcaoGrupo =  $PlanoAcaoGrupo->getPAG_atual($idGrupo);
$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
$idProposta = $PlanoAcao->getIdProposta($idPlanoAcao);
$idClientePj = $Proposta->get_clientePj_idClientePJ($idProposta);
$nomeEmpresa = $ClientePj->getNome($idClientePj);
?>
<fieldset>
    <legend>
        Trocar Grupo de Empresa
    </legend>
    <div class="lista">
        <form name="Form_trocaEmpresa" id="Form_trocaEmpresa" class="validate" action="" method="post"  onsubmit="return false" >
            <input type="hidden" name="acao" id="acao" value="mudarEmpresa" />
            <input type="hidden" name="idGrupo" id="idGrupo" value="<?=$idGrupo?>" />
            <input type="hidden" name="idProposta" id="idProposta" value="<?=$idProposta?>" />
            <input type="hidden" name="idClientePj_atual" id="idClientePj_atual" value="<?=$idClientePj?>" />
            <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?=$idPlanoAcaoGrupo?>" />
            <div class="linha-inteira">
                <p>
                    <label>Empresa Atual:</label>
                    <strong><?=$nomeEmpresa;?></strong>
                </p>
                <p>
                    <label>Nova Empresa:</label>
                    <?php
                        echo $ClientePj->selectClientePjSelect("", "required", " AND inativo = 0 AND idClientePj <> ".$idClientePj);
                    ?>
                </p>
            </div>
            <div class="linha-inteira">
                <p>
                    <button class="button blue" onclick="postForm('Form_trocaEmpresa', '<?php echo CAMINHO_CAD."grupo/include/acao/grupos.php"?>')">
                        Salvar
                    </button>
                </p>
            </div>
        </form>
    </div>
</fieldset>
<script>
ativarForm();
</script>