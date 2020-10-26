<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$EnderecoVirtual = new EnderecoVirtual();
$Telefone = new Telefone();
$Endereco = new Endereco();
$HabilidadesProfessor = new HabilidadesProfessor();
$Habilidades = new Habilidades();
$VivenciaProfessor = new VivenciaProfessor();
$Certificacoes = new Certificacoes();
$FormacaoPerfil = new FormacaoPerfil();
$ExperienciaProfissional = new ExperienciaProfissional();
$IdiomaProfessor = new IdiomaProfessor();
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();

$img = new Image();

//$arrayRetorno = array();

//$idProfessor = $_REQUEST['id'];

//Bloco Funções
$conecta = mysql_connect("132.148.149.95", "vagasdep_user", "cia2015@@") or print (mysql_error()); 
mysql_select_db("vagasdep_bd", $conecta) or print(mysql_error()); 

function interesse($x) {
	
	if ($x == 1) {
		$rs = 50;
	} else if ($x == 2) {
		$rs = 51;	
	} else if ($x == 3) {
		$rs = 52;	
	} else if ($x == 4) {
		$rs = 53;	
	} else if ($x == 5) {
		$rs = 54;	
	} else if ($x == 6) {
		$rs = 55;	
	} else if ($x == 7) {
		$rs = 56;	
	} else if ($x == 8) {
		$rs = 57;	
	} else if ($x == 9) {
		$rs = 58;	
	} else if ($x == 10) {
		$rs = 59;	
	} else if ($x == 11) {
		$rs = 60;	
	} else if ($x == 12) {
		$rs = 61;	
	} else if ($x == 13) {
		$rs = 62;	
	} else if ($x == 14) {
		$rs = 63;	
	} else if ($x == 15) {
		$rs = 64;	
	} else if ($x == 16) {
		$rs = 65;	
	} else if ($x == 17) {
		$rs = 66;	
	} else if ($x == 18) {
		$rs = 67;	
	} else if ($x == 19) {
		$rs = 49;	
	} 
	

return $rs;	
}

function idiomas($idIdioma) {

if ($idIdioma == 1) {
	$idCurso = 7;
}  else if ($idIdioma == 2) {
	$idCurso = 4;
}  else if ($idIdioma == 5) {
	$idCurso = 11;
}  else if ($idIdioma == 6) {
	$idCurso = 6;
}  else if ($idIdioma == 7) {
	$idCurso = 5;
}  else if ($idIdioma == 8) {
	$idCurso = 12;
}  else if ($idIdioma == 9) {
	$idCurso = 8;
}  else if ($idIdioma == 10) {
	$idCurso = 19;
}  	
	return $idCurso;
}

function idiomasP($idIdioma) {

if ($idIdioma == 1) {
	$idCurso = 4;
}  else if ($idIdioma == 2) {
	$idCurso = 3;
}  else if ($idIdioma == 3) {
	$idCurso = 6;
}  else if ($idIdioma == 4) {
	$idCurso = 11;
}  else if ($idIdioma == 5) {
	$idCurso = 19;
}  else if ($idIdioma == 6) {
	$idCurso = 8;
}  else if ($idIdioma == 7) {
	$idCurso = 5;
}  else if ($idIdioma == 8) {
	$idCurso = 7;
} else if ($idIdioma == 9) {
	$idCurso = 12;
} else if ($idIdioma == 10) {
	$idCurso = 13;
}  	
	return $idCurso;
}



function Curso($id) {

if ($id == 1) {
	$idCurso = 347;
}  else if ($id == 2) {
	$idCurso = 346;
}  else if ($id == 3) {
	$idCurso = 2;
}  else if ($id == 4) {
	$idCurso = 4;
}  else if ($id == 5) {
	$idCurso = 5;
}  else if ($id == 6) {
	$idCurso = 6;
}  else if ($id == 7) {
	$idCurso = 345;
}  else if ($id == 8) {
	$idCurso = 344;
}  else if ($id == 9) {
	$idCurso = 3;
}  else if ($id == 10) {
	$idCurso = 343;
}  	
	return $idCurso;
}

function certifcado_id($x) {
	$sql6 = "SELECT idCertificadoCurso, titulo, certificacao FROM certificadoCurso WHERE titulo like '".$x."' AND certificacao = 1";
//	echo $sql6;
	$rs = Uteis::executarQuery($sql6);
	return $rs[0]['idCertificadoCurso'];
}

function formacao_id($x) {
	$sql6 = "SELECT idCertificadoCurso, titulo, formacao FROM certificadoCurso WHERE titulo like '".utf8_encode($x)."' AND formacao = 1";
//	echo $sql6;
	$rs = Uteis::executarQuery($sql6);
	return $rs[0]['idCertificadoCurso'];
}


// tratando de importação
for ($i=0;$i<=1500;$i++) {
	$idProfessor = $i;
	echo $i."-";


$sql = "SELECT * FROM tb_candidato where id =".$idProfessor; 

$result = mysql_query($sql, $conecta); 

// Sobre mim
$sql2 = "SELECT sobremim FROM tb_candidato_local where candidato_id =".$idProfessor; 
$result2 = mysql_query($sql2, $conecta); 

while($consulta2 = mysql_fetch_array($result2)) { 

$sobre = utf8_encode($consulta2['sobremim']);
}

// Interesse 
$sql3 = "SELECT experiencia_id, valor, anos, escolas, qual FROM tb_candidato_experiencia where candidato_id =".$idProfessor; 
$result3 = mysql_query($sql3, $conecta); 

//Viagens
$sql4 = "SELECT pais_id, dtde, dtate, candidato_id, atividade, descricao FROM tb_candidato_viagens where candidato_id =".$idProfessor; 
$result4 = mysql_query($sql4, $conecta);

//Certificados
$sql5 = "SELECT candidato_id, descricao, ano, tipo, idioma_id FROM tb_candidato_certificacao where candidato_id =".$idProfessor;
$result5 = mysql_query($sql5, $conecta);

//Formação
$sql6 = "SELECT G.candidato_id, G.grauescolar_id, G.situacao, G.dt_inicio, G.dt_conclusao, G.instituicao, C.descricao FROM tb_candidato_graduacao AS G    INNER JOIN tb_curso AS C on C.id = G.curso_id where candidato_id =".$idProfessor;
$result6 = mysql_query($sql6, $conecta);

//Experiências
$sql7 = "SELECT candidato_id, funcao, dt_inicio, dt_fim, atualidade FROM tb_candidato_expprofissional where candidato_id =".$idProfessor;
$result7 = mysql_query($sql7, $conecta);

//Idiomas
$sql8 = "SELECT candidato_id, idioma_id FROM tb_candidato_idioma where candidato_id =".$idProfessor;
//echo $sql8;
$result8 = mysql_query($sql8, $conecta);

while($consulta = mysql_fetch_array($result)) { 

$nbr_cpf = $consulta['cpf'];
$nomeF = $consulta['nome'];
$nome = utf8_encode($nomeF);

$email = $consulta['email'];
$email2 = $consulta['email2'];

$tel = $consulta['tel1'];
$tel2 = $consulta['tel2'];

$rua = $consulta['endereco'];
$bairro = $consulta['bairro'];

$cep = $consulta['cep'];
$cidade = $consulta['cidade'];
$sexo = $consulta['sexo'];
$rg = $consulta['rg'];
$senhaTxt = $consulta['senhatxt'];
$dt = $consulta['dtnasc'];

}

$parte_um     = substr($nbr_cpf, 0, 3);
$parte_dois   = substr($nbr_cpf, 3, 3);
$parte_tres   = substr($nbr_cpf, 6, 3);
$parte_quatro = substr($nbr_cpf, 9, 2);

$monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

		$sql2 = "SELECT SQL_CACHE idProfessor FROM professor WHERE documentoUnico='".$monta_cpf."'";
		$resulto = Uteis::executarQuery($sql2);
		
		$idProfessorCursos = $resulto[0]['idProfessor'];
//		echo $idProfessorCursos;
	
	if($idProfessorCursos > 0){
		echo "Cadastro não efetuado, documento já cadastrado.".$nome."<br>";
	//	echo json_encode($arrayRetorno);
//		exit;
	} else {
	
	$inativo = "0";
	$otimaPerformance = "0";
	$altaPerformance = "0";
	$vetado = "0";
	$indisponivel = "0";
	$presencial = "0";
	$online = "0";
	$naoreceberemail = "0";
	
	echo $nome."<br>";
	
	$Professor->setNome($nome);
    $Professor->setNomeExibicao($nome);
    $Professor->setSexo($sexo);
    $Professor->setDataNascimento($dt);
    $Professor->setRg($rg);
    $Professor->setSenha($senhaTxt);
    $Professor->setObs("Importado direto do profteste");
	$Professor->setDocumentoUnico($monta_cpf);
	$Professor->setTipoDocumentoUnicoIdTipoDocumentoUnico(1);	
	$Professor->setEstadoCivilIdEstadoCivil(1);	
	$Professor->setPaisIdPais('');
	$Professor->setCcm('');			
	$Professor->setInss('');
	$Professor->setDataContratacao('');	
	$Professor->setInativo($inativo);		
	$Professor->setOtimaPerformance($otimaPerformance);
	$Professor->setAltaPerformance($altaPerformance);
	$Professor->setVetado($vetado);
	$Professor->setIndisponivel($indisponivel);
    $Professor->setPresencial($presencial);
    $Professor->setTradutor($tradutor);
    $Professor->setConsultor($consultor);
    $Professor->setOnline($online);
	$Professor->setNaoReceberEmail($naoreceberemail);								
	$Professor->setCandidato(1);
	$Professor->setId_migracao('');
	$Professor->setIndicadoPor('');
	$Professor->setCidadeOrigem('');
	$Professor->setSobre($sobre);
	if ($nome != '') {

		$idProfessorN = $Professor->addProfessor();
	//	echo MSG_CADNEW. $consulta['nome'];
		
		//Email
		$EnderecoVirtual->setProfessorIdProfessor($idProfessorN);
		$EnderecoVirtual->settipoEnderecoVirtual_idTipoEnderecoVirtual(1);
		$EnderecoVirtual->setValor($email);
		$EnderecoVirtual->setEprinc(1);
		$EnderecoVirtual->addEnderecoVirtual();
		
		$EnderecoVirtual->setProfessorIdProfessor($idProfessorN);
		$EnderecoVirtual->settipoEnderecoVirtual_idTipoEnderecoVirtual(1);
		$EnderecoVirtual->setValor($email2);
		$EnderecoVirtual->setEprinc(0);
		$EnderecoVirtual->addEnderecoVirtual();
	
	// Telefone
		$Telefone->setProfessorIdProfessor($idProfessorN);
		$Telefone->setNumero($tel);
		$Telefone->addTelefone();
		
		if ($tel2 != '') {
			$Telefone->setProfessorIdProfessor($idProfessorN);
			$Telefone->setNumero($tel2);
			$Telefone->addTelefone();
		}
		
	// Endereço
	    $Endereco->setProfessorIdProfessor($idProfessorN);
		$Endereco->setPaisIdPais(33);
		$Endereco->setPrincipal(1);
		$Endereco->setRua($rua);
		$Endereco->setBairro($bairro);
		$Endereco->setCep($cep);
	//	$Endereco->setCidadeIdCidade($cidade);
		$Endereco->addEndereco();
		
		// Inserir Interesses
	
	while($consulta3 = mysql_fetch_array($result3)) { 
	
	$experiencia_id = $consulta3['experiencia_id'];  
	$valor = $consulta3['valor'] + 1; 
	
	$anos = $consulta3['anos'];
	$escolas = $consulta3['escolas']; 
	$qual = $consulta3['qual'];
	
	$novoId = interesse($experiencia_id);
	
	$HabilidadesProfessor->setIdHabilidade($novoId);
	$HabilidadesProfessor->setIdProfessor($idProfessorN);
	$HabilidadesProfessor->setObs($qual);						
	$HabilidadesProfessor->setAnos($anos);
	$HabilidadesProfessor->setEscolas($escolas);
	$HabilidadesProfessor->setResposta($valor);
	
	$HabilidadesProfessor->addHabilidadesProfessor();	
	}

	// Adicionar Viagens
	while($consulta4 = mysql_fetch_array($result4)) { 
		$pais_id = $consulta4['pais_id']; 
		$dtde = $consulta4['dtde'];
		$dtate = $consulta4['dtate']; 
		$candidato_id= $consulta4['dtate'];
		$atividade = $consulta4['atividade'];
		$descricao2 =  $consulta4['descricao'];
		
		if ($atividade == 'turismo') {
			$atividade = 1;
		} else if ($atividade == 'trabalho') {
			$atividade = 2;
		} else if ($atividade == 'estudo') {
			$atividade = 3;
		} else if ($atividade == 'outros') {
		$descricao = $consulta4['descricao'];
			$atividade = 4;
				}
			
		
	$VivenciaProfessor->setPaisIdPais($pais_id);
	$VivenciaProfessor->setProfessorIdProfessor($idProfessorN);
	$VivenciaProfessor->setObs($descricao2);
	$VivenciaProfessor->setDataRetorno($dtate);
	$VivenciaProfessor->setDataPartida($dtde);
	$VivenciaProfessor->setAtividade($atividade);
	
	$VivenciaProfessor->addVivenciaProfessor();
	}
		
	//Certificações
	while($consulta5 = mysql_fetch_array($result5)) { 	
		$idCertificado = certifcado_id($consulta5['descricao']); 
	//	echo $idCertificado;
		$ano = $consulta5['ano'];
		$tipo = $consulta5['tipo'];
			 if ($tipo == 'N') {
				$tipo = 1; 
			 } else {
				$tipo = 2;
			 }
		$idioma_id = idiomas($consulta5['idioma_id']);
	
	$Certificacoes->setProfessorIdProfessor($idProfessorN);
	$Certificacoes->setCertificado($idCertificado);
	$Certificacoes->setAno($ano);
	$Certificacoes->setTipo($tipo);
	$Certificacoes->setIdiomaIdIdioma($idioma_id);
	$Certificacoes->addCertificacoes();		
	}
		
	//Formação perfil
	while($consulta6 = mysql_fetch_array($result6)) { 	
		$idNivel = Curso($consulta6['grauescolar_id']); 
		$idFormacao = formacao_id($consulta6['descricao']);
		
	//	$obs ="";
		
		$obs = "Data de inicio: ".Uteis::exibirData($consulta6['dt_inicio'])."<br>Data de termino: ".Uteis::exibirData($consulta6['dt_conclusao'])."<br>".utf8_encode($consulta6['instituicao']);
		if ($consulta6['situacao'] == 3) {
			$finalizado = 1;
		} else  {
			$finalizado = 0;
		}
		$FormacaoPerfil->setClientePfIdClientePf("");
		$FormacaoPerfil->setProfessorIdProfessor($idProfessorN);
		$FormacaoPerfil->setFormacao($idNivel);
		$FormacaoPerfil->setCurso($idFormacao);
		$FormacaoPerfil->setInstituicao("");
		$FormacaoPerfil->setObs($obs);
		$FormacaoPerfil->setFinalizado($finalizado);
		$idFormacaoPerfil = $FormacaoPerfil->addFormacaoperfil();
	}

	//Experiência profissional	
	while($consulta7 = mysql_fetch_array($result7)) { 	
		
		$obs = "Data de inicio: ".Uteis::exibirData($consulta6['dt_inicio']);
		if ($consulta7['atualidade'] == 1) {
			$obs .= "<br>Atual";	
		} else {
			$obs .= "<br>Data de termino: ".Uteis::exibirData($consulta6['dt_fim']);
		}
		
	
		$ExperienciaProfissional->setProfessorIdProfessor($idProfessorN);
		$ExperienciaProfissional->setEmpresa("");
		$ExperienciaProfissional->setFuncao(utf8_encode($consulta7['funcao']));
		$ExperienciaProfissional->setObs($obs);
		
		$ExperienciaProfissional->addExperienciaProfissional();
		}
		
		
	// Idiomas
	while($consulta8 = mysql_fetch_array($result8)) { 
	
		$idIdioma = idiomasP($consulta8['idioma_id']);
		
		$IdiomaProfessor->setProfessorIdProfessor($idProfessorN);
		$IdiomaProfessor->setIdiomaIdIdioma($idIdioma);
		$IdiomaProfessor->setSotaqueIdiomaProfessorIdSotaqueIdiomaProfessor("");
		$IdiomaProfessor->setNivelLinguisticoIdNivelLinguistico("");
		$IdiomaProfessor->setDataContratacao();
		$IdiomaProfessor->setObs("");
		$IdiomaProfessor->setInativo(0);
		
		$IdiomaProfessor->addIdiomaProfessor();
		
		
		$ProcessoSeletivoProfessor->setProfessorIdProfessor($idProfessorN);
		$ProcessoSeletivoProfessor->setIdiomaIdIdioma($idIdioma);
		$ProcessoSeletivoProfessor->setDataReferencia(date("Y-m-d"));
		$ProcessoSeletivoProfessor->addProcessoSeletivoProfessor();
	
		}
	} // Fim bloco de insert
		

}
//echo json_encode($arrayRetorno);
}
?>