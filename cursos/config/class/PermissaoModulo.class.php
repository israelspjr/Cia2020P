<?php
class PermissaoModulo extends Database {
	// class attributes
	var $idPermissaoModulo;
	var $moduloIdModulo;
	var $funcionarioIdFuncionario;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPermissaoModulo = "NULL";
		$this -> moduloIdModulo = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPermissaoModulo($value) {
		$this -> idPermissaoModulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setModuloIdModulo($value) {
		$this -> moduloIdModulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addPermissaoModulo() Function
	 */
	function addPermissaoModulo() {
		$sql = "INSERT INTO permissaoModulo (modulo_idModulo, funcionario_idFuncionario, dataCadastro, excluido) VALUES ($this->moduloIdModulo, $this->funcionarioIdFuncionario, $this->dataCadastro, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePermissaoModulo() Function
	 */
	function deletePermissaoModulo($where = "") {
		$sql = "DELETE FROM permissaoModulo WHERE idPermissaoModulo = $this->idPermissaoModulo " . $where;
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPermissaoModulo() Function
	 */
	function updateFieldPermissaoModulo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE permissaoModulo SET " . $field . " = " . $value . " WHERE idPermissaoModulo = $this->idPermissaoModulo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePermissaoModulo() Function
	 */
	function updatePermissaoModulo() {
		$sql = "UPDATE permissaoModulo SET modulo_idModulo = $this->moduloIdModulo, funcionario_idFuncionario = $this->funcionarioIdFuncionario, excluido = $this->excluido WHERE idPermissaoModulo = $this->idPermissaoModulo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPermissaoModulo() Function
	 */
	function selectPermissaoModulo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPermissaoModulo, modulo_idModulo, funcionario_idFuncionario, dataCadastro, excluido FROM permissaoModulo " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPermissaoModuloTr() Function
	 */
	function selectPermissaoModuloTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {

		$sql = "SELECT SQL_CACHE PM.idPermissaoModulo, M.nome
		FROM permissaoModulo AS PM
		INNER JOIN modulo AS M ON M.idModulo = PM.modulo_idModulo" . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPermissaoModulo = $valor['idPermissaoModulo'];
				$nome = $valor['nome'];

				$html .= "<tr>
				
				<td onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idPermissaoModulo', '$caminhoAtualizar', '$ondeAtualiza')\" >$nome</td>
				
				<td align=\"center\" onclick=\"deletaRegistro('$caminhoModulo/configuracoes/permissaoModulo/grava.php', '$idPermissaoModulo', '$caminhoAtualizar', '$ondeAtualiza')\" >
					<img src=\"" . CAMINHO_IMG . "excluir.png\">
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPermissaoModuloSelect() Function
	 */
	function selectPermissaoModuloSelect($idFuncionario) {

		$html = "";

		$Modulo = new Modulo();

		//ULTIMO MODULO SENDO USADO
		$idModulo_ultimo = array();
		//MODULOS Q JA FORAM EXIBIDOS
		$idModulo_jaFoi = array("0");
		//AUX DE MODULOS Q JA FORAM EXIBIDOS, É ZERADO CONSTANTEMENTE
		$idModulo_jaFoi2 = array("0");
		//SELECIONA TODOS DO PRIMEIRO NIVEL
		$rsModulo = $Modulo -> selectModulo(" AND M.modulo_idModulo IS NULL");
		//APENAS PARA CONTAR SE TODOS OS ITENS ESTAO SENDO EXIBIDOS
		$cont = 0;

		if ($rsModulo) {
			foreach ($rsModulo as $valorModulo) {

				//ARMAZENA ID NO MODULO Q SERÁ USADO, NA PROX VOLTA ELE SERÁ O ULTIMO
				$idModulo_ultimo[] = $valorModulo["idModulo"];

				//ORGANIZA O ARRAY, NAO DEIXANDO ESPAÇOS EM BRNACO (o array é gerado com[], sem citar a posição)
				sort($idModulo_ultimo);

				//LOOP INFINITO, O LOOP É PARADO(break) OU PULADO(continue), DE ACORDO COM O BD
				for ($x = 1; $x > 0; $x++) {

					//POSIÇÃO QUE SERÁ CONSIDERADA COMO ULTIMA (antes da atual, no array $idModulo_ultimo)
					$pos = count($idModulo_ultimo) - 1;

					if ($pos >= 0) {

						$idModulo = $idModulo_ultimo[$pos];

						$where = " AND M.modulo_idModulo = " . $idModulo . " AND M.idModulo NOT IN (" . implode(",", $idModulo_jaFoi) . ") ";

						$rsModulo_sub = $Modulo -> selectModulo($where);

					} else {

						$idModulo_jaFoi = array_merge($idModulo_jaFoi, $idModulo_jaFoi2);
						$idModulo_jaFoi2 = array("0");
						break;

					}

					//VERIFICA SE ESTÁ CHECADO OU NÃO PARA O FUNCIONARIO EM QUESTÃO
					$where = " AND M.idModulo = " . $idModulo . " AND F.idFuncionario = " . $idFuncionario;
					$rsChecado = $Modulo -> selectModulo_permissao($where);
					$selecionado = ($rsChecado) ? " checked=\"checked\" " : "";

					if ($rsModulo_sub) {

						$idModulo_ultimo[] = $rsModulo_sub[0]["idModulo"];

						if (in_array($idModulo, $idModulo_jaFoi2))
							continue;

						$rsModulo_n = $Modulo -> selectModulo(" AND M.idModulo = " . $idModulo);

						$nome = $rsModulo_n[0]["nome"];
						$modulo_idModulo = $rsModulo_n[0]["modulo_idModulo"];

						$idModulo_jaFoi2[] = $idModulo;

						$html .= "
						<p>
						<input type=\"checkbox\" $selecionado value=\"$idModulo\" name=\"check[]\" id=\"check_$idModulo\" 
						onchange=\"selectTree(this)\" pai=\"$modulo_idModulo\" >$nome
						</p>
						
						<div class=\"tab2\" >";

					} else {

						$idModulo_jaFoi[] = $idModulo;
						unset($idModulo_ultimo[$pos]);
						sort($idModulo_ultimo);

						if (in_array($idModulo, $idModulo_jaFoi2)) {
							$html .= "</div>";
							continue;
						}

						$rsModulo_n = $Modulo -> selectModulo(" AND M.idModulo = " . $idModulo);

						$nome = $rsModulo_n[0]["nome"];
						$modulo_idModulo = $rsModulo_n[0]["modulo_idModulo"];

						$html .= "
						<p>						
						<input type=\"checkbox\" $selecionado value=\"$idModulo\" name=\"check[]\" id=\"check_$idModulo\" 
						onchange=\"selectTree(this)\" pai=\"$modulo_idModulo\" ><strong>$nome</strong>
						</p>";

					}
					//CONTA O ITEM
					$cont++;
				}
			}
		}
		//echo "<br>total = $cont";
		return $html;
	}

}
?>