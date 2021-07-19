<?php include("principal.html");?>

<!DOCTYPE html>
<html>
    <head> 
        <script> 
			function ValidarCodigo(pCodigo) {
				if (pCodigo == "" || pCodigo == 0) {
					return false;
				} else{
					return true;
				}
			}
			function Mostrar() {
				let obj2Form = document.getElementById("listar");
				console.log("objForm2: " + document.getElementById("listar").innerText);
				let codigoBarra = document.getElementById("codigoBarra").value;
				

				let erro = 1;
				let msgErro = "";
			
				if (!ValidarCodigo(codigoBarra)) {
					msgErro += "Código de Barra invalido \n";
					erro = 0;
				}
				
				if(erro == 1){
					EnviarForm();
				} else{
					document.getElementById("mensagem").innerText = msgErro;
				}
				
			}

			function EnviarForm() {
				let xmlHttp = new XMLHttpRequest();
				let codigoBarra = document.getElementById("codigoBarra").value;
			
				xmlHttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							console.log("Retornou: " + this.responseText);
							document.getElementById("result").value = this.responseText;
						}
				}
				
				xmlHttp.open("GET", "http://localhost/3DAW/AV2/detalhesProduto.php?codigoBarra=" + codigoBarra, true);
				window.location.href = "http://localhost/3DAW/AV2/detalhesProduto.php?codigoBarra=" + codigoBarra;
				xmlHttp.send();
				console.log("Requisição enviada.");
			}
        </script>
    </head>
    <body>
        <br><br>
        <div style="text-align:center;">
            <p> Pesquisar Produto </p>
            <form action="" id="listar">
                Código de barras: <input type="codigo" id="codigoBarra">
                <br><br>
                <input type="button" value="Listar" onclick="Mostrar();">
            </form>

            <p id="mensagem"></p>
        </div>
</body>
</html>