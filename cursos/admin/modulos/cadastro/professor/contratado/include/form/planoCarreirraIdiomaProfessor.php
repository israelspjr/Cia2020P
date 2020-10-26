<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$PlanoCarreirra = new PlanoCarreirra();
$IdiomaProfessor = new IdiomaProfessor();
$Idioma = new Idioma();
$PlanoCarreirraIdiomaProfessor = new PlanoCarreirraIdiomaProfessor();

$idPlanoCarreirraIdiomaProfessor = $_GET['id'];

$mesIni = date('m');
$anoIni = date('Y');

if ($idPlanoCarreirraIdiomaProfessor > 0) {
	
	$valorIdioma = $PlanoCarreirraIdiomaProfessor-> selectPlanoCarreirraIdiomaProfessor("where idPlanoCarreirraIdiomaProfessor = ".$idPlanoCarreirraIdiomaProfessor);
	
	$idPlanoCarreira = $valorIdioma[0]['planoCarreirra_idPlanoCarreira'];
	
	$valorPlano = $PlanoCarreirra ->selectPlanoCarreirra("where idPlanoCarreira =".$idPlanoCarreira);
	
	$plano = $valorPlano[0]['plano'];
	
	$mesIni = $valorIdioma[0]['mesIni'];
	$anoIni = $valorIdioma[0]['anoIni'];
		
	$obs = "Mês atual - ";
	$obs2 = "Ano atual - ";
	
	$valorAtual = "<br>Valor Atual ".Uteis::formatarMoeda($plano)."<br><br>";
}
	
	

$idiomaProfessor_idIdiomaProfessor = $_GET['id_IdiomaProfessor'];


?>

<div class="conteudo_nivel">
	<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>

	<fieldset>
		<legend>
			Plano de carreira do idioma do professor
		</legend>
		<form id="form_PlanoCarreirraIdiomaProfessor" class="validate" method="post" action="" onsubmit="return false" >
			<input type="hidden" name="idiomaProfessor_idIdiomaProfessor" id="idiomaProfessor_idIdiomaProfessor" value="<?php echo $idiomaProfessor_idIdiomaProfessor?>" />
			<p>
				<label>Idioma:</label>
				<?php
				if ($idiomaProfessor_idIdiomaProfessor != "") {
					$IdiomaProfessorSelecionado = $IdiomaProfessor -> selectIdiomaProfessor(" WHERE idIdiomaProfessor = " . $idiomaProfessor_idIdiomaProfessor);
					//echo" WHERE idIdiomaProfessor = ".$idiomaProfessor_idIdiomaProfessor;exit;
					$idiomaSelecionado = $Idioma -> selectIdioma(" WHERE idIdioma = " . $IdiomaProfessorSelecionado[0]['idioma_idIdioma']);
					echo "<strong>" . $idiomaSelecionado[0]['idioma'] . "</strong>";
					echo "<input type=\"hidden\" name=\"idIdioma\" id=\"idIdioma\" value=\"" . $IdiomaProfessorSelecionado[0]['idioma_idIdioma'] . "\" />";
				}
				?>
			</p>
			<!--<p>
				<label>Data de início:</label>
				<input type="text" name="dataInicio" id="dataInicio" class="required data" />
				<span class="placeholder">Campo Obrigatório</span>
			</p>-->
			
			<p>
				<label>Mês inicio:</label>
				<select name="mesIni" id="mesIni" class="required">
					<?php 
					
				
					for($x=1; $x <= 12; $x++){
				
					
					?>
                    
					<option value="<?php echo $x?>" <?php echo ($mesIni == $x) ? "selected" : ""?> ><?php 
					
					if ($mesIni == $x) {
						
						echo $obs;
						$obs = "";	
					}
					echo Uteis::retornaNomeMes($x); ?>
					</option>
					<?php
					
					
					 } ?>
				</select>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<p>
				<label>Ano inicio:</label>
				<select name="anoIni" id="anoIni" class="required">
					<?php for($x = date('Y')+1; $x >= 2010; $x-- ){
					?>
					<option value="<?php echo $x?>" <?php echo ($anoIni == $x) ? "selected" : "" ?>><?php 
					
					if ($anoIni == $x) {
						
						echo $obs2;
						$obs2 = "";	
					}
					
					echo $x?>
					</option>
					<?php 
				
					
					} ?>
				</select>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			
			<p>
			<p>
				<label>Plano de carreira</label>
                <?php 
				echo $valorAtual;
				echo $PlanoCarreirra->selectPlanoCarreirraSelect("required",$idPlanoCarreirraIdiomaProfessor);?>
				<span class="placeholder">Campo Obrigatório</span>
			</p>
			<div class="linha-inteira">
				<p>
					<button class="button blue" onclick="postForm('form_PlanoCarreirraIdiomaProfessor', '<?php echo CAMINHO_CAD."professor/"?>contratado/include/acao/planoCarreirraIdiomaProfessor.php?id=<?php echo $idPlanoCarreirraIdiomaProfessor?>');" >
						Enviar
					</button>

				</p>
			</div>
		</form>
	</fieldset>

</div>
<script>ativarForm();</script>
