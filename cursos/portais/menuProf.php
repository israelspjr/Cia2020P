<?php 
$Professor = new Professor();
$candidato = $Professor->getCandidato($_SESSION['idProfessor_SS']);
$email = $Professor->getEmail($_SESSION['idProfessor_SS']);

//if (!$email) {
//	echo "<span style=\"color:red;\">Atenção não foi encontrado um email no seu cadastro, não é possivel continuar o processo sem um email</span>";
//}

if ($candidato == 1) {
	$disabled = "style=\"display:none;\"";
} else {
	$disabled = "";
}
 ?>
<ul class="nav menu">
			<li class="active"><a href="/cursos/portais/index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Início</a></li>
            <?php if ($_SESSION['idProfessor_SS'] != -1) { ?>
			<li <?php echo $disabled?> ><a href="#"  onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/ff/indexProf.php', '#centro')"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Folha de frequência</a></li>
		<li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/psa/index.php', '#centro');"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Pesquisa de satisfação antiga</a></li>
        <li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/novaPsa/index.php', '#centro');"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Pesquisa de satisfação nova</a></li>
			<li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/bancoHoras/index.php', '#centro');"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Banco de horas</a></li>
			<li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/frequencia/index.php', '#centro');"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-pencil"></use></svg> Relatório de frequência</a></li>
            <li class="parent " <?php echo $disabled?>>
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span><span data-toggle="collapse" href="#sub-item-1"> Financeiro </span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/demonstrativoPagamento/index.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Demonstrativos
						</a>
					</li>
					<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/aulasDadas/index.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Aulas Dadas no mês
						</a>
					</li>
			
				</ul>
			</li>
            
            <li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/provas/index.php', '#centro');"><svg class="glyph stroked star" ><use xlink:href="#stroked-star"></use></svg> Avaliações</a></li>
                <li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/aulas/index.php', '#centro');"><svg class="glyph stroked camcorder" ><use xlink:href="#stroked-camcorder"></use></svg> Aulas Assistidas</a></li>
                
                <?php } ?>
            <li class="parent ">
				<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/professor.php', '#centro');">
					<span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span><span data-toggle="collapse" href="#sub-item-2"> Dados Pessoais </span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/professor.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Cadastro
						</a>
					</li>
					<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/formacaoPerfilProf.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Perfil Pessoal
						</a>
					</li>
                    
                    <?php if ($_SESSION['idProfessor_SS'] != -1) {?>
                    <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/cadastro/resourceHTML/disponibilidadeProfessor.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Disponibilidade
						</a>
					</li>
                    
                    <?php } ?>
		<!--	<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/cadastro/resourceHTML/localAulaProfessor.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Local de Aula
						</a>
					</li>-->
                 <?php if ($_SESSION['idProfessor_SS'] != -1) {?>    
                    <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/cadastro/form/dadosBancario.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Dados Bancários
						</a>
					</li>
                     <?php } ?>
                    
				</ul>
			</li>
            <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/busca/index.php', '#centro');"><svg class="glyph stroked round-coffee-mug"><use xlink:href="#stroked-round-coffee-mug"></use></svg> <blink>Vagas</blink></a></li>
                    
            
            <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/idiomaProfessor.php', '#centro');"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Idiomas</a></li>
            
            <?php if ($_SESSION['idProfessor_SS'] != -1) {?>
            
			<li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/contrato/index.php', '#centro');"><svg class="glyph stroked app-window "><use xlink:href="#stroked-app-window"></use></svg> Contratos</a></li>
            <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/lovemondays/index.php', '#centro');"><svg class="glyph stroked app-window content"><use xlink:href="#stroked-app-window-with-content"></use></svg> Love Mondays</a></li>
            		
             <li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/metricas/index.php', '#centro');"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Métricas e cronogramas</a></li>
             
             <?php } ?>
                 <li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/bc/index.php', '#centro');"><svg class="glyph stroked external hard drive"><use xlink:href="#stroked-external-hard-drive"></use></svg> Banco de conhecimento</a></li>
               <li <?php echo $disabled?>><a href="https://goo.gl/forms/Fyyp82VRgFeviZzs2" target="_new"><svg class="glyph stroked two messages"><use xlink:href="#stroked-two-messages"></use></svg> Usina de Ideias</a></li>
              <li <?php echo $disabled?>><a href="https://www.facebook.com/groups/docentesincriveis/" target="_new"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> D.I.C.A.S</a></li>
          
          	  <?php if ($_SESSION['idProfessor_SS'] != -1) {?> 
              <li <?php echo $disabled?>><a href="#" onclick="zerarCentro();carregarModulo('/cursos/mobile/professor/modulos/arquivos/index.php', '#centro');"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> VPGs Online</a></li>
			 <?php } ?>
           
			<li role="presentation" class="divider"></li>
			<li><a href="logoff.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Sair</a></li>
		</ul>
<script>
function zerarCentro() {
	$('#divs_jquery').html('');
	$('#centro').html('');	
}
</script>
<?php 
if (($appN == 1) || ($appN == 3)) {
	$portal = "Aluno";	
} elseif ($appN == 2) {
	$portal = "Professor";	
} elseif ($appN == 4) {
	$portal = "RH";	
}
$Configuracoes = new Configuracoes();
$config = $Configuracoes->selectConfig();

$array = array("+", "-", " ");
$telefone = str_replace($array, "", $config[0]['whatsApp']);
?>

<a target="_blank" title="Entre em contato" class="whatsapp-plug-icon" style="position: fixed; z-index: 1000; bottom: 20px; left: 20px; width: 50px; height: 50px; -webkit-border-radius: 50%; cursor: pointer; background-color: #0ba360; transition: .3s; background-position: center; background-repeat: no-repeat; background-image: url('<?php echo CAMINHO_IMG?>/zap23.png'); background-size: 50% auto;" href="https://api.whatsapp.com/send?phone=<?php echo $telefone?>&amp;text=Portal do <?php echo $portal;?>: " rel="noopener noreferrer"></a>