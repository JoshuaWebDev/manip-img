<?php
require 'autoload.php';

//use HandleImage\ImageResize;

// subsituta o nome amostra pelo nome da imagem que pretende manipular
$img = new ImageResize("amostra.jpg");

// define largura e altura máxima da nova imagem
$img->maxSize(200, 200);

// exibe informações da imagem, com tamanho e tipo
echo $img->getInfo();

// redimensiona a imagem
$img->resizeImage();