<?php
#Image.class.php
#Biblioteca com m�todos para cria��o de imagens de seguran�a
#Contem Metodos para redimencionar imagens e torna-las em escala cinza
#
#Desenvolvido pela Head Trust
#Todos os direitos reservados pela Head Trust
#Criado em: (03/06/2008)
#Modificado em: (22/10/2008) - (23/10/2008) - (07/04/2009) - (21/05/2009) - (03/07/2009) - (13/05/2010)
# - (17/04/2011) - (18/04/2011) - (09/05/2011)

class Image {

	private $pointer = 0, $check;
	//Gera os ponteiros para trabalhar com v�rias imagens
	private $image, $width, $height, $mime, $size;
	//Atributos para informa��es da imagem de entrada
	private $re_width, $re_height, $re_quality, $re_size, $re_resize, $re_go;
	//Atributos para o redimensionamento
	private $co_width, $co_height, $co_x, $co_y, $co_newX, $co_newY;
	//Atributos para o corte de imagem.
	private $resource;
	//Variavel resource da imagem
	private $errors;
	//Variavel de erros
	private $memoryLimit;

	static $_IMG_RESIZE_PROPORTIONAL = 0, $_IMG_RESIZE_PROPORTIONAL_HEIGHT = 1, $_IMG_RESIZE_PROPORTIONAL_WIDTH = 2, $_IMG_RESIZE_FIXED = 3;
	static $_IMG_GO_SMALL = 0, $_IMG_GO_BIG = 1, $_IMG_GO_BOTH = 2;

	public function __construct() {
		ini_set('memory_limit', '128M');
		$this -> memoryLimit = ini_get('memory_limit');
	}

	/*
	 * M�todos de limpagem
	 */

	//Limpar os valores de um �nico ponteiro para todos os atributos
	// bool cleanPointer ( int $pointer )
	public function cleanPointer($pointer) {
		if ($this -> check[$pointer] == 'checked') {
			unset($this -> check[$pointer], $this -> image[$pointer], $this -> width[$pointer], $this -> height[$pointer], $this -> mime[$pointer], $this -> size[$pointer], $this -> re_width[$pointer], $this -> re_height[$pointer], $this -> re_quality[$pointer], $this -> re_size[$pointer], $this -> re_resize[$pointer], $this -> re_go[$pointer], $this -> resource[$pointer]);
			return true;
		} else {
			return false;
		}
	}

	//Limpa todos os ponteiros de todos os atributos
	// void cleanAll ( void )
	public function cleanAll() {
		$this -> check = array();
		$this -> image = array();
		$this -> width = array();
		$this -> height = array();
		$this -> mime = array();
		$this -> size = array();
		$this -> re_width = array();
		$this -> re_height = array();
		$this -> re_quality = array();
		$this -> re_size = array();
		$this -> re_resize = array();
		$this -> re_go = array();
		$this -> resource = array();
		$this -> pointer = 0;
	}

	/*
	 * Fim dos m�todos de limpagem
	 */

	/*
	 * M�todos de controle de uso da classe
	 */

	//Cria o ponteiro para o trabalho com v�rias imagens
	// int pointer ( void )
	protected function pointer() {
		$pointer = ++$this -> pointer;
		$this -> check[$pointer] = 'checked';
		return $pointer;
	}

	/*
	 * Fim dos m�todos de controle de uso da classe
	 */

	//Recebe a imagem a ser trabalhada e extrai seus atributos
	//int prepareImage ( String $filename )
	public function prepareImage($filename) {
		$pointer = $this -> pointer();
		if (is_file($filename)) {
			$info = getimagesize($filename);
			$this -> image[$pointer] = $filename;
			$this -> width[$pointer] = $info[0];
			$this -> height[$pointer] = $info[1];
			$this -> mime[$pointer] = $info[2];
			$this -> size[$pointer] = filesize($filename);

			return $pointer;
		} else {
			$this -> errorMSG($pointer, 'Imagem n�o existe!');
			return false;
		}
	}

	//Prepara uma imagem para ser redimensionada
	// bool prepareResize ( int $pointer, int $width, int $height, [ int $quality , [ int $resize , [ int $go ] ] ] )
	public function prepareResize($pointer, $width, $height, $quality = 80, $resize = 0, $go = 2) {
		if ($this -> check[$pointer] == 'checked') {
			$this -> re_width[$pointer] = $width;
			$this -> re_height[$pointer] = $height;
			$this -> re_quality[$pointer] = $quality;
			$this -> re_resize[$pointer] = $resize;
			$this -> re_go[$pointer] = $go;

			return true;
		} else {
			$this -> errorMSG($pointer, 'A imagem n�o foi preparada para este tipo de execu��o');
			return false;
		}
	}

	//Faz o redimensionamento da imagem
	// bool createThumbNail ( int $pointer, String $filename )
	public function createThumbNail($pointer, $filename) {
		if ($this -> check[$pointer] == 'checked') {

			//Verifica se ser� feito o redimensionamento
			//Se for permitido tanto expandir como diminuir a imagem
			if ($this -> re_go[$pointer] == self::$_IMG_GO_BOTH) {
				$resize = true;

				//Se for permitido somente diminuir a imagem
			} else if ($this -> re_go[$pointer] == self::$_IMG_GO_SMALL) {

				//Faz a verifica��o tanto para altura quanto para largura
				if ($this -> re_resize[$pointer] == self::$_IMG_RESIZE_PROPORTIONAL) {
					$resize = (($this -> width[$pointer] > $this -> re_width[$pointer]) || ($this -> height[$pointer] > $this -> re_height[$pointer])) ? true : false;

					//Faz a verifica��o somente para a altura
				} else if ($this -> re_resize[$pointer] == self::$_IMG_RESIZE_PROPORTIONAL_HEIGHT) {
					$resize = ($this -> height[$pointer] > $this -> re_height[$pointer]) ? true : false;
					//Faz a verifca��o somente para a largura
				} else {
					$resize = ($this -> width[$pointer] > $this -> re_width[$pointer]) ? true : false;
				}

				//Se for permitida somente expandir a imagem
			} else {

				//Faz a verifica��o tanto para altura quanto para largura
				if ($this -> re_resize[$pointer] == self::$_IMG_RESIZE_PROPORTIONAL) {
					$resize = (($this -> width[$pointer] < $this -> re_width[$pointer]) || ($this -> height[$pointer] < $this -> re_height[$pointer])) ? true : false;

					//Faz a verifica��o somente para a altura
				} else if ($this -> re_resize[$pointer] == self::$_IMG_RESIZE_PROPORTIONAL_HEIGHT) {
					$resize = ($this -> height[$pointer] < $this -> re_height[$pointer]) ? true : false;

					//Faz a verifca��o somente para a largura
				} else {
					$resize = ($this -> width[$pointer] < $this -> re_width[$pointer]) ? true : false;
				}
			}

			//Caso seja necess�rio redimensionar
			if ($resize) {

				$array['resource'] = $this -> typeCreateImage($pointer);
				$this -> resource[$pointer] = $array['resource'];

				$properties = $this -> properties($pointer);
				$array['resized'] = ImageCreateTrueColor($properties["resized_width"], $properties["resized_height"]);
				$array['copy'] = ImageCopyResampled($array['resized'], $array['resource'], 0, 0, 0, 0, $properties["resized_width"], $properties["resized_height"], $properties["width"], $properties["height"]);

				$array['interlace'] = ImageInterlace($array['resized'], 1);
				$array['save'] = $this -> typeCloseImage($pointer, $array['resized'], $filename);
				$array['destroy'] = ImageDestroy($array['resource']);
				ImageDestroy($array['resized']);

				if (array_search(false, $array, 1) === false) {
					$this -> re_size[$pointer] = filesize($filename);
					return true;
				} else {
					$this -> errorMSG($pointer, 'Houve uma falha ao tentar redimensionar a imagem');
					return false;
				}

				//Caso n�o seja necess�rio redimensionar, ent�o faz s� uma c�pia
			} else {
				$this -> re_size[$pointer] = $this -> size[$pointer];
				return (($this -> image[$pointer] == $filename) ? true : copy($this -> image[$pointer], $filename));
			}

			//Caso a imagem n�o exista
		} else {
			$this -> errorMSG($pointer, 'A imagem n�o foi preparada para a execu��o');
			return false;
		}
	}

	//Prepara uma imagem para ser cortada
	// bool prepareCopy ( int $pointer, int $width, int $height, [ int $x, [ int $y, [ int $newX, [ int $newY, [ int $quality ] ] ] ] ] )
	public function prepareCopy($pointer, $width, $height, $x = 0, $y = 0, $newX = 0, $newY = 0, $quality = 80) {
		if ($this -> check[$pointer] == 'checked') {
			$this -> co_width[$pointer] = $width;
			$this -> co_height[$pointer] = $height;
			$this -> co_x[$pointer] = $x;
			$this -> co_y[$pointer] = $y;
			$this -> co_newX[$pointer] = $newX;
			$this -> co_newY[$pointer] = $newY;
			$this -> re_quality[$pointer] = $quality;
			return true;
		} else {
			$this -> errorMSG($pointer, 'A imagem n�o foi preparada para a execu��o');
			return false;
		}
	}

	//Faz a copia de uma �rea determinada da imagem
	// bool copyImage ( int $pointer, String $filename )
	public function copyImage($pointer, $filename) {
		if ($this -> check[$pointer] == 'checked') {

			list($width, $height, $x, $y, $newX, $newY) = array($this -> co_width[$pointer], $this -> co_height[$pointer], $this -> co_x[$pointer], $this -> co_y[$pointer], $this -> co_newX[$pointer], $this -> co_newY[$pointer]);

			//Verifica se � permitido a c�pia
			//Caso as dimens�es informadas sejam maiores que as dimens�es originais, retorna falso.
			if (($width > $this -> width[$pointer]) && ($height > $this -> height[$pointer])) {
				var_dump($width, $this -> width[$pointer], $height, $this -> height[$pointer]);
				echo 'PASSEI AQUI12';
				$this -> errorMSG($pointer, 'N�o � poss�vel cortar a imagem com dimens�es maiores que as dimens�es do original');
				return false;
			} else if (($width == $this -> width[$pointer]) && ($height == $this -> height[$pointer])) {
				return (($this -> image[$pointer] == $filename) ? true : copy($this -> image[$pointer], $filename));
			} else {
				$array['resource'] = $this -> typeCreateImage($pointer);
				$this -> resource[$pointer] = $array['resource'];

				$array['newImage'] = ImageCreateTrueColor($width, $height);
				$array['copy'] = imagecopy($array['newImage'], $array['resource'], $newX, $newY, $x, $y, $width, $height);

				$array['interlace'] = ImageInterlace($array['newImage'], 1);
				$array['save'] = $this -> typeCloseImage($pointer, $array['newImage'], $filename);
				$array['destroy'] = ImageDestroy($array['resource']);
				ImageDestroy($array['newImage']);

				var_dump($array);

				if (array_search(false, $array, 1) === false) {
					return true;
				} else {
					$this -> errorMSG($pointer, 'A imagem n�o foi copiada devido a uma falha na execu��o');
					return false;
				}
			}

			//Caso a imagem n�o exista
		} else {
			$this -> errorMSG($pointer, 'A imagem n�o foi preparada para a execu��o');
			return false;
		}
	}

	//Verifica o tipo de redimensionamento e gera os atributos para o redimensionamento
	// array properties ( int $pointer )
	private function properties($pointer) {

		//Caso os valores sejam para redimensionamento fixo
		if ($this -> re_resize[$pointer] == self::$_IMG_RESIZE_FIXED) {
			return array('resized_width' => $this -> re_width[$pointer], 'resized_height' => $this -> re_height[$pointer], 'width' => $this -> width[$pointer], 'height' => $this -> height[$pointer]);

			//Faz os calculos para o redimensionamento proporcional
		} else {
			$array = $this -> resize($pointer);
			return array('resized_width' => $array[0], 'resized_height' => $array[1], 'width' => $array[2], 'height' => $array[3]);
		}
	}

	//Faz os calculos para o redimensionamento proporcinal conforme a especifica��o
	// array resize ( int $pointer )
	protected function resize($pointer) {
		$width = $this -> width[$pointer];
		$height = $this -> height[$pointer];
		$type = $this -> re_resize[$pointer];

		//Calcula proporcionalmente as dimens�es conforme a dimens�o que for maior
		if ($type == self::$_IMG_RESIZE_PROPORTIONAL) {
			$size = $this -> re_width[$pointer];
			if ($width >= $height) {
				$x = ($width > $size) ? (int)($width * ($size / $width)) : (int)$size;
				$y = ($width > $size) ? (int)($height * ($size / $width)) : (int)($size * ($height / $width));
			} else {
				$x = ($height > $size) ? (int)($width * ($size / $height)) : (int)($size * ($width / $height));
				$y = ($height > $size) ? (int)($height * ($size / $height)) : (int)$size;
			}

			//Calcula proporcionalmente somente para a altura
		} else if ($type == self::$_IMG_RESIZE_PROPORTIONAL_HEIGHT) {
			$size = $this -> re_height[$pointer];
			$x = ($height > $size) ? (int)($width * ($size / $height)) : (int)($size * ($width / $height));
			$y = ($height > $size) ? (int)($height * ($size / $height)) : (int)$size;

			//Calcula proporcionamente somente para a largura
		} else {
			$size = $this -> re_width[$pointer];
			$x = ($width > $size) ? (int)($width * ($size / $width)) : (int)$size;
			$y = ($width > $size) ? (int)($height * ($size / $width)) : (int)($size * ($height / $width));
		}

		return array($x, $y, $width, $height);
	}

	//Conforme o mimetype do arquivo, faz a escolha para cria��o de imagens
	// resource typeCreateImage ( int $pointer )
	protected function typeCreateImage($pointer) {
		$filename = $this -> image[$pointer];
		$mime = $this -> mime[$pointer];
		if (imagetypes() & $mime) {
			switch($mime) {
				case IMAGETYPE_JPEG :
					return imageCreateFromJPEG($filename);
					//2
					break;
				case IMAGETYPE_WBMP :
					return imageCreateFromWBMP($filename);
					//15
					break;
				case IMAGETYPE_GIF :
					return imageCreateFromGIF($filename);
					//1
					break;
				case IMAGETYPE_PNG :
					return imageCreateFromPNG($filename);
					//3
					break;
				case IMAGETYPE_XBM :
					return imageCreateFromXBM($filename);
					//16
					break;
			}
		} else {
			$this -> errorMSG($pointer, 'Tipo de imagem n�o permitida para cria��o de imagens!');
			return false;
		}
	}

	//Conforme o mimetype do arquivo, envia para o browser ou arquivo
	// resource typeCloseImage ( Resource $resource, String $filename , int $mime )
	protected function typeCloseImage($pointer, $resource, $filename) {
		$mime = $this -> mime[$pointer];
		$quality = $this -> re_quality[$pointer];
		if (imagetypes() & $mime) {
			switch($mime) {
				case IMAGETYPE_JPEG :
					return imageJPEG($resource, $filename, $quality);
					//2
					break;
				case IMAGETYPE_WBMP :
					return imageWBMP($resource, $filename);
					//15
					break;
				case IMAGETYPE_GIF :
					return imageGIF($resource, $filename);
					//1
					break;
				case IMAGETYPE_PNG :
					return imagePNG($resource, $filename);
					//3
					break;
				case IMAGETYPE_XBM :
					return imagexbm($resource, $filename);
					//16
					break;
			}
		} else {
			$this -> errorMSG($pointer, 'Tipo de imagem n�o permitida fechamento da imagem!');
			return false;
		}
	}

	//Verifica se a imagem pode ser redimensionada
	// boolean Image::isRedimensionable ( String $filename )
	public function isRedimensionable($filename) {
		if (is_file($filename)) {
			return (imagetypes() & exif_imagetype($filename)) ? true : false;
		} else {
			return false;
		}
	}

	//Verifica se a imagem � editavel
	//Este m�todo � apenas um alias para Image::isRedimensionable()
	// boolean Image::isEditable ( String $filename )
	public function isEditable($filename) {
		return $this -> isRedimensionable($filename);
	}

	//Verifica se o arquivo � uma imagem
	// boolean Image::isImage ( String $filename )
	public function isImage($filename) {
		$imagetypes = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_SWF, IMAGETYPE_PSD, IMAGETYPE_BMP, IMAGETYPE_TIFF_II, IMAGETYPE_TIFF_MM, IMAGETYPE_JPC, IMAGETYPE_JP2, IMAGETYPE_JPX, IMAGETYPE_JB2, IMAGETYPE_SWC, IMAGETYPE_IFF, IMAGETYPE_WBMP, IMAGETYPE_XBM);

		if (is_file($filename)) {
			return in_array($imagetypes, exif_imagetype($filename), true);
		} else {
			return false;
		}
	}

	//Retorna todos os tipos de imagens suportados pelo servidor
	// Array getSupportedImageTypes ( void )
	public function getSupportedImageTypes() {
		$supportedTypes = array();

		$posImg = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WBMP, IMAGETYPE_XBM);

		foreach ($posImg as $imgType) {
			if (imagetypes() & $imgType) {
				$supportedTypes[] = strtoupper(image_type_to_extension($imgType, false));
			}
		}

		return $supportedTypes;
	}

	//Gera uma mensagem de erro
	// void errorMSG ( int $pointer,  string $msg )
	protected function errorMSG($pointer, $msg) {
		$this -> errors[$pointer] .= "\n{$msg}\r\n";
	}

	//Pega os erros para um determinado ponteiro
	// string getErrors ( int $pointer )
	public function getErrors($pointer) {
		return $this -> errors[$pointer];
	}

	//Retorna todos os erros ocorridos
	// string debug ( void )
	public function debug() {
		$errors = $this -> errors;
		return (is_array($errors)) ? implode("\n", $errors) : false;
	}

	public function __destruct() {
		ini_set('memory_limit', $this -> memoryLimit);
	}

}
?>