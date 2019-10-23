<?php require_once 'valida.php';
require_once 'autoload.php';
$acao = isset($_POST['acao'])?$_POST['acao']:'';

if (isset($_FILES)) {
    echo 'FILES setado';
}
if($acao == "requisitar"){
    
    $banco = new bancoNN;
    $banco->setTabela("requisicao");
    $dataIni = date('Y-m-d h:i:s');
    $dataFim= date('Y-m-d h:i:s', strtotime($dataIni.' + 3 days'));
    $id = isset($_POST['id'])?$_POST['id']:'';
    $vetor = [$_SESSION['codigo'], $id, $dataIni, $dataFim];
    echo '<pre>';
    print_r($vetor);
    $banco->inserirN($vetor);
    header("location:index.php");
}

else {
    $nome=isset($_POST['nomeprod']) ? $_POST['nomeprod'] : 0;
$descricao=isset($_POST['descricao']) ? $_POST['descricao'] : 0;
$loca=isset($_POST['localizaprod']) ? $_POST['localizaprod'] : 0;
$arquivo=isset($_POST['arquivo']) ? $_POST['arquivo'] : 0;
    // Pasta onde o arquivo vai ser salvo
    $_UP['pasta']='img/Produtos/';
    // Tamanho máximo do arquivo (em Bytes)
    $_UP['tamanho']=1024 * 1024 * 2; // 2Mb
    // Array com as extensões permitidas
    $_UP['extensoes']=array('jpg', 'png', 'gif','jfif');
    // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
    $_UP['renomeia']=true;
    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0]='Não houve erro';
    $_UP['erros'][1]='O arquivo no upload é maior do que o limite do PHP';
    $_UP['erros'][2]='O arquivo ultrapassa o limite de tamanho especifiado no HTML';
    $_UP['erros'][3]='O upload do arquivo foi feito parcialmente';
    $_UP['erros'][4]='Não foi feito o upload do arquivo';

    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivo']['error'] !=0) {
        die("Não foi possível fazer o upload, erro:". $_UP['erros'][$_FILES['arquivo']['error']]);
        exit; // Para a execução do script
    }

    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
    // Faz a verificação da extensão do arquivo
    $extensao=strtolower(end(explode('.', $_FILES['arquivo']['name'])));
    echo $extensão."<br>";
    var_dump($_FILES['arquivo']['name']);

    if (array_search($extensao, $_UP['extensoes'])===false) {
        echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
        exit;
    }

    // Faz a verificação do tamanho do arquivo
    if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
        echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
        exit;
    }

    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia']==true) {
        // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
        $nome_final=md5(time()).".". $extensao;
    }

    else {
        // Mantém o nome original do arquivo
        $nome_final=$_FILES['arquivo']['name'];
    }

    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
        function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality=60) {
            $imgsize=getimagesize($source_file);
            $width=$imgsize[0];
            $height=$imgsize[1];
            $mime=$imgsize['mime'];

            //resize and crop image by center
            switch ($mime) {
                case 'image/gif':
                    $image_create="imagecreatefromgif";
                $image="imagegif";
                break;
                //resize and crop image by center
                case 'image/png':
                    $image_create="imagecreatefrompng";
                $image="imagepng";
                $quality=6;
                break;
                //resize and crop image by center
                case 'image/jpeg':
                    $image_create="imagecreatefromjpeg";
                $image="imagejpeg";
                $quality=60;
                break;
                default:
                    return false;
                break;
            }

            $dst_img=imagecreatetruecolor($max_width, $max_height);
            $src_img=$image_create($source_file);
            $width_new=$height * $max_width / $max_height;
            $height_new=$width * $max_height / $max_width;

            if ($width_new > $width) {
                $h_point=(($height - $height_new) / 2);
                imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
            }

            else {
                $w_point=(($width - $width_new) / 2);
                imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
            }

            $image($dst_img, $dst_dir, $quality);

            if ($dst_img) {
                imagedestroy($dst_img);
            }

            if ($src_img) {
                imagedestroy($src_img);
            }
        }

        //Tamanho da Imagem final
        resize_crop_image(300, 300, $pasta.'/'.$name, $pasta.'/'.$name);
        echo "Upload efetuado com sucesso!";
        echo '<a href="'. $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
        $prod=new produto(0);
        $prod->setNome($nome);
        $prod->setDescricao($descricao);
        $prod->setLocalizacao($loca);
        $prod->setFoto($_UP['pasta'] . $nome_final);
        $prod->setId_usuario($_SESSION['codigo']);
        if($prod->inserirBanco()){}
            header("location:meusprodutos.php");
    }

    else {
        // Não foi possível fazer o upload, provavelmente a pasta está incorreta
        echo "Não foi possível enviar o arquivo, tente novamente";
    }
}

?>