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

        if ($formInvalido == 0) {
            $servidor = "localhost";
            $usuario = "root";
            $senha = "";
            $nomeBanco = "dbav2";
    
            $conn = new mysqli($servidor, $usuario, $senha, $nomeBanco);
            if ($conn->connect_error) {
                die("Conexao falhou: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM `produtos` WHERE `codigoBarra` = '$codigoBarra'";
            
            
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($linha = $result->fetch_assoc()) {

                    echo "<h1><br>&nbsp;&nbsp;&nbsp;&nbsp;Código de barra: " . $linha["codigoBarra"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; Nome: " . $linha["nome"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; fabricante: " . $linha["fabricante"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; categoria: " . $linha["categoria"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; tipo: " . $linha["tipo"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; preco: " . $linha["preco"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; estoque: " . $linha["quantEstoque"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; peso: " . $linha["peso"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; descricao: " . $linha["descricao"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; imagem: " . $linha["imagem"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; dataInclusao: " . $linha["dataInclusao"]
                        . "<br>&nbsp;&nbsp;&nbsp;&nbsp; ativo: " . $linha["ativo"];
                    echo "<br><br></h1>";
                }
            } else{
                echo "<h1><br><br>Produto nao encontrado.</h1>";
            }
        } else {
            $msgErro = "formulário com erro";
        }
    }
?>
