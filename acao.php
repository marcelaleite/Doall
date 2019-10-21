<?php
require_once "autoload.php";

$acao = isset($_POST['acao']) ? $_POST['acao'] : 0;
$nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
$sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : 0;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : 0;
$dtnascimento = isset($_POST['dtnascimento']) ? date("Y-m-d", strtotime(str_replace('/', '-', $_POST['dtnascimento']))) : 0;
$email = isset($_POST['email']) ? $_POST['email'] : 0;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : 0;
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : 0;
$numprot = null;
if(isset($_POST['numprot']) and $_POST['numprot'] != 0)
$numprot = $_POST['numprot'];
$cep = isset($_POST['cep']) ? $_POST['cep'] : 0;
$rua = isset($_POST['rua']) ? $_POST['rua'] : 0;
$numero = isset($_POST['numcasa']) ? $_POST['numcasa'] : 0;
$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : 0;
$complemento = isset($_POST['complemento']) ? $_POST['complemento'] : 0;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : 0;
$referencia = isset($_POST['referencia']) ? $_POST['referencia'] : 0;
$log = isset($_POST['log']) ? $_POST['log'] : 0;
$senha = isset($_POST['senha']) ? $_POST['senha'] : sha1("0000");
$senha = sha1($senha);

$endereco = new endereco(0);
if ($acao == "crie") {
    $usuario = new usuario();
    $usuario->setNome($nome);
    $usuario->setSobrenome($sobrenome);
    $usuario->setCpf($cpf);
    $usuario->setDataNasc($dtnascimento);
    $usuario->setEmail($email);
    $usuario->setTelefone($telefone);
    $usuario->setSexo($sexo);
    $usuario->setNProrocolo($numprot);
    $usuario->setSenha($senha);
    $usuario->setFoto(null);
    
    $verificar = UsuarioDao::VerificaCadastro($usuario);
    if ($verificar != 0) {
        echo "CPF ou email já utilizados";
    } else {
        $valida = UsuarioDao::Insert($usuario);
        if ($valida !== true) {
            echo "Cadastro de usuario falhou tente novamente mais tarde!!";
        }
        $usuario = UsuarioDao::Popula(UsuarioDao::Select('CPF', $usuario->getCpf()));
        $endereco = 
        $valida = $endereco->inserir($cep, $rua, $numero, $bairro, $complemento, $cidade, $referencia, $codigo[0][0]);
        if ($valida !== true) {
            echo "Cadastro de endereço falhou tente novamente mais tarde: $valida";
        } else {
            echo "Cadastro concluido!";
        }
    }
} elseif ($acao == "alterar") {
    include 'valida.php';

    $teste = "Select count(id) from usuario where foto = '";
    $teste .= $_FILES['arquivo']['name'] != "" ? $_FILES['arquivo']['name'] : 0;
    $teste .= "' and id = " . $_SESSION['codigo'];
    $verificar = 0;
    $banco = new banco;
    $verificar = $banco->select($teste);
    if ($verificar[0][0] == 0 and $_FILES['arquivo']['name'] != '') {
        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = 'img/Usuario/';
        // Tamanho máximo do arquivo (em Bytes)
        $_UP['tamanho'] = 1024 * 1024 * 20; // 20Mb
        // Array com as extensões permitidas
        $_UP['extensoes'] = array('jpg', 'png', 'gif','jfif');
        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
        $_UP['renomeia'] = true;
        // Array com os tipos de erros de upload do PHP
        $_UP['erros'][0] = 'Não houve erro';
        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';
        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
        if ($_FILES['arquivo']['error'] != 0) {
            die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
            exit; // Para a execução do script
        }
        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
        // Faz a verificação da extensão do arquivo
        $extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
        if (array_search($extensao, $_UP['extensoes']) === false) {
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
        if ($_UP['renomeia'] == true) {
            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
            $nome_final = md5(time()) . "." . $extensao;
        } else {
            // Mantém o nome original do arquivo
            $nome_final = $_FILES['arquivo']['name'];
        }

        // Depois verifica se é possível mover o arquivo para a pasta escolhida
        if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
            function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 60)
            {
                $imgsize = getimagesize($source_file);
                $width = $imgsize[0];
                $height = $imgsize[1];
                $mime = $imgsize['mime'];
                //resize and crop image by center
                switch ($mime) {
                    case 'image/gif':
                        $image_create = "imagecreatefromgif";
                        $image = "imagegif";
                        break;
                        //resize and crop image by center
                    case 'image/png':
                        $image_create = "imagecreatefrompng";
                        $image = "imagepng";
                        $quality = 6;
                        break;
                        //resize and crop image by center
                    case 'image/jpeg':
                        $image_create = "imagecreatefromjpeg";
                        $image = "imagejpeg";
                        $quality = 60;
                        break;
                    default:
                        return false;
                        break;
                }
                $dst_img = imagecreatetruecolor($max_width, $max_height);
                $src_img = $image_create($source_file);
                $width_new = $height * $max_width / $max_height;
                $height_new = $width * $max_height / $max_width;
                if ($width_new > $width) {
                    $h_point = (($height - $height_new) / 2);
                    imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
                } else {
                    $w_point = (($width - $width_new) / 2);
                    imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
                }
                $image($dst_img, $dst_dir, $quality);
                if ($dst_img) imagedestroy($dst_img);
                if ($src_img) imagedestroy($src_img);
            }

            //Tamanho da Imagem final
            resize_crop_image(300, 300, $_UP['pasta'] . '/' . $nome_final, $_UP['pasta'] . '/' . $nome_final);
            // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
            echo "Upload efetuado com sucesso!";
            $excluir = "select foto from usuario where id = {$_SESSION['codigo']}";
            $banco = new banco;
            $resultado = $banco->select($excluir);
            $foto = $user->alterar($_SESSION['codigo'], $nome, $sobrenome, $cpf, $_SESSION['senha'], $dtnascimento, $email, $telefone, $sexo, $prot, $_UP['pasta'] . $nome_final);
        
                unlink($resultado[0][0]);
        } else {
            // Não foi possível fazer o upload, provavelmente a pasta está incorreta
            echo "Não foi possível enviar o arquivo, tente novamente";
        }
        $_SESSION['foto'] = $_UP['pasta'] . $nome_final;
    } elseif ($verificar != 0) {
        $user->alterar($_SESSION['codigo'], $nome, $sobrenome, $cpf, $_SESSION['senha'], $dtnascimento, $email, $telefone, $sexo, $prot, $_SESSION['foto']);
         $_SESSION['nome'] = $nome;
    } else {
        $user->alterar($_SESSION['codigo'], $nome, $sobrenome, $cpf,  $_SESSION['senha'], $dtnascimento, $email, $telefone, $sexo, $prot, "null");
         $_SESSION['nome'] = $nome;
    }
   
    header("location:conta.php");
}
