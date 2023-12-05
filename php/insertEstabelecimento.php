<?php
    require("pdoConnect.php");
    //parcialmente funcional
    $resposta = array();

    if(isset($_POST["nome_estabelecimento"]) && isset($_POST["tipo_estab"]) && isset($_POST["estado"]) && isset($_POST["cidade"]) && isset($_POST["bairro"]) && isset($_POST["tipo_logradouro"]) && isset($_POST["logradouro"]) && isset($_POST["latitude"]) && isset($_POST["longitude"]) && isset($_FILES["img_perfil"])){
        $nome_estabelecimento = filter_var($_POST["nome_estabelecimento"], FILTER_SANITIZE_STRING);

        //error_log(var_dump($_FILES), 0);

        $filename = $_FILES['img_perfil']['tmp_name'];
        $client_id= "488371ea46cb4a3";
        $handle = fopen($filename, "r");
        $data = fread($handle, filesize($filename));
        $pvars   = array('image' => base64_encode($data));
        $timeout = 30;

        // Criar um contexto de fluxo com os cabeçalhos e os dados da requisição
        $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n".
                        "Authorization: Client-ID ".$client_id."\r\n",
            'content' => http_build_query($pvars),
            'timeout' => $timeout
        )
        ));

        // Enviar a requisição e obter a resposta
        $out = file_get_contents('https://api.imgur.com/3/image.json', false, $context);
        $pms = json_decode($out,true);
        $img_url=$pms['data']['link'];



        $logradouro = filter_var($_POST["logradouro"], FILTER_SANITIZE_STRING);
        $cidade = filter_var($_POST["cidade"], FILTER_SANITIZE_STRING);
        $bairro = filter_var($_POST["bairro"], FILTER_SANITIZE_STRING);
        $numeroEndereco = filter_var($_POST["numero"], FILTER_SANITIZE_NUMBER_INT);
        $estado = $_POST["estado"];
        $tipo_logradouro = $_POST["tipo_logradouro"];
        $numero = $_POST["numero"];
        $latitude = $_POST["latitude"];

        $longitude = $_POST["longitude"];
        $tipo_estab = $_POST["tipo_estab"];
        $query = trim("SELECT * FROM ENDERECO WHERE endereco.estado = '$estado' and endereco.cidade = '$cidade' and endereco.bairro = '$bairro' and endereco.tipo_logradouro = '$tipo_logradouro' and endereco.logradouro = '$logradouro' and endereco.numero = $numero");
        $consulta = $db->prepare($query);
        $consulta->execute();
        
        if($consulta->rowCount() > 0){
            $resposta["sucesso"] = 0;
            $resposta["erro"] = "estabelecimento ja cadastrado";
        }
        else{
            $insertEndereco = $db->prepare("INSERT INTO ENDERECO (logradouro, tipo_logradouro, estado, cidade, bairro, numero, latitude, longitude) VALUES ('$logradouro', '$tipo_logradouro', '$estado', '$cidade', '$bairro', $numero, $latitude, $longitude)");
            $insertEndereco->execute();
            $idEnderco = $db->prepare("SELECT endereco_pk FROM ENDERECO WHERE bairro = '$bairro' and numero = $numero");
            $idEnderco->execute();
            $resulIdEnderco = $idEnderco->fetch(PDO::FETCH_ASSOC);
            $idEnderecoEstab = $resulIdEnderco["endereco_pk"];
            
            $insertFoto = $db->prepare("INSERT INTO foto_estabelecimento (uri_image, descricao) VALUES ('$img_url', null)");
            $insertFoto->execute();
            $idFoto = $db->prepare("SELECT foto_estabelecimento_PK FROM FOTO_ESTABELECIMENTO WHERE uri_image = '$img_url'");
            $idFoto->execute();
            $resultIdFoto = $idFoto->fetch(PDO::FETCH_ASSOC);
            $idFotoEstab = $resultIdFoto["foto_estabelecimento_pk"];
            error_log("idFotoEstab " . $idFotoEstab, 0);
            error_log("idEnderecoEstab " . $idEnderecoEstab, 0);

            $insertEstab = $db->prepare("INSERT INTO ESTABELECIMENTO (nota_media, nome, FK_endereco_endereco_PK, FK_tipo_estabelecimento_tipo_estabelecimento_PK, FK_foto_estabelecimento_foto_estabelecimento_PK, FK_selo_selo_PK) VALUES (null, '$nome_estabelecimento', $idEnderecoEstab, '$tipo_estab', $idFotoEstab, null)");
            error_log("entrou aqui 0", 0);
            if($insertEstab->execute()){
                error_log("entrou aqui 1", 0);
                $resposta["sucesso"] = 1;
                //header('location: http://localhost/pi2023/');
                //die();
            }
            else {
                error_log("entrou aqui 2 " . $insertEstab->error, 0);
                $resposta["sucesso"] = 0;
                $resposta["erro"] = "error BD " . $insertEstab->error;
            }
        }
    }
    else{
        $resposta["sucesso"] = 0;
        $resposta["erro"] = "faltam parametros";
    }
    $db = null;
    echo json_encode($resposta);
?>