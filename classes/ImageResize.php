<?php

/**
* Autor: Josué B. da Silva
* Website: joshuawebdev.wordpress.com
* Email: josue.barros1986@gmail.com
* Versão 0.0.1
*/

class ImageResize {
  private $maxWidth;        // largura máxima da imagem redimensionada
  private $maxHeight;       // altura máxima da imagem redimensionada
  private $imgPath;         // endereço onde encontra-se a imagem a ser redimensionada
  private $imgFileName;     // nome do arquivo/imagem a ser redimensionada
  private $inicialWidth;    // largura da imagem antes de ser redimensionada
  private $inicialHeight;   // altura da imagem antes de ser redimensionada
  private $mimeType;        // tipo da imagem
  private $finalWidth;      // largura da imagem após ser redimensionada
  private $finalHeight;     // altura da imagem após ser redimensionada
  private $newImage;        // nova imagem
  private $inicialRatio;    // ratio (largura dividida pela altura) da imagem original
  private $finalRatio;      // ratio (largura dividida pela altura) da imagem final

  public function __construct($localDir, $img)
  {
    if (empty($img)) {
      throw new Exception("Você deve informar o nome do arquivo/imagem");
    }

    try {
      $this->imgPath       = $localDir."/".$img;
      $tempArrayNameImg    = explode('/', $img);
      $this->imgFileName   = array_pop($tempArrayNameImg);
      $this->inicialWidth  = getimagesize($this->imgPath)[0];
      $this->inicialHeight = getimagesize($this->imgPath)[1];
      $this->mimeType      = getimagesize($this->imgPath)['mime'];
      $this->inicialRatio  = $this->inicialWidth / $this->inicialHeight;
    } catch (Exception $e) {
      echo $e->getMessage().PHP_EOL;
    }
  }

  public function maxSize($maxW, $maxH)
  {
    if (empty($maxW) || empty($maxH)) {
      throw new Exception("Você deve informar a largura e a altura máxima, respectivamente");
    }

    try {
      $this->maxWidth  = $maxW;
      $this->maxHeight = $maxH;
      $this->finalRatio = $maxW / $maxH;
    } catch (Exception $e) {
      echo $e->getMessage().PHP_EOL;
    }
  }

  public function getInfo() {
    echo "Tamanho: ".$this->inicialWidth." x ".$this->inicialHeight."\nTipo: ".$this->mimeType.PHP_EOL;
  }

  public function resizeImage() {
    if ($this->finalRatio > $this->inicialRatio) {
      $this->inalWidth  = $this->maxHeight * $this->inicialRatio;
      $this->finalHeight = $this->maxHeight;
    } else {
      $this->finalHeight = $this->maxWidth / $this->inicialRatio;
      $this->finalWidth  = $this->maxWidth;
    }

    $this->newImage = imagecreatetruecolor($this->finalWidth, $this->finalHeight);

    if ($this->mimeType === 'image/jpeg') {
      $tempImg = imagecreatefromjpeg($this->imgPath);
    } else if ($this->mimeType === 'image/png') {
      $tempImg = imagecreatefrompng($this->imgPath);
    } else {
      echo "O tipe de arquivo da imagem não é suportado".PHP_EOL;
      exit;
    }

    imagecopyresampled(
      $this->newImage,        // imagem redimensionada
      $tempImg,               // imagem original temporariamente criada
      0, 0, 0, 0,             // coordenadas das imagens final e original respectivamente
      $this->finalWidth,      // largura da imagem final
      $this->finalHeight,     // altura da imagem final
      $this->inicialWidth,    // largura da imagem inicial
      $this->inicialHeight    // altura da imagem inicial
    );

    // salvando arquivo/imagem
    if ($this->mimeType === 'image/jpeg') {
      $tmp = explode('.', $this->imgFileName);
      $newImageName = $tmp[0].rand().time().'.jpg';
      imagejpeg($this->newImage, 'resized/'.$newImageName, 100);
      echo "A imagem redimensionada foi salva em resized/".$newImageName.PHP_EOL;
    } else if ($this->mimeType === 'image/png') {
      $tmp = explode('.', $this->imgFileName);
      $newImageName = $tmp[0].rand().time().'.png';
      imagepng($this->newImage, 'resized/'.$newImageName);
      echo "A imagem redimensionada foi salva em resized/".$newImageName.PHP_EOL;
    } else {
      echo "O tipe de arquivo da imagem não é suportado".PHP_EOL;
      exit;
    }

    echo "Tamanho da nova imagem: ".intval($this->finalWidth)." x ".intval($this->finalHeight).PHP_EOL;
  }
}