<?php 
//sanitiza o email
function sanitizeEmail($email) {
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    return $email;
}

//sanitiza o nome do usuario
function sanitizeUserName($userName) {
    $userName = filter_var($userName, FILTER_SANITIZE_SPECIAL_CHARS);
    return $userName;
}

//valida a senha
function validatePassword($password) {
    return preg_match("/^(.{8,16})$/",$password);
}

//compara as senhas
function comparePassword($password1, $password2) {
    return $password1 == $password2;
}

//valida o nome do usuario
function validateUserName($userName) {
    return preg_match("/^.{1,20}$/",$userName);
}

//valida o email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

//procura por um usuario em um arquivo txt de acordo com seu email
function findUser($email){
    $banco = fopen("bancoUsuarios.txt", "r");
    while(($linha=fgets($banco)) != false){
        $dados = explode(";", $linha);
        if($dados{0} == $email){
            return array($dados{1}, substr($dados{2}, 0, -1));
        }
    }
}


$formType = $_POST["type"];

//se o formulario for de registro, sanitiza e valida os campos e salva em um arquivo txt
if($formType == "register") {
    $userName = $_POST["userName"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = sanitizeEmail($email);
    $userName = sanitizeUserName($userName);

    $validationConfirmsArray = array("password" => false, "userName" => false, "email" => false);
    $validationConfirmsArray["password"] = validatePassword($password) and comparePassword($password, $_POST["passwordAgain"]);
    $validationConfirmsArray["userName"] = validateUserName($userName);
    $validationConfirmsArray["email"] = validateEmail($email);

    if($validationConfirmsArray["password"] and $validationConfirmsArray["userName"] and $validationConfirmsArray["email"]) {
        $banco = fopen("bancoUsuarios.txt", "a");
        $txt = $email . ";" . $password . ";" . $userName . "\n";
        echo $txt;
        fwrite($banco, $txt);
        fclose($banco);
        header("location: http://localhost:8080/pi2023/login.html");
        exit;
    }
}
echo "Sucesso";


//se o formulario for de login, procura pelo usuario em um arquivo txt
if($formType == "login") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = sanitizeEmail($email);
    $user = findUser($email);
    if($user[0] == $password) {
        session_start();
        $_SESSION["email"] = $email;
        $_SESSION["userName"] = $user[1];
        header("location: http://localhost:8080/pi2023/index.php");
        exit;
    }
}
?>