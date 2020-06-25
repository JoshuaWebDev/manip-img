<?php
/**
* Este script serve como exemplo de uso dos métodos da classe ImageResize.
*
* A classe ImageResize recebe dois argumentos no método construtor.
* O primeiro é o endereço do diretório atual (__DIR__)
* O segundo é o nome da imagem a ser redimensionada.
*
* Você deve especificar a largura e a altura máxima da imagem que deseja no método
* maxSize(int, int).
*
* Após instaciar o objeto $img e especificar a largura e altura máxima da imagem
* basta usar o método resizeImage() para redimensionar a imagem
*/

require 'classes/ImageResize.php';

// substitua o valor desta variável pelo local onde a imagem esta salva
$imagem = "img/amostra.jpg";
$larguraMáxima = 200;       // largura máxima da imagem após ser redimensionada
$alturaMaxima  = 200;       // altura máxima da imagem após ser redimensionada

// O primeiro argumento do método construtor dever ser __DIR__, ou seja, não mude-o
$img = new ImageResize(__DIR__, $imagem);

// define largura e altura máxima da nova imagem
$img->maxSize($larguraMáxima, $alturaMaxima);

// exibe informações da imagem, com tamanho e tipo
echo $img->getInfo();

// redimensiona a imagem
$img->resizeImage();