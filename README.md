# ManipIMG
Biblioteca de manipulação de imagens, desenvolvida em PHP.

:bust_in_silhouette: Autor: Josué B. da Silva

:globe_with_meridians: Website: joshuawebdev.wordpress.com

:envelope: E-mail: josue.barros1986@gmail.com


## Configurações Iniciais

- primeiramente devemos importar a classe para nosso arquivo que irá utilizar a biblioteca.

        <?php
        require 'classes/ImageResize.php';
        require 'classes/ImageCrop.php';
        ...

## Redimensionando Imagens

- Instancie o objeto da classe ImageResize();

        // o primeiro parâmetro (__DIR__) não deve ser alterado
        // o segundo parâmetro é o local onde está localizada a imagem a ser manipulada
        $img = new ImageResize(__DIR__, "nome_do_arquivo.jpg");

Também é possível armazenar o local da imagem em uma variável e passar a variável como segundo parâmetro do método construtor.

        $imagem = "img/nome_da_imagem.jpg";
        $img = new ImageResize(__DIR__, $imagem);

- Definindo largura e altura máxima da nova imagem

        $img->setSize(300, 300);

Também é possível armazenar a altura e a largura máxima da nova imagem em variáveis, e em seguida passá-las como argumentos do método maxSize().

        $larguraMaxima = 300;
        $alturaMaxima = 200;

        $img->setSize($larguraMaxima, $alturaMaxima);

- Redimensionando a imagem

        $img->resizeImage();

Antes de chamar este método é necessário instaciar o objeto, passando a localização da imagem e, em seguida, informar a largura e a altura máxima pelo método setSize().

## Cortando Imagens

- Instancie o objeto da classe ImageCrop();

        // o primeiro parâmetro (__DIR__) não deve ser alterado
        // o segundo parâmetro é o local onde está localizada a imagem a ser manipulada
        $img = new ImageCrop(__DIR__, "nome_do_arquivo.jpg");

Também é possível armazenar o local da imagem em uma variável e passar a variável como segundo parâmetro do método construtor.

        $imagem = "img/nome_da_imagem.jpg";
        $img = new ImageCrop(__DIR__, $imagem);

- Definindo largura e a altura que a imagem final deve ter

        $img->setSize(300, 300);

Também é possível armazenar a altura e a largura da nova imagem em variáveis, e em seguida passá-las como argumentos do método setSize().

        $largura = 300;
        $altura  = 200;

        $img->setSize($largura, $altura);

- Cortando a imagem

        $img->cropImage();

Antes de chamar este método é necessário instaciar o objeto, passando a localização da imagem e, em seguida, informar a largura e a altura pelo método setSize().

## Outros métodos interessantes

- Obtendo informações da imagem

        echo $img->getInfo();