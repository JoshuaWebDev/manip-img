# manip-img
Biblioteca de manipulação de imagens, desenvolvida em PHP.

:bust_in_silhouette: Autor: Josué B. da Silva

:globe_with_meridians: Website: joshuawebdev.wordpress.com

:envelope: E-mail: josue.barros1986@gmail.com


## Exemplos de Uso

primeiramente devemos importar a classe para nosso arquivo que irá utilizar a biblioteca.

        <?php require 'classes/ImageResize.php';

- Instanciando um objeto

        $img = new ImageResize("nome_do_arquivo.jpg");

- Definindo largura e altura máxima da nova imagem

        $img->maxSize(300, 300);

- Obtendo informações da imagem

        echo $img->getInfo();

- Redimensionando a imagem

        $img->resizeImage();
