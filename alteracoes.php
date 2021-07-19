<?php include("principal.html"); 
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
            $sql = "SELECT * FROM `produtos` WHERE `codigoBarra` = '$codigoBarra';";
            
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

<!DOCTYPE html>
<html> 
    <head> 
    <link rel="stylesheet" type="text/css" href="estilo.css">
		<script>
			function ValidarNome(pNome) {
				if (pNome == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarCodigo(pCodigo) {
				if (pCodigo == "" || pCodigo <= 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarFab(pFab) {
				if (pFab == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarCat(pCat) {
				if (pCat == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarTipo(pTipo) {
				if (pTipo == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarPreco(pPreco) {
				if (pPreco == "" || pPreco <= 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarQuant(pQuant) {
				if (pQuant == "" || pQuant < 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarPeso(pPeso) {
				if (pPeso == "" || pPeso <= 0) {
					return false;
				} else{
					return true;
				}
			}
			function ValidarDesc(pDesc) {
				if (pDesc == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarImg(pImg) {
				if (pImg == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarInc(pInc) {
				if (pInc == "") {
					return false;
				} else{
					return true;
				}
			}
			function ValidarAtivo(pAtivo) {
				if (pAtivo == "") {
					return false;
				} else{
					return true;
				}
			}

			function ValidaForm() {
				let obj2Form = document.getElementById("cadastro");
				console.log("objForm2: " + document.getElementById("cadastro").innerText);
				let nome = document.getElementById("nome").value;
				let codigoBarra = document.getElementById("codigoBarra").value;
				let fabricante = document.getElementById("fabricante").value;
				let categoria = document.getElementById("categoria").value;
				let tipo = document.getElementById("tipo").value;
				let preco = document.getElementById("preco").value;
				let quantEstoque = document.getElementById("quantEstoque").value;
				let peso = document.getElementById("peso").value;
				let descricao = document.getElementById("descricao").value;
				let imagem = document.getElementById("imagem").value;
				let dataInclusao = document.getElementById("dataInclusao").value;
				let ativo = document.getElementById("ativo").value;

				let erro = 1;
				let msgErro = "";
			
				if (!ValidarNome(nome)) {
					msgErro += "nome nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarCodigo(codigoBarra)) {
					msgErro += "Código de Barra invalido \n";
					erro = 0;
				}
				if (!ValidarFab(fabricante)) {
					msgErro += "Fabricante nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarCat(categoria)) {
					msgErro += "Categoria invalido \n";
					erro = 0;
				}
				if (!ValidarTipo(tipo)) {
					msgErro += "Tipo nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarPreco(preco)) {
					msgErro += "Preço invalido \n";
					erro = 0;
				}
				if (!ValidarQuant(quantEstoque)) {
					msgErro += "Quantidade em estoque nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarPeso(peso)) {
					msgErro += "Peso invalido \n";
					erro = 0;
				}
				if (!ValidarDesc(descricao)) {
					msgErro += "Descrição nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarInc(dataInclusao)) {
					msgErro += "Data de Inclusão invalido \n";
					erro = 0;
				}
				if (!ValidarAtivo(ativo)) {
					msgErro += "Ativo nao pode ser vazio \n";
					erro = 0;
				}
				if (!ValidarImg(imagem)) {
					msgErro += "Imagem invalido \n";
					erro = 0;
				}
				
				if(erro == 1){
					EnviarForm();
				} else{
					document.getElementById("mensagem").innerText = msgErro;
					let modal = document.querySelector('.modalIncluir2');
					modal.style.display='block';
				}
			}

			function EnviarForm() {
				let xmlHttp = new XMLHttpRequest();
				let nome = document.getElementById("nome").value;
				let codigoBarra = document.getElementById("codigoBarra").value;
				let fabricante = document.getElementById("fabricante").value;
				let categoria = document.getElementById("categoria").value;
				let tipo = document.getElementById("tipo").value;
				let preco = document.getElementById("preco").value;
				let quantEstoque = document.getElementById("quantEstoque").value;
				let peso = document.getElementById("peso").value;
				let descricao = document.getElementById("descricao").value;
				let imagem = document.getElementById("imagem").value;
				let dataInclusao = document.getElementById("dataInclusao").value;
				let ativo = document.getElementById("ativo").value;

				xmlHttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							console.log("Retornou: " + this.responseText);
							document.getElementById("msgErro").value = this.responseText;
						}
				}
					xmlHttp.open("GET", "http://localhost/3DAW/AV2/alterar.php?nome=" + nome +
							"&codigoBarra=" + codigoBarra + "&fabricante=" + fabricante + "&categoria=" + categoria + "&tipo=" + tipo + "&preco=" + preco + "&quantEstoque=" + quantEstoque + "&peso=" + peso
							+ "&descricao=" + descricao + "&imagem=" + imagem + "&dataInclusao=" + dataInclusao + "&ativo=" + ativo, true);

					xmlHttp.send();
					console.log("Requisição enviada.");

					document.getElementById('nome').value='';
					document.getElementById('codigoBarra').value='';
					document.getElementById('fabricante').value='';
					document.getElementById('categoria').value='';
					document.getElementById('tipo').value='';
					document.getElementById('preco').value='';
					document.getElementById('quantEstoque').value='';
					document.getElementById('peso').value='';
					document.getElementById('descricao').value='';
					document.getElementById('imagem').value='';
					document.getElementById('dataInclusao').value='';
					document.getElementById('ativo').value='';

					let modal = document.querySelector('.modalIncluir1');
					modal.style.display='block';
			}

    </head>
    <body> 
    <div style="text-align:center;" id="formAlterar">
            <p> Alterar Produto </p>
            <form > 
                Código de barras: <input type="text" id="codigoBarra" value="<?php echo "$linha['codigoBarra']";?>" readondly>               
				<br><br>
                Nome: <input type="text" id="nome" value="<?php echo "$linha['nome']";?>">
				<br><br>
				Fabricante: <input type="text" id="fabricante" value="<?php echo "$linha['fabricante']";?>">
				<br><br>
				Categoria: <input type="text" id="categoria" value="<?php echo "$linha['categoria']";?>">
				<br><br>
				Tipo: <input type="text" id="tipo" value="<?php echo "$linha['tipo']";?>">
				<br><br>
				Preço: <input type="text" id="preco" value="<?php echo "$linha['preco']";?>">
				<br><br>
				Quantidade em estoque: <input type="text" id="quantEstoque" value="<?php echo "$linha['quantEstoque']";?>">
				<br><br>
				Peso(gramas): <input type="text" id="peso" value="<?php echo "$linha['peso']";?>">
				<br><br>
				descrição: <input type="text" id="descricao" value="<?php echo "$linha['descricao']";?>">
				<br><br>
				Imagem: <input type="text" id="imagem" value="<?php echo "$linha['imagem']";?>">
				<br><br>
				Data de inclusão: <input type="text" id="dataInclusao" value="<?php echo "$linha['dataInclusao']";?>">
				<br><br>
				Ativo: <input type="text" id="ativo" value="<?php echo "$linha['ativo']";?>">
				<br><br>
				<br><br>
				<input type="button" value="Incluir Produto" onclick="ValidaForm();">
            </form>
        </div>
    </body>
</html>

