<?php
    class Upload {
        private $name; //name do input que o usuário colocará a imagem
        private $pasta; //nome da pasta que receberá a imagem
        private $nome_substituto; //nome que irá sobrescrever o nome da imagem atual
        private $permite; //Tipo de imagem permitida, ex:png,jpg,gif,pjpeg,jpeg

        /**
         * @param name_imagem é o nome do arquivo enviado
         * @param pasta_destino é o caminho da pasta onde será armazenado o arquivo
         * 
         * @return array caso ocorra um erro, onde o na posição de mensagem está descrito o erro
         * @return upload_arquivo caso o upload seja um sucesso, a variavel armazena o caminho da ima
         */
        public function uploadImagem ($name_imagem,$pasta_destino)
        {
            if (!empty($_FILES[$name_imagem]['tmp_name'])) {
                // pega o nome do arquivo enviado
                $this->name = $_FILES[$name_imagem];
                // define o a extensão permitida
                $tipo_permitido = ['jpg', 'png', 'gif','jfif'];
                // define a pasta para onde vai o arquivo
                $this->pasta = $pasta_destino;

                $nome = $this->name['name'];
                // extensão do arquivo
                
                $extensao = end(explode(".",$nome));
                // nome gerado a cada segundo
                $this->nome_substituto = md5(time());
                // caminho do arquivo
                $upload_arquivo = $this->pasta.$this->nome_substituto.".".$extensao;
                foreach ($tipo_permitido as $key => $tipo) {
                    $this->permite[] = $tipo;
                }

                // verifica se o nome não é vazio e se a entensão é permitida
                if(!empty($nome) and in_array($extensao,$this->permite)) { 
                    // verifica de o arquivo foi movido para pasta
                    if(move_uploaded_file($this->name['tmp_name'], $upload_arquivo)) {
                        $this->resize_crop_image(300, 300, $upload_arquivo, $upload_arquivo);
                        return $upload_arquivo;
                    } else {
                        return ['tipo' => 'erro', 'mensagem' => 'não foi possível enviar a imagem'];
                    }
                } else{
                    //faça algo caso não seja a extensão permitida
                    return ['tipo' => 'erro', 'mensagem' => "formato de imagem não aceito pelo sistema."];
                }

        }
        }

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
        
}
?>