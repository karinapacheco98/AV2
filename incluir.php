<?php include("principal.html");
    $msgErro = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $nome = $_GET["nome"];
        $codigoBarra = $_GET["codigoBarra"];
        $fabricante = $_GET["fabricante"];
        $categoria = $_GET["categoria"];
        $tipo = $_GET["tipo"];
        $preco = $_GET["preco"];
        $quantEstoque = $_GET["quantEstoque"];
        $peso = $_GET["peso"];
        $descricao = $_GET["descricao"];
        $imagem = $_GET["imagem"];
        $dataInclusao = $_GET["dataInclusao"];
        $ativo = $_GET["ativo"];
        $formInvalido = 0;

        function validarAlpha($dado) {
            if ($dado == "" or ctype_alpha($dado)) {
                $formInvalido = 1;
            }
        }
        function validarDigit($dado) {
            if ($dado == "" or !ctype_digit($dado)) {
                $formInvalido = 1;
            }
        }

        validarAlpha($nome);
        validarDigit($codigoBarra);
        validarDigit($quantEstoque);
        validarDigit($peso);
        validarAlpha($ativo);
        
        if ($formInvalido == 0) {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $nomeBanco = "dbav2";
    
            $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
            if ($conn->connect_error) {
                die("Conexao falhou: " . $conn->connect_error);
            }
            $sql = "INSERT INTO `produtos`(`nome`, `codigoBarra`, `fabricante`, `categoria`, `tipo`, `preco`, `quantEstoque`, `peso`, `descricao`, `imagem`, `dataInclusao`, `ativo`) VALUES ('$nome','$codigoBarra','$fabricante', '$categoria','$tipo','$preco','$quantEstoque','$peso','$descricao','$imagem','$dataInclusao','$ativo')";
          
            if ($conn->query($sql) === TRUE) {
                echo "produto $nome inserido com sucesso";
                echo "<br>";
            } else {
                echo "Erro no insert";
                $msgErro = "Erro no insert";
            }
        } else {
            $msgErro = "formulário com erro";
        }
    }
?>
