<?php
    require("pdoConnect.php");
    $resposta = array();
    //var_dump($_GET);

    $dados = file_get_contents("php://input");
    $objeto = json_decode($dados);

    // $user_latitude = $_POST["latitude"];
    // $user_longitude = $_POST["longitude"];
    $query = "SELECT estabelecimento.id,
    estabelecimento.nome, 
    estabelecimento.nota_media, 
    foto_estabelecimento.uri_image, 
    tipo_estabelecimento.tipo_estabelecimento,
    endereco.cidade, 
    endereco.logradouro,
    endereco.tipo_logradouro,
    acos(sin(endereco.latitude*PI()/180)*sin($objeto->userLatitude*PI()/180)+cos(endereco.latitude*PI()/180)*cos($objeto->userLatitude*PI()/180)*cos(endereco.longitude*PI()/180 - $objeto->userLongitude*PI()/180))*6371 as distancia
    FROM ESTABELECIMENTO 
    INNER JOIN ENDERECO
    ON endereco.endereco_PK = estabelecimento.FK_endereco_endereco_PK
    INNER JOIN TIPO_ESTABELECIMENTO
    ON tipo_estabelecimento.tipo_estabelecimento_PK = estabelecimento.FK_tipo_estabelecimento_tipo_estabelecimento_PK
    INNER JOIN FOTO_ESTABELECIMENTO
    ON foto_estabelecimento.foto_estabelecimento_PK = estabelecimento.FK_foto_estabelecimento_foto_estabelecimento_PK
    ORDER BY distancia DESC";
    $consulta = $db->prepare($query);
    if($consulta->execute()){
        $respostas["sucesso"] = 1;
        $respostas["estabelecimentos"] = array();
        if($consulta->rowCount() > 0){
            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                $estabelecimento = array();
                $estabelecimento["id"] = $linha["id"];
                $estabelecimento["nome_estabelecimento"] = $linha["nome"];
                $estabelecimento["nota_media"] = $linha["nota_media"];
                $estabelecimento["foto_estabelecimento"] = $linha["uri_image"];
                $estabelecimento["tipo_estabelecimento"] = $linha["tipo_estabelecimento"];
                $estabelecimento["cidade"] = $linha["cidade"];
                $estabelecimento["logradouro"] = $linha["logradouro"];
                $estabelecimento["tipo_logradouro"] = $linha["tipo_logradouro"];
                $estabelecimento["distancia"] = $linha["distancia"];
                array_push($respostas["estabelecimentos"], $estabelecimento);
            }
        }
    }
    else{
        $respostas["sucesso"] = 0;
        $respostas["erro"] = "erro: " . $consulta->error;
  
    }
    echo json_encode($respostas);
?>