<?php include("principal.html");?>

<!DOCTYPE html>
<html> 
    <head>
        <script> 
            function Excluir(){
				let xmlHttp = new XMLHttpRequest();
				let codigoBarra = document.getElementById("codigoBarra").value;
			
				xmlHttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							console.log("Retornou: " + this.responseText);
							document.getElementById("msgErro").value = this.responseText;
						}
				}
				xmlHttp.open("GET", "http://localhost/3DAW/AV2/excluir.php?codigoBarra=" + codigoBarra, true);
				window.location.href = "http://localhost/3DAW/AV2/excluir.php?codigoBarra=" + codigoBarra;

				xmlHttp.send();
				console.log("Requisição enviada.");
            }

            function Voltar(){
                window.location.href = "http://localhost/3DAW/AV2/excluirProduto.php";

            }
        </script>
    </head>
</html>

<?php
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

                    echo "<h4><br>&nbsp;&nbsp;&nbsp;&nbsp;Código de barra: " . $linha["codigoBarra"]
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
                    echo "<br><br></h4>";
                }
                echo "<h4> Deseja realmente  excluir o Produto? </h4>";
                echo "<input type='submit' value='SIM' onclick='Excluir();'>";
                echo "<input type='submit' value='NAO' onclick='Voltar();'>";

            } else{
                echo "<h4><br><br>Produto nao encontrado.</h4>";
            }
        } else {
            $msgErro = "formulário com erro";
        }
    }
?>
