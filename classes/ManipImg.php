<?php

/**
* Autor: Josué B. da Silva
* Website: joshuawebdev.wordpress.com
* Email: josue.barros1986@gmail.com
* Versão 0.0.3
*/

abstract class ManipImg {
  protect $width;           // largura informada pelo usuário
  protect $height;          // altura informada pelo usuário
  protect $imgPath;         // endereço onde encontra-se a imagem a ser redimensionada
  protect $imgFileName;     // nome do arquivo/imagem a ser redimensionada
  protect $inicialWidth;    // largura da imagem original
  protect $inicialHeight;   // altura da imagem original
  protect $mimeType;        // tipo da imagem
  protect $finalWidth;      // largura da imagem após ser redimensionada
  protect $finalHeight;     // altura da imagem após ser redimensionada
  protect $newImage;        // nova imagem
  protect $inicialRatio;    // ratio (largura dividida pela altura) da imagem original
  protect $finalRatio;      // ratio (largura dividida pela altura) da imagem final

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

  public function getInfo() {
    echo "Tamanho: ".$this->inicialWidth." x ".$this->inicialHeight."\nTipo: ".$this->mimeType.PHP_EOL;
  }

  abstract function setSize($w, $h);
}