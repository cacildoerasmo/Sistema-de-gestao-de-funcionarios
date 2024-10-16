<?php include 'indexFunc.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de funcionário</title>

    <script src="lib/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="cssEstilo/estiloCadFunc.css">-->
    <script src="js/bootstrap.min.js"></script>

    <style>
            
body{
    background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;

  }
  
  a {
            text-decoration: none;

            display: block;
            color: inherit; /* Garante que a cor do texto é herdada */
        }
      a:hover{
    text-decoration: none;
    color: inherit;
}
  .btn-info{
      border-radius: 4px;
      -moz-border-radius: 4px;
      -webkit-border-radius: 4px;
      box-shadow: 1px 1px 2px teal;
      -moz-box-shadow: 1px 1px 2px teal;
      -webkit-box-shadow: 1px 1px 2px teal;
      width: 135px;
      height: 35px;
      position: relative;
      left: 1px;
      top: 20px; 
  }
  
  form{
      position: absolute;
      top: 5vh;
      left: 55vh;
      background-color: #fff;
      padding: 30px;
      width: 960px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
  }
  
  .form-control:focus{
      border-color: lightseagreen;
      -webkit-box-shadow: none;
      box-shadow: none;
     
  }
  
  h3{
      color: lightseagreen;
  }
  
  hr{
      background-color: lightseagreen;
  }


    </style>

</head>
<body>
<!--
<label for="startTime">Hora de Início:</label> 
<input type="text" id="startTime" placeholder="HH:MM" oninput="calcularDiferenca()"> <br><br>
<label for="endTime">Hora de Término:</label>
<input type="text" id="endTime" placeholder="HH:MM" oninput="calcularDiferenca()"> <br><br>-->
<div id="resultados">
</div>
 <script> 
 function calcularDiferenca() { // Obtém os valores digitados pelo usuário 
var horaInicioString = document.getElementById('horainicio').value; 
var horaTerminoString = document.getElementById('horatermino').value; // Verifica se ambos os campos foram preenchidos 
if (horaInicioString && horaTerminoString) { // Converte as strings em objetos de data
    var horaInicio = new Date('2024-04-28T' + horaInicioString + ':00'); 
    var horaTermino = new Date('2024-04-28T' + horaTerminoString + ':00'); // Calcula a diferença em milissegundos 
    var diferencaEmMilissegundos = horaTermino - horaInicio; // Converte a diferença para horas e minutos 
    var horas = Math.floor(diferencaEmMilissegundos / 3600000); // 1 hora = 3600000 milissegundos
     var minutos = Math.floor((diferencaEmMilissegundos % 3600000) / 60000); // 1 minuto = 60000 milissegundos // Exibe a diferença 
   
     document.getElementById('resultado').value =  + horas + ' horas e ' + minutos + ' minutos.'; 
     
    } else { // Se algum 

document.getElementById('resultado').value = ''; } } 
document.getElementById('meuFormulario').addEventListener('submit', function() {
    var resultadoInput = document.getElementById('resultado');
    var resultadoHiddenInput = document.getElementById('resultado_hidden');
    resultadoHiddenInput.value = resultadoInput.value;
});
</script> 


<section class="container-fluid bg">
    <section class="row justify-content-center">
    <!--<img src="img/close.png">-->
<form id="meuFormulario" method="post" action="proc_HoraTrabalhada.php">
    

    <h3>Horas Trabalhadas</h3>
    <hr>
    <div class="form-row">
     <div class="col-5"> 
        <label for="nome">Nome</label> 
    <input type="text" name="nome" class="form-control form-control-sm" id="nome" placeholder="Nome Completo" maxlength="40" required autofocus> 
 </div>
 

 <div class="col-3"> 
    <label for="inputDate">Data</label>
     <input type="date" name="dataHoje" class="form-control form-control-sm" id="inputDate"> 
    </div>

    <div class="col-4"> 
        <label for="bicadastro">Hora de Inicio</label>
         <input type="text" name="horainicio" class="form-control form-control-sm" id="horainicio" placeholder="HH:MM" oninput="calcularDiferenca()" maxlength="40" required> 
        </div>

        <div class="col"> 
           <label for="estadosivil">Hora de Termino</label>
             <input type="text" name="horatermino" class="form-control form-control-sm" id="horatermino" placeholder="HH:MM" oninput="calcularDiferenca()" maxlength="40" required> 
            </div> 

            <div class="col"> 
           <label for="estadosivil">Horas Trabalhadas</label>
             <input type="text" name="horatrabalhada" class="form-control form-control-sm" id="resultado" maxlength="40" required readonly> 
             <input type="hidden" name="horastrabalhadas_hidden" id="resultado_hidden">
            </div> 
             
            <div class="col"> 
           <label for="estadosivil">Tipo de aula</label>
             <input type="text" name="tipoaula" class="form-control form-control-sm" id="estadosivil" placeholder="Como aula, reuniao..." maxlength="40" required> 
            </div> 
             

                    <div class="col"> 
            <label for="profissao">Departamento</label>
             <input type="text" name="departamento" class="form-control form-control-sm" id="departamento" maxlength="40" required> 
            </div>   

                   <!-- <div class="col-3">
                        <label for="example-tel-input">Telefone</label>
                        <input class="form-control form-control-sm" name="telefone" type="tel"  id="example-tel-input" maxlength="40" required>
                    </div>-->

                        <div class="col-8">
        Selecione o Documento
        <input type="file" class="form-control-file" name="documento" id="file" onchange="getImagePreview(event)"/>
        <div id="preview"></div>
      
    </div>
    <div class="col-5">
<label>Comentário</label>
<textarea class="form-control" name="comentario" rows="3" ></textarea>
</div>

 <div class="col-7">
 <label for="codigo">C&oacute;digo</label>
  <input type="text" name="codigo" class="form-control form-control-sm" style="width:200px;"id="codigo" maxlength="20" size="20" required>
 </div>
 </div>

 <button type="submit" name="submit" class="btn btn-info">Submeter</button>

 </form>
 
 
</section>
</section>



</body>
</html>