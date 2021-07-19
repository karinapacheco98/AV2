<?php include("principal.html");?>

<!doctype html>
<html>
    <head> 
        <script>
            function Redirecionar(){
                codigoBarra = document.getElementById("codigoBarra").value;
                window.location.href = "http://localhost/3DAW/AV2/detalhesProduto.php?codigoBarra=" + codigoBarra;
            }
        </script>
    </head>
    <body>
        <div style="text-align:center;">
            <?php 
                $conn = new mysqli("localhost", "root", "", "dbav2");
                if ($conn->connect_error) {
                    die("Conexao falhou: " . $conn->connect_error);
                }

                $sql = "SELECT `codigoBarra`, `nome`, `categoria`, `preco`, `quantEstoque` FROM `produtos` WHERE `ativo` = 'sim'";

                $result = $conn->query($sql);
                echo "<br><br><p> Listar Produtos </p>";
                echo "<div onclick='Redirecionar();'>";
                if ($result->num_rows > 0) {
                    while ($linha = $result->fetch_assoc()) {
                        echo "<br>" . $linha["codigoBarra"] 
                            . "&nbsp;&nbsp;&nbsp;&nbsp; Nome: " . $linha["nome"]
                            . "&nbsp;&nbsp;&nbsp;&nbsp; categoria: " . $linha["categoria"]
                            . "&nbsp;&nbsp;&nbsp;&nbsp; preco: " . $linha["preco"]
                            . "&nbsp;&nbsp;&nbsp;&nbsp; estoque: " . $linha["quantEstoque"];
                        echo "<br><br>";
                    }
                    echo "</div>";
                }

            ?>
        </div>
    </body>
</html>