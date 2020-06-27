<?php

/**
* Autor: Josué B. da Silva
* Website: joshuawebdev.wordpress.com
* Email: josue.barros1986@gmail.com
* Versão 0.0.3
*/

class ImageCrop extends ManipImg {
  private posX = 0;
  private posY = 0;

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

  public function setSize($w, $h)
  {
    if (empty($w) || empty($h)) {
      throw new Exception("Você deve informar a largura e a altura que a imagem deverá ter após ser cortada");
    }

    try {
      $this->width  = $w;
      $this->height = $h;
      $this->finalRatio = $w / $h;
    } catch (Exception $e) {
      echo $e->getMessage().PHP_EOL;
    }
  }

  public function cropImage() {
    if ($this->finalRatio > $this->inicialRatio) {
      $this->finalWidth  = $this->height * $this->inicialRatio;
      $this->finalHeight = $this->height;
    } else {
      $this->finalHeight = $this->width / $this->inicialRatio;
      $this->finalWidth  = $this->width;
    }

    if ($this->finalWidth < $this->width) {
      $this->finalWidth  = $this->width;
      $this->finalHeight = $this->width / $this->inicialRatio;
      $posY = -(($this->finalHeight - $this->height) / 2)
    } else {
      $this->finalHeight = $this->height;
      $this->finalWidth  = $this->height * $this->inicialRatio;
      $posX = -(($this->finalWidth - $this->width) / 2)
    }

    $this->newImage = imagecreatetruecolor($this->width, $this->height);

    if ($this->mimeType === 'image/jpeg') {
      $tempImg = imagecreatefromjpeg($this->imgPath);
    } else if ($this->mimeType === 'image/png') {
      $tempImg = imagecreatefrompng($this->imgPath);
    } else {
      echo "O tipe de arquivo da imagem não é suportado".PHP_EOL;
      exit;
    }

    imagecopyresampled(
      $this->newImage,        // imagem cortada
      $tempImg,               // imagem original temporariamente criada
      $posX, $posY, 0, 0,     // coordenadas das imagens final e original respectivamente
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
      echo "A imagem cortada foi salva em croped/".$newImageName.PHP_EOL;
    } else if ($this->mimeType === 'image/png') {
      $tmp = explode('.', $this->imgFileName);
      $newImageName = $tmp[0].rand().time().'.png';
      imagepng($this->newImage, 'resized/'.$newImageName);
      echo "A imagem cortada foi salva em croped/".$newImageName.PHP_EOL;
    } else {
      echo "O tipe de arquivo da imagem não é suportado".PHP_EOL;
      exit;
    }
  }
}