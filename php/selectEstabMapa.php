<?php
    require("pdoConnect.php");

    $resposta = array();

    $query = "SELECT estabelecimento.nome,
    tipo_estabelecimento.tipo_estabelecimento_pk,
    endereco.latitude,
    endereco.longitude
    FROM ESTABELECIMENTO INNER JOIN tipo_estabelecimento
    ON tipo_estabelecimento.tipo_estabelecimento_PK = estabelecimento.FK_tipo_estabelecimento_tipo_estabelecimento_PK
    INNER JOIN ENDERECO
    ON endereco.endereco_PK = estabelecimento.FK_endereco_endereco_PK";
    $consulta = $db->prepare($query);
    if($consulta->execute()){
        $resposta["estabelecimentos"] = array();
        if($consulta->rowCount() > 0){
            $resposta["sucesso"] = 1;
            while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
                $estabelecimento = array();
                $estabelecimento["nome"] = $linha["nome"];
                $estabelecimento["tipo_estabelecimento"] = $linha["tipo_estabelecimento_pk"];
                $estabelecimento["latitude"] = $linha["latitude"];
                $estabelecimento["longitude"] = $linha["longitude"];
                array_push($resposta["estabelecimentos"], $estabelecimento);
            }
        }
        else{
            $resposta["sucesso"] = 0;
            $resposta["erro"] = 'nenhum estabelecimento encontrado';
        }
    }
    else{
        $resposta["sucesso"] = 0;
        $resposta["erro"] = "erro: " . $consulta->error;
    }

    echo json_encode($resposta);
?>