 <!DOCTYPE html><head><meta charset="utf-8"><title>NordVpn Account Checker</title>  <meta name="author" content="N2oiD_ID"><meta name="robots" content="noindex, nofollow"><meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"><!-- Icons --><!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers --><link rel="icon" href="img/6740cd7303baffee0ba4b9de5922b886.png"><!-- Stylesheets --><!-- Web fonts --><link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700"><!-- Bootstrap and CSS framework --><link rel="stylesheet" href="assets/css/bootstrap.min.css"><link rel="stylesheet" id="css-main" href="assets/css/oneui.css"><link rel="stylesheet" type="text/css" href="dist/sweetalert.css"><script type="text/javascript" src="dist/sweetalert.min.js"></script><!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: --><!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/flat.min.css"> --><!-- END Stylesheets --></head><body><br><div class="container"><div class="row"><div class="panel panel-info">  <div class="panel-heading">  NordVpn Checker de Cuentas  <input type="file" id="dataku" onchange="loadFileAsText(this.id,'mailpass')" style="display:none">  <label class="label label-danger" for="dataku"><i class="fa fa-list"></i> Cargar Lista</label>  </div>  <div class="panel-body">  <textarea name="mailpass" id="mailpass" placeholder="Correo|Clave" class="form-control" rows="7"></textarea><br><button type="button" class="btn btn-info" id="submit">Iniciar</button><button type="button" class="btn btn-default" id="stop">Detener</button>&nbsp;<input name="delim" id="delim" style="text-align: center;display:inline;width: 40px;margin-right: 8px;padding: 4px;" value="|" class="form-control" disabled="">  <span id="checkStatus" style="color:limegreen"></span>  </div></div><div class="block block-bordered"> <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs"><li class="active"><a href="#btabs-alt-static-justified-live"><i class="fa fa-heart"></i> Live [login] <span class="badge badge-info" id="acc_live_count" style="color:white">0</span>&nbsp;&nbsp;</a></li><li class=""><a href="#btabs-alt-static-justified-die"><i class="fa fa-times"></i> Die <span class="badge badge-danger" id="acc_die_count" style="color:white">0</span>&nbsp;&nbsp;</a></li><li class=""><a href="#btabs-alt-static-justified-anon132"><i class="fa fa-question"></i> Uncheck <span class="badge badge-light" id="wrong_count" style="color:white">0</span>&nbsp;&nbsp;</a></li><li class=""><a href="#btabs-alt-static-justified-sock"><i class="fa fa-signal"></i> Sock Die <span class="badge badge-warning" id="bad_count" style="color:white">0</span>&nbsp;&nbsp;</a></li><li class=""><a href="#btabs-alt-static-justified-anon"><i class="fa fa-exclamation-triangle"></i> Unknown <span class="badge badge-success" id="" style="color:white">0</span>&nbsp;&nbsp;</a></li></li> </ul><!-- RESULT --><div class="block-content tab-content"><div class="tab-pane active" id="btabs-alt-static-justified-live" style="padding-top: 0px!important;"><div class="block-content block-content-full" id="acc_live"></div></div><div class="tab-pane" id="btabs-alt-static-justified-die"><div class="block-content block-content-full" id="acc_die" style="padding-top: 0px!important;"></div></div><div class="tab-pane" id="btabs-alt-static-justified-anon132"><div class="block-content block-content-full" id="wrong" style="padding-top: 0px!important;"></div></div><div class="tab-pane" id="btabs-alt-static-justified-sock"><div class="block-content block-content-full" id="sock_die" style="padding-top: 0px!important;"></div></div> </div> <!-- AND RESULT --></div></div></div> </div> <br> <br> <br> <br> <br> <br><script type="text/javascript" src="js/jquery.js"></script><script type="text/javascript" src="js/jquery-ui.js"></script><script type="text/javascript" src="js/jquery.chk.js"></script><script src="assets/js/core/jquery.min.js"></script><script src="assets/js/core/bootstrap.min.js"></script><script src="assets/js/app.js"></script><script type="text/javascript">$(document).ready(function() {$('#live').click(function() {$('#acc_live').toggle(1000);});$('#die').click(function() {$('#acc_die').toggle(1000);});$('#sock').click(function() {$('#sock_die').toggle(1000);});$('#wrong-hide').click(function() {$('#wrong').toggle(1000);});});</script><script>function loadFileAsText(input,textarea){var fileToLoad = document.getElementById(input).files[0];var fileReader = new FileReader();fileReader.onload = function(fileLoadedEvent){  var textFromFileLoaded = fileLoadedEvent.target.result;  document.getElementById(textarea).value = textFromFileLoaded;};fileReader.readAsText(fileToLoad, "UTF-8");}</script></body></html>