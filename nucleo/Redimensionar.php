<?php

/*
* Classe Redimensionar 
* Foi criada para redimensionar imagens
*/

Class Redimensionar
{
			
	private $imagem;
    private $largura;
	private $altura;
	private $imagemRedimensionada;

	function __construct($nome_arquivo)
	{
		
	  $this->imagem = $this->abrirImagem($nome_arquivo);	 
	  $this->largura  = imagesx($this->imagem);
	  $this->altura = imagesy($this->imagem);
	}

	private function abrirImagem($arquivo)
	{
			
	    $extensao = strtolower(strrchr($arquivo, '.'));

		switch($extensao)
		{
			case '.jpg':
			case '.jpeg':
				$img = @imagecreatefromjpeg($arquivo);
				break;
			case '.gif':
				$img = @imagecreatefromgif($arquivo);
				break;
			case '.png':
				$img = @imagecreatefrompng($arquivo);
				break;
			default:
				$img = false;
				break;
		}
		
		return $img;
	}

		

	public function redimensionarImagem($novaLargura, $novaAltura, $opcoes="auto")
	{
	
		$opcoesArray = $this->getDimensions($novaLargura, $novaAltura, $opcoes);

		$larguraOtimizada  = $opcoesArray['larguraOtimizada'];
		$alturaOtimizada = $opcoesArray['alturaOtimizada'];

		$this->imagemRedimensionada = imagecreatetruecolor($larguraOtimizada, $alturaOtimizada);
		imagecopyresampled($this->imagemRedimensionada, $this->imagem, 0, 0, 0, 0, $larguraOtimizada, $alturaOtimizada, $this->largura, $this->altura);

		if ($opcoes == 'crop') {
			$this->crop($larguraOtimizada, $alturaOtimizada, $novaLargura, $novaAltura);
		}
	}

			
	private function getDimensions($novaLargura, $novaAltura, $option)
	{

			 switch ($option)
		{
			case 'exact':
				$larguraOtimizada = $novaLargura;
				$alturaOtimizada= $novaAltura;
				break;
			case 'portrait':
				$larguraOtimizada = $this->tamanhoSerFixadoAltura($novaAltura);
				$alturaOtimizada= $novaAltura;
				break;
			case 'landscape':
				$larguraOtimizada = $novaLargura;
				$alturaOtimizada= $this->tamanhoSerFixadoLargura($novaLargura);
				break;
			case 'auto':
				$opcoesArray = $this->tamanhoAuto($novaLargura, $novaAltura);
				$larguraOtimizada = $opcoesArray['larguraOtimizada'];
				$alturaOtimizada = $opcoesArray['alturaOtimizada'];
				break;
			case 'crop':
				$opcoesArray = $this->cortarImagemOtimizada($novaLargura, $novaAltura);
				$larguraOtimizada = $opcoesArray['larguraOtimizada'];
				$alturaOtimizada = $opcoesArray['alturaOtimizada'];
				break;
		}
		return array('larguraOtimizada' => $larguraOtimizada, 'alturaOtimizada' => $alturaOtimizada);
	}

		
	private function tamanhoSerFixadoAltura($novaAltura)
	{
		$ratio = $this->largura / $this->altura;
		$novaLargura = $novaAltura * $ratio;
		return $novaLargura;
	}

	private function tamanhoSerFixadoLargura($novaLargura)
	{
		$ratio = $this->altura / $this->largura;
		$novaAltura = $novaLargura * $ratio;
		return $novaAltura;
	}

	private function tamanhoAuto($novaLargura, $novaAltura)
	{
		if ($this->altura < $this->largura) {

			$larguraOtimizada = $novaLargura;
			$alturaOtimizada= $this->tamanhoSerFixadoLargura($novaLargura);

		} elseif ($this->altura > $this->largura) {

			$larguraOtimizada = $this->tamanhoSerFixadoAltura($novaAltura);
			$alturaOtimizada= $novaAltura;

		} else{
			if ($novaAltura < $novaLargura) {
				$larguraOtimizada = $novaLargura;
				$alturaOtimizada= $this->tamanhoSerFixadoLargura($novaLargura);

			} else if ($novaAltura > $novaLargura) {
				$larguraOtimizada = $this->tamanhoSerFixadoAltura($novaAltura);
				$alturaOtimizada= $novaAltura;

			} else {
						
				$larguraOtimizada = $novaLargura;
				$alturaOtimizada= $novaAltura;
			}
		}

		return array('larguraOtimizada' => $larguraOtimizada, 'alturaOtimizada' => $alturaOtimizada);
	}


	private function cortarImagemOtimizada($novaLargura, $novaAltura)
	{

		$alturaRatio = $this->altura / $novaAltura;
		$larguraRatio  = $this->largura /  $novaLargura;

		if ($alturaRatio < $larguraRatio) {
					$optimalRatio = $alturaRatio;
		} else {
					$optimalRatio = $larguraRatio;
		}

		$alturaOtimizada = $this->altura / $optimalRatio;
		$larguraOtimizada  = $this->largura  / $optimalRatio;

		return array('larguraOtimizada' => $larguraOtimizada, 'alturaOtimizada' => $alturaOtimizada);
	}


	private function crop($larguraOtimizada, $alturaOtimizada, $novaLargura, $novaAltura)
	{

		$cropStartX = ( $larguraOtimizada / 2) - ( $novaLargura /2 );
		$cropStartY = ( $alturaOtimizada/ 2) - ( $novaAltura/2 );

		$crop = $this->imagemRedimensionada;
				
		$this->imagemRedimensionada = imagecreatetruecolor($novaLargura , $novaAltura);
		imagecopyresampled($this->imagemRedimensionada, $crop , 0, 0, $cropStartX, $cropStartY, $novaLargura, $novaAltura , $novaLargura, $novaAltura);
	}



	public function salvarImagem($caminhoSalvo, $qualidadeImagem ="100")
	{
				
        $extensao = strrchr($caminhoSal, '.');
       	$extensao = strtolower($extensao);

		switch($extensao)
		{
			case '.jpg':
			case '.jpeg':

				if (imagetypes() & IMG_JPG) {
					imagejpeg($this->imagemRedimensionada, $caminhoSalvo, $qualidadeImagem);
				}
				break;

			case '.gif':

				if (imagetypes() & IMG_GIF) {
					imagegif($this->imagemRedimensionada, $caminhoSalvo);
				}
				break;

			case '.png':

				$escalaQualidade = round(($qualidadeImagem/100) * 9);
				$qualidadeInvertida = 9 - $escalaQualidade;

				if (imagetypes() & IMG_PNG) {
					imagepng($this->imagemRedimensionada, $caminhoSalvo, $qualidadeInvertida);
				}
				
				break;

			default:
				break;
		}

		imagedestroy($this->imagemRedimensionada);
	}
}

