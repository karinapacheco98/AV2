<?php include("principal.html");?>

<!DOCTYPE html>
    <html>
    <head> 
        <script> 
			function ValidarCodigo(pCodigo) {
				if (pCodigo == "" || pCodigo <= 0) {
					return false;
				} else{
					return true;
				}
			}

           	function Excluir() {
				let obj2Form= document.getElementById("excluir");
				console.log("objForm2: " + document.getElementById("excluir").innerText);
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
							document.getElementById("msgErro").value = this.responseText;
						}
				}
				xmlHttp.open("GET", "http://localhost/3DAW/AV2/confirmarExclusao.php?codigoBarra=" + codigoBarra, true);
				window.location.href = "http://localhost/3DAW/AV2/confirmarExclusao.php?codigoBarra=" + codigoBarra;

				xmlHttp.send();
				console.log("Requisição enviada.");
			}
        </script>
    <body>
        <br><br>
        <div style="text-align:center;">
            <p> Excluir Produto </p>
            <form action="" id="excluir" method="post">
                Código de barras: <input type="codigo" id="codigoBarra">
                <br><br>
                <input type="button" value="Excluir" onclick="Excluir();">
            </form>

			<p id="mensagem"> </p>
        </div>
</body>
</html>