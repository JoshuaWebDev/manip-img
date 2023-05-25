<?php

/**
* Autor: Josué B. da Silva
* Website: joshuawebdev.wordpress.com
* Email: josue.barros1986@gmail.com
* Versão 0.0.3
*/

abstract class ManipImg {
  protected $width;           // largura informada pelo usuário
  protected $height;          // altura informada pelo usuário
  protected $imgPath;         // endereço onde encontra-se a imagem a ser redimensionada
  protected $imgFileName;     // nome do arquivo/imagem a ser redimensionada
  protected $inicialWidth;    // largura da imagem original
  protected $inicialHeight;   // altura da imagem original
  protected $mimeType;        // tipo da imagem
  protected $finalWidth;      // largura da imagem após ser redimensionada
  protected $finalHeight;     // altura da imagem após ser redimensionada
  protected $newImage;        // nova imagem
  protected $inicialRatio;    // ratio (largura dividida pela altura) da imagem original
  protected $finalRatio;      // ratio (largura dividida pela altura) da imagem final

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