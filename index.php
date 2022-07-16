<style>
    <style>
/* CSS */
.button-50 {
  appearance: button;
  background-color: #000;
  background-image: none;
  border: 1px solid #000;
  border-radius: 4px;
  box-shadow: #fff 4px 4px 0 0,#000 4px 4px 0 1px;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
  font-size: 14px;
  font-weight: 400;
  line-height: 20px;
  margin: 0 5px 10px 0;
  overflow: visible;
  padding: 12px 40px;
  text-align: center;
  text-transform: none;
  touch-action: manipulation;
  user-select: none;
  -webkit-user-select: none;
  vertical-align: middle;
  white-space: nowrap;
}

.button-50:focus {
  text-decoration: none;
}

.button-50:hover {
  text-decoration: none;
}
.button-50:hover {
  text-decoration: none;
}

.button-50:active {
  box-shadow: rgba(0, 0, 0, .125) 0 3px 5px inset;
  outline: 0;
}

.button-50:not([disabled]):active {
  box-shadow: #fff 2px 2px 0 0, #000 2px 2px 0 1px;
  transform: translate(2px, 2px);
}

@media (min-width: 768px) {
  .button-50 {
    padding: 12px 50px;
  }
}
</style>
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
    ?>
<?php if ($get_http_response_code == 403): ?>
        header('Content-Type: application/json');
        http_response_code(403);
        $error = array(
        	'error' => true,
                'code' => 403,
                'reason' => 'downloadQuotaExceeded',
                'message' => 'The download quota for this file has been exceeded.'
            );
        echo json_encode($error);
<?php endif ?>
<?php if ($get_http_response_code == 200): ?>
        <a href="<?php echo readfile($redirect);?>"><button  id="dwnbtn" onclick="disableButton(this)" class="button-50" disabled></button></a>
<br>
<p style="font-size: 12px;">CREATED WITH LOVE BY <a href="mailto:coding729@gmail,com">CODER729</a></p>
</center></div>
 <div class="ad-hm-slot">
    <div id="hm-billboard-3" class="ad-slot">
    </div></div>
<script type="text/javascript">
            function disableButton(btn) {
                document.getElementById(btn.id).disabled = true;
                
            }
        </script>
    <script>
   var downloadButton = document.getElementById("dwnbtn");
var counter = 10;

downloadButton.innerHTML = "Validating link";
var id;
id = setInterval(function() {
    counter--;
    if(counter < 0) {
        downloadButton.innerHTML = "🔥DOWNLOAD NOW🔥";
        downloadButton.removeAttribute('disabled');
        clearInterval(id);
    } else {
        downloadButton.innerHTML = "Validating-link <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>";
    }
}, 1000);

</script>
        
      
<?php endif ?>
 

