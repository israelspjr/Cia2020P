<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
$ClientePj = new ClientePj();
$idPlanoAcao = $_REQUEST['id'];

//$idPlanoAcaoGrupo =  $PlanoAcaoGrupo->getPAG_atual($idGrupo);
//$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
$idProposta = $PlanoAcao->getIdProposta($idPlanoAcao);
//echo $idProposta;

$idClientePj = $Proposta->get_clientePj_idClientePJ($idProposta);
//echo "id";
//echo $idClientePj;

//if ($idClientePj = ' ') {
//	$idClientePj = 479;
//}

//echo "iiii".$idClientePj;

$nomeEmpresa = $ClientePj->getNome($idClientePj);
//echo "nome :".$nomeEmpresa;
?>
<fieldset>
    <legend>
        Trocar Empresa
    </legend>
    <div class="lista">
        <form name="Form_trocaEmpresa" id="Form_trocaEmpresa" class="validate" action="" method="post"  onsubmit="return false" >
            <input type="hidden" name="acao" id="acao" value="mudarEmpresa" />
      <!--     <input type="hidden" name="idGrupo" id="idGrupo" value="<?=$idPlano?>" />-->
            <input type="hidden" name="idProposta" id="idProposta" value="<?=$idProposta?>" />
            <input type="hidden" name="idClientePj_atual" id="idClientePj_atual" value="<?=$idClientePj?>" />
           <input type="hidden" name="idPlanoAca" id="idPlanoAcao" value="<?=$idPlanoAcao?>" />
            <div class="linha-inteira">
                <p>
                    <label>Empresa Atual:</label>
                    <strong><?=$nomeEmpresa;?></strong>
                </p>
                <p>
                    <label>Nova Empresa:</label>
                    <?php
                        echo $ClientePj->selectClientePjSelect("", "required", " AND inativo = 0 ");
                    ?>
                </p>
            </div>
            <div class="linha-inteira">
                <p>
                    <button class="button blue" onclick="postForm('Form_trocaEmpresa', '<?php echo CAMINHO_VENDAS."planoAcao/include/acao/trocarEmpresa.php"?>')">
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