<?php include("principal.html");
    $msgErro = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $codigoBarra = $_GET["codigoBarra"];
        $formInvalido = 0;

        function validarDigit($dado) {
            if ($dado == "" or !ctype_digit($dado)) {
                $formInvalido = 1;
            }
        }
        validarDigit($codigoBarra);

        $msgErro = "";
        if ($formInvalido == 0) {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $nomeBanco = "dbav2";
    
            $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
            if ($conn->connect_error) {
                die("Conexao falhou: " . $conn->connect_error);
            }
            $sql = "UPDATE `produtos` SET `ativo` = 'nao' WHERE `codigoBarra` = '$codigoBarra';";
            
            if ($conn->query($sql) === TRUE) {
                echo "produto $codigoBarra excluido com sucesso";
                echo "<br>";
            } else {
                echo "Erro no update";
                $msgErro = "Erro no update";
            }
        } else {
            $msgErro = "formulário com erro";
        }
    }

?>