<?php 
error_reporting(0);


$token = "EAAaZBZAjgVbowBACzaXDeHmFUZCS5Rcj76ziIBmctu1PVOC6MXeKvh190yzhpTmmZCwFIy9WD8ii4BM1ZCyOSM8iYXkygUiNiDhmiFz9ludtJFtYxms8PEIrdISMl1ZBApNWEwbMoiHUwUAS8kcztkj4zkbJcgKHkkoAXqpwF1JwZDZD";

$res;
$gender_welcome;

function httpPost($url,$param) {
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HEADER, false); 
    $output = curl_exec($ch);
    curl_close($ch);
    $dc = json_decode($output);
    if($param) {
        $fs = $dc[$param];
        return $fs; //$res = httpPost($url, "first_name");
    }else {
        return $dc;
    }
    
}

if($_REQUEST['user'] && $_REQUEST['scheduling']) {
    $url = 'https://graph.facebook.com/v2.6/'.$_REQUEST['user'].'?fields=first_name,last_name,profile_pic,locale,timezone,gender&access_token='.$token;
    $res = httpPost($url); // $res->first_name;
    
    echo "<script>console.log(".$_REQUEST['user'].")</script>";
    
    echo "<script>console.log(".json_encode($res).")</script>";
    
    
    
    if($res->gender == "male") {
        $gender_welcome = "Bienvenido";
        
    }elseif($res->gender == "female") {
        $gender_welcome = "Bienvenida";
    }
}


//echo $answer."<br>";

?>

<!doctype html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    
</head>
    <body>
        <nav style="height:230px" class="my_navbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-xs-6 col-sm-6">
                        <h1 style="margin-top:50px; color:white;">Anastasia</h1>
                        <h3 style="margin-top:50px; color:white;">demo v0.1</h3>
                    </div>
                    
                    <div class="col-md-8 col-xs-6 col-sm-6">
                        <h3 style="text-align:right;margin-top:35px; color:white;"><?php echo $gender_welcome ." ".$res->first_name ?> <img style="width: 100px; height: 100px;" src="<?php echo $res->profile_pic ?>"></img> </h3>
                    </div>
                </div>
            </div>
        </nav>
        
        
        <div class="container">
            <i style="cursor: pointer;position: fixed; top: 40%; right: 0px; color:#F44336;" onclick="openModal()" onmouseover="bigButton(this)" onmouseout="smallButton(this)" class="fa fa-plus-circle fa-4x" aria-hidden="true"></i>
            
            
            <div class="jumbotron">
              <h1>Sin medicamentos</h1>
            </div>
            
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
           
        </div>
        
        
        
        <div class="fbottom">
            
        </div>
        
                <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nuevo medicamento</h4>
              </div>
              <div class="modal-body">
                  
                <form id="newDrug">
                    <div style="margin-bottom:5px" class="input-group">
                      <span class="input-group-addon"><i class="fa fa-medkit fa-fw"></i></span>
                      <input id="drugname" class="form-control" required type="text" placeholder="Nombre del medicamento">
                    </div>
                    
                    Presentación
                    <div style="margin-bottom:5px" class="input-group">
                      <span class="input-group-addon"><i class="fa fa-medkit fa-fw"></i></span>
                        <select style="height:30px">
                          <option value="pastillas">Pastillas</option>
                          <option value="pildoras">Pildoras</option>
                          <option value="gotas">Gotas</option>
                          <option value="jarabe">Jarabe</option>
                        </select>
                    </div>
                    
                    Dosificación
                    <div style="margin-bottom:5px" class="input-group">
                      <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                      <input id="quantity" class="form-control" required type="number" value="1" min="1">
                    </div>
                    
                    
                    Frecuencia
                    <div style="margin-bottom:5px" class="input-group">
                      <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                      <input id="freq" class="form-control" required type="number" value="8" min="1">
                    </div>
                    
                     Intervalo de tiempo
                    <div style="margin-bottom:5px" class="input-group">
                      <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                      <input id="interval" class="form-control" required type="number" value="8" min="1">
                    </div>
                    
                    
                    <br>
                       <center><h2>Fecha y hora de inicio</h2></center>
                    <div class="form-group">
                        <div class="row">
                             <div class="col-md-8">
                                <div id="datetimepicker"></div>
                            </div>
                        </div>
                    </div>
          

                    <br>
                    <input class="btn btn-primary btn-block" type="submit" value="Submit"/>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
              </div>
            </div>
          </div>
        </div>
        
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
        <script src="bootstrap-transition.js"></script>
        <script src="bootstrap-collapse.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/js/bootstrap-datetimepicker.min.js"></script>
        
        <script>
            function bigButton(el) {
                $(el).attr("class", "fa fa-plus-circle fa-5x")    
            }
            function smallButton(el) {
                $(el).attr("class", "fa fa-plus-circle fa-4x")    
            }
            
            function openModal(e) {
                $('#myModal').modal('show')
            }
            
            $('#newDrug').submit(function(){
                $(this).find(':input[type=submit]').prop('disabled', true);
            });
            
            $(document).ready(function() {
                
                
                $('#datetimepicker').datetimepicker({
                    stepping: 30,
                    inline: true,
                    sideBySide: true,
                    format: "DD-MM-YYYY hh:mm A",
                    icons: {
                        time: "fa fa-clock-o",
                        date: "fa fa-calendar",
                        up: "fa fa-arrow-up",
                        down: "fa fa-arrow-down"
                    },
                    minDate: moment().format("MM-DD-YYYY"),
                });
                
            });
        </script>
    </body>
</html>