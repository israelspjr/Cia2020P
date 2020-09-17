<style>
.linha-inteira {
	float:left;
	width:100%;
	
}

</style>
<ul class="nav menu">
 
<?php if ($_SESSION['idClientePf_SS'] != 4) { ?>
             <?php if ($appN != 4) { ?>
				<li class="active"><a id="ff" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/ff/index.php', '#centro')"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Folha de frequência</a></li>
                 <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/acompanhamento/index.php', '#centro');"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Relatório de desempenho</a></li>
                  <li><a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/demonstrativoCobranca/index.php', '#centro');">
<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Demonstrativos</a></li>
				<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/contrato/index.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Documentos
						</a>
					</li>  
            <?php } else { ?>
                <li class="active"><a id="ff" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/charts.php', '#centro');"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Início</a></li>
                 <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/grupo/index.php', '#centro');"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Grupos</a></li>
                 </li>
<li><a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/desempenho/indexI.php', '#centro');">
<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Relatório de desempenho
						</a>
					</li>
            	 <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/bancoHoras/index.php', '#centro');"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Banco de horas</a></li>
                  <li><a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/demonstrativoCobranca/indexR.php', '#centro');"><svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Demonstrativos</a></li>
            <?php } ?>
             
             <li style="display:none;"><a id="cff" onclick="zerarCentro();carregarModulo('modulos/ff/resourceHTML/ff.php?mes=<?php echo $mes ?>&ano=<?php echo $ano ?>&idPlanoAcaoGrupo=<?php echo $_SESSION['idPlanoAcaoGrupo']?>&idFolhaFrequencia=<?php echo $_SESSION['idFolhaFrequencia']?>&idProfessor=<?php echo $_SESSION['idProfessor']?>', '#centro');" >Contestação de folha</a></li>	
              
                      
                    <?php if ($appN == 4) { ?>  
                    		<li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/psa/indexR.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Pesquisa de satisfação
						</a>
					</li>
                    
                    <?php } else { ?>
                     <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/boletos/', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Boletos
						</a>
					</li>    
                    
             <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/psa/index.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Pesquisa de satisfação
						</a>
					</li>
                    
 <?php if ($_SESSION['responderPsa'] == 1) { 
  
  	$PsaIntegranteGrupo = new PsaIntegranteGrupo();
	$RespostaPsaProfessor = new RespostaPsaProfessor();
	$RespostaPsaRegular = new RespostaPsaRegular();
	$PsaProfessor = new PsaProfessor();
	$Professor = new Professor();
	$PsaRegular = new PsaRegular();
     
	 $sql = "SELECT idIntegranteGrupo, dataEntrada, envioPsa FROM integranteGrupo WHERE clientePf_idClientePf = ". $_SESSION['idClientePf_SS']. " AND planoAcaoGrupo_idPlanoAcaoGrupo = ".$_SESSION['idPlanoAcaoGrupo'];
//	 echo $sql;
		$rs = Uteis::executarQuery($sql);
		$idIntegranteGrupo = $rs[0]['idIntegranteGrupo'];
		$dataEntrada = $rs[0]['dataEntrada'];
		
		$temPsa = $PsaIntegranteGrupo -> selectPsaIntegranteGrupo(" WHERE integranteGrupo_idIntegranteGrupo = ".$idIntegranteGrupo." AND finalizado = 0");
		
		if (!$temPsa)  {
	 
 	$PsaIntegranteGrupo -> setIntegranteGrupoIdIntegranteGrupo($idIntegranteGrupo);
	$PsaIntegranteGrupo -> setDataReferencia($dataEntrada);
	$PsaIntegranteGrupo -> setObs(" ");
	$PsaIntegranteGrupo -> setFinalizado(0);
	$idPsaIntegranteGrupo = $PsaIntegranteGrupo -> AddPsaIntegranteGrupo();
	
	//Adicionar Professores
	
	$rs = $Professor->queryProfessorGrupo($_SESSION['idPlanoAcaoGrupo']);
	
	$rs2 = $Professor->selectProfessor(" WHERE 1 ".$rs);

	foreach ($rs2 as $valor) {

	$idProfessor = $valor['idProfessor'];
			
	$psaProfessor = $PsaProfessor->selectPsaProfessor(" WHERE inativo = 0");
	
	foreach ($psaProfessor as $valor) {
		 
	$RespostaPsaProfessor -> setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
	$RespostaPsaProfessor -> setPsaProfessorIdPsaProfessor($valor['idPsaProfessor']);
	$RespostaPsaProfessor -> setProfessorIdProfessor($idProfessor);
	$RespostaPsaProfessor -> setNotasTipoNotaIdNotasTipoNota(1);
	
	$RespostaPsaProfessor -> addRespostaPsaProfessor();
	
		}
		
	// Geral	
		
	$psaRegular = $PsaRegular->selectPsaRegular(" WHERE inativo = 0");
	
	foreach ($psaRegular as $valor) {
	
	$RespostaPsaRegular -> setPsaIntegranteGrupoIdPsaIntegranteGrupo($idPsaIntegranteGrupo);
	$RespostaPsaRegular -> setPsaRegularIdPsa($valor['idPsa']);
	$RespostaPsaRegular -> setNotasTipoNotaIdNotasTipoNota(1);
	
	$RespostaPsaRegular -> addRespostaPsaRegular();
	
	}
		
	}
	
		} else {
		
		$idPsaIntegranteGrupo = $temPsa[0]['idPsaIntegranteGrupo'];	
		}
		
		?>
        <li style="display:none;" ><a id="psa" onclick="abrirNivelPagina(this, 'modulos/psa/form/perguntasPsa.php?id=<?php echo $idPsaIntegranteGrupo ?>&idIntegranteGrupo=<?php echo $idIntegranteGrupo ?>&idPlanoAcaoGrupo=<?php echo $_SESSION['idPlanoAcaoGrupo']?>', 'modulos/psa/index.php', '#centro');" >PSA</a></li>
        <?php	} 
		
					}?>                    
            
                    <?php if ($appN != 4) { ?>
                    <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/provas/index.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Avaliações
						</a>
					</li>
             <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/frequencia/index.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Relatório de Frequência
						</a>
					</li>
                    	<li>
						<a class="" id="perfil" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/form/clientepf.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Perfil 
						</a>
					</li>
                     <?php } else {?>
                     <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/provas/indexR.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Avaliações
						</a>
					</li>
				  <li>
						<a class="" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/frequencia/indexR.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Relatório de Frequência
						</a>
					</li>		 
						 	<li>
						<a class="" id="perfil" href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/form/clientePj.php', '#centro');">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Dados cadastrais 
						</a>
					</li>
						  <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/contrato/indexR.php', '#centro');"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Contratos</a></li>
					<?php }?>
                    <?php } ?>
                    
		
    <?php if ($_SESSION['idClientePf_SS'] != 4) { ?>
    		 <?php if ($appN != 4) { ?>
             <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/resourceHTML/opcaoAtividadeExtraClientePf.php', '#centro');"><svg class="glyph stroked external hard drive"><use xlink:href="#stroked-external-hard-drive"></use></svg> Perfil idioma</a></li>
              <li><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/cadastro/resourceHTML/opcaoAtividadeExtraProfessorClientePf.php', '#centro');"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Perfil professor</a></li>
			<?php } ?>
           <li ><a href="#" onclick="zerarCentro();carregarModulo('/cursos/portaismodulos/aviso/resourceHTML/aviso.php', '#centro');" ><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg>Meus avisos</a></li>
			<li role="presentation" class="divider"></li>
            <?php } ?>
			<li><a href="logoff.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Sair</a></li>
		</ul>
      
<script>
function zerarCentro() {
	$('#divs_jquery').html('');
	$('#centro').html('');	
}
</script>

<?php if ($_SESSION['idClientePf_SS'] != 4) { ?>
<script>
  function Sub(){
    $("#submenu").toggle();
  }
<?php if ($_SESSION['tipo'] > 0) { ?>

 
 $(document).ready(function(){
   $('#ff').trigger('click');
});
<?php } else { ?>

<?php if ($_SESSION['responderPsa'] == 1) { ?>
	$('#psa').trigger('click');
<?php } else { ?>
	
 
 $(document).ready(function(){
//   $('#ff').trigger('click');
});
<?php } ?>
  
  <?php } ?>
</script>
<?php } else {?>
<script>
  function Sub(){

  }
 
 $(document).ready(function(){
 	$('#perfil').trigger('click');
    $("#submenu").toggle();
});
  
</script>

<?php  }?>

<a target="_blank" title="Entre em contato" class="whatsapp-plug-icon" style="position: fixed; z-index: 1000; bottom: 20px; left: 20px; width: 50px; height: 50px; -webkit-border-radius: 50%; cursor: pointer; background-color: #0ba360; transition: .3s; background-position: center; background-repeat: no-repeat; background-image: url('<?php echo CAMINHO_IMG?>/zap23.png'); background-size: 50% auto;" href="https://api.whatsapp.com/send?phone=5511982044234&amp;text=Portal do aluno: " rel="noopener noreferrer"></a>