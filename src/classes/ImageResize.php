<?php

/**
* Autor: Josué B. da Silva
* Website: joshuawebdev.wordpress.com
* Email: josue.barros1986@gmail.com
* Versão 0.0.3
*/

require 'ManipImg.php';

class ImageResize extends ManipImg {

  public function setSize($maxW, $maxH)
  {
    if (empty($maxW) || empty($maxH)) {
      throw new Exception("Você deve informar a largura e a altura máxima da imagem");
    }

    try {
      $this->width  = $maxW;
      $this->height = $maxH;
      $this->finalRatio = $maxW / $maxH;
    } catch (Exception $e) {
      echo $e->getMessage().PHP_EOL;
    }
  }

  public function resizeImage() {
    if ($this->finalRatio > $this->inicialRatio) {
      $this->finalWidth  = $this->height * $this->inicialRatio;
      $this->finalHeight = $this->height;
    } else {
      $this->finalHeight = $this->width / $this->inicialRatio;
      $this->finalWidth  = $this->width;
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