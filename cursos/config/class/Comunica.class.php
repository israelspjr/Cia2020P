<?php
class Comunica extends Database {
	// class attributes
	var $idArquivos;
	var $idiomaIdIdioma;
	var $link;
	var $inativo;
	var $nomeArquivo;
	var $bc;
	var $professor;
	var $categoriaIdCategoria;
	

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idArquivos = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> link = "NULL";		
		$this -> inativo = "0";
		$this -> nomeArquivo = "NULL";		
		$this -> bc = "0";
		$this -> professor = "0";
		$this -> categoriaIdCategoria = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdArquivos($value) {
		$this -> idArquivos = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setLink($value) {
		$this -> link = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setNomeArquivo($value) {
		$this -> nomeArquivo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setBc($value) {
		$this -> bc = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setProfessor($value) {
		$this -> professor = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setCategoriaIdCategoria($value) {
		$this -> categoriaIdCategoria = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addTelefone() Function
	 */
	function addArquivos() {
		$sql = "INSERT INTO arquivos (idioma_idIdioma, link, ativo, nomeArquivo, bc, professor, categoria_idCategoria) VALUES ($this->idiomaIdIdioma, $this->link,  $this->inativo, $this->nomeArquivo, $this->bc, $this->professor, $this->categoriaIdCategoria)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteArquivos($or = " 1 = 2 ") {
		$sql = "DELETE FROM arquivos WHERE idArquivos = $this->idArquivos OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldArquivos($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE arquivos SET " . $field . " = " . $value . " WHERE idArquivos = $this->idArquivos";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateArquivos() {
		$sql = "UPDATE arquivos SET idioma_idIdioma = $this->idiomaIdIdioma, link = $this->link, ativo = $this->inativo, nomeArquivo = $this->nomeArquivo, bc = $this->bc, professor = $this->professor, categoria_idCategoria = $this->categoriaIdCategoria WHERE idArquivos = $this->idArquivos";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectArquivos($where = "") {
		$sql = "SELECT SQL_CACHE idArquivos, idioma_idIdioma,link, ativo, nomeArquivo, bc, professor, categoria_idCategoria FROM arquivos " . $where;
		return $this -> executeQuery($sql);
	}

	function selectArquivosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $bc, $naoDeleta = 0) {
		
		$Idioma = new Idioma();
		$Segmento = new Segmento();
		
		if ($bc == 1)
		$where .= " AND T.bc = 1";

		$sql = "SELECT SQL_CACHE T.idArquivos, T.idioma_idIdioma, T.link, T.ativo, T.nomeArquivo, T.bc, T.professor, T.categoria_idCategoria
		FROM arquivos AS T ".$where;
		

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idArquivos'];
				$idiomaN = $valor['idioma_idIdioma'];
				$nomeIdioma = $Idioma->getNome($idiomaN);
				$inativo = Uteis::exibirStatus($valor['ativo']);
				$bc = Uteis::exibirStatus($valor['bc']);
				$professor = Uteis::exibirStatus($valor['professor']);
				$categoria = $Segmento->getNome($valor['categoria_idCategoria']);
			
				$link = $valor['link'];
				

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				
				<td $onclick >" . $valor['nomeArquivo'] . "</td> 
     			<td $onclick >" . $link . "</td>
    			<td $onclick >" . $nomeIdioma . "</td>
				<td $onclick >" . $bc . "</td>
				<td $onclick >" . $professor . "</td>
				<td $onclick >" . $categoria . "</td>
				
				<td  style=\"text-align:center\">" . $inativo . "</td>";
				

				if ($naoDeleta == 0) {
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "comunica/include/acao/comunica.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				} else {
				$html .= "<td></td>";
				}
				
				
				$html .= "</tr>";

			}
		}
		return $html;
	}
	/*
	function selectHabilidadesCheckbox($where = "",$idProfessor) {

    $sql = "SELECT SQL_CACHE idHabilidades, descricao, inativo FROM habilidades  ";
    $result = $this -> query($sql);
 
    $HabilidadesProfessor = new HabilidadesProfessor();

    if (mysqli_num_rows($result) > 0) {
 
    $Acompanhamento = $HabilidadesProfessor -> selectHabilidadesProfessor($where);

      while ($valor = mysqli_fetch_array($result)) {

        if ($Acompanhamento) {
          $where2 =  $where." AND idHabilidade = " . $valor['idHabilidades'];
		  
          $checked = $HabilidadesProfessor -> selectHabilidadesProfessor($where2) ? " checked " : "";

        } 

        $html .= "<div  >";

        $html .= "<label for=\"check_habilidades_" . $valor['idHabilidades'] . "\">";

        $html .= "<input type=\"checkbox\" id=\"check_habilidade_" . $valor['idHabilidades'] . "\" name=\"check_habilidade_" . $valor['idHabilidades'] . "\" $checked value=\"1\" />";

        $html .= "<strong>" . strtoupper($valor['descricao']) . "</strong> ";

        

        $html .= "<div id=\"div_habilidade_" . $valor['idHabilidades'] . "\" style=\"display:" . ($checked == "" ? "none" : "block") . "</div></div>";
		$html .= "</label>";
      }
    }
    return $html;
  }*/

}
?>