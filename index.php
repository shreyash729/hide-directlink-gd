<?php

error_reporting(0);
function get_http_response_code($redirect){
    $headers = get_headers($redirect);
    return substr($headers[0], 9, 3);
  }function my_simple_crypt($string, $action = 'e'){
    $secret_key     = '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'; //your key
    $secret_iv      = '262040730229-odhf3ndd5553ltvdtup0kemtbbuocppk.apps.googleusercontent.com'; //your iv
    $output         = false;
    $encrypt_method = "AES-256-CBC";
    $key            = hash('sha256', $secret_key);
    $iv             = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e'){
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
      }else if ($action == 'd'){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
    return $output;
  }if ($_GET['id'] != ""){
    $id                     = $_GET['id'];
    $ori                    = my_simple_crypt($id, 'd');
    $apikey                 = 'AIzaSyDE6tt5ViBJRJlqSbi-bb1AAupcV8LcOr4'; //your api key
    $url                    = "https://www.googleapis.com/drive/v2/files/$ori?supportsTeamDrives=true&key=$apikey";
    $redirect               = "https://www.googleapis.com/drive/v3/files/$ori?supportsTeamDrives=true&alt=media&key=$apikey";
    $json                   = file_get_contents($url);
    $data                   = json_decode($json, true);
    $get_http_response_code = get_http_response_code($redirect);
    $name                   = $data["title"];
    $mime                   = $data["mimeType"];
    if ($get_http_response_code == 403){
        header('Content-Type: application/json');
        http_response_code(403);
        $error = array(
        	'error' => true,
                'code' => 403,
                'reason' => 'downloadQuotaExceeded',
                'message' => 'The download quota for this file has been exceeded.'
            );
        echo json_encode($error);
      }else{
        header("Content-Type: $mime");
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"$name\"");
        http_response_code(200);
        echo readfile($redirect);
      }
  }else{
    header('Content-Type: application/json');
    http_response_code(404);
    $error = array(
        "error" => true,
        "message" => "Missing id"
    );
    echo json_encode($error);
  }
?>
