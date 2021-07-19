<?php include("principal.html");?>

<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8">
        <title> ALTERAR PRODUTO </title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
		<script>
            function Alterar(){
                let xmlHttp = new XMLHttpRequest();
                let modal = document.querySelector('.modalAlterar');
                modal.style.display='none';

                let codigoBarra = document.getElementById("codigoBarra").value;

                xmlHttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
							console.log("Retornou: " + this.responseText);
							document.getElementById("msgErro").value = this.responseText;
						}
				}
					xmlHttp.open("GET", "http://localhost/3DAW/AV2/alteracoes.php?codigoBarra=" + codigoBarra, true);
                    window.location.href = "http://localhost/3DAW/AV2/alteracoes.php?codigoBarra=" + codigoBarra;


					xmlHttp.send();
					console.log("Requisição enviada.");
            }

        </script>
    </head>
    <body> 
    <br><br>
        <div class="modalAlterar"> 
            <form action="" id="alterar">
                Código de barras: <input type="codigo" id="codigoBarra">
                <br><br>
                <input type="button" value="Alterar" onclick="Alterar();">
            </form>
        </div>

    </body>
</html>