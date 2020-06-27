<?php
/**
* Este script serve como exemplo de uso dos métodos da classe ImageResize e ImageCrop.
*
* As classes ImageResize e ImageCrop recebem dois argumentos no método construtor.
* O primeiro é o endereço do diretório atual (__DIR__)
* O segundo é o nome da imagem a ser redimensionada.
*
* Você deve especificar a largura e a altura da imagem final no método setSize(int, int).
*
* Após instaciar o objeto $img e especificar a largura e altura da imagem
* basta usar o método resizeImage() para redimensionar a imagem
* ou o método cropImage() para cortar a imagem
*/

require 'classes/ImageResize.php';
require 'classes/ImageCrop.php';

// substitua o valor desta variável pelo local onde a imagem esta salva
$imagem = "img/amostra.jpg";

/* REDIMENSIONANDO IMAGENS */

$larguraMáxima = 200; // largura máxima da imagem após ser redimensionada
$alturaMaxima  = 200; // altura máxima da imagem após ser redimensionada

// O primeiro argumento do método construtor dever ser __DIR__, ou seja, não mude-o
$novaImagem = new ImageResize(__DIR__, $imagem);

// define largura e altura máxima da nova imagem
$novaImagem->setSize($larguraMáxima, $alturaMaxima);

// exibe informações da imagem, com tamanho e tipo
echo $novaImagem->getInfo();

// redimensiona a imagem
$novaImagem->resizeImage();

/* CORTANDO IMAGENS */

$largura = 200; // largura da imagem final após ser cortada
$altura  = 200; // altura da imagem final após ser cortada

// O primeiro argumento do método construtor dever ser __DIR__, ou seja, não mude-o
$imagemCortada = new ImageCrop(__DIR__, $imagem);

// define largura e altura máxima da nova imagem
$imagemCortada->setSize($largura, $altura);

// exibe informações da imagem, com tamanho e tipo
echo $imagemCortada->getInfo();

// corta a imagem
$imagemCortada->cropImage();