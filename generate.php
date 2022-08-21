<?php
error_reporting(0);
function getDriveID($url)
{
    $filter1 = preg_match('/drive\.google\.com\/open\?id\=(.*)/', $url, $fileid1);
    $filter2 = preg_match('/drive\.google\.com\/file\/d\/(.*?)\//', $url, $fileid2);
    $filter3 = preg_match('/drive\.google\.com\/uc\?id\=(.*?)\&/', $url, $fileid3);
    if ($filter1) {
        $fileid = $fileid1[1];
    } else if ($filter2) {
        $fileid = $fileid2[1];
    } else if ($filter3) {
        $fileid = $fileid3[1];
    } else {
        $fileid = null;
    }
    
    return ($fileid);
}
function my_simple_crypt($string, $action = 'e')
{
    $secret_key     = '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'; //your key
    $secret_iv      = '262040730229-odhf3ndd5553ltvdtup0kemtbbuocppk.apps.googleusercontent.com'; //your iv
    $output         = false;
    $encrypt_method = "AES-256-CBC";
    $key            = hash('sha256', $secret_key);
    $iv             = substr(hash('sha256', $secret_iv), 0, 16);
    if ($action == 'e') {
        $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    } else if ($action == 'd') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
if ($_POST['submit'] != "") {
    $url      = $_POST['url'];
    $link     = getDriveID($url);
    $iframeid = my_simple_crypt($link);
}
function encrypt_url($string) {
  $keyi = "shreyash";
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($keyi, ($i % strlen($keyi))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}

  $sh='https://' . $_SERVER['SERVER_NAME'] . '?id=' . $iframeid;
  $shortapi="http://shorthit.ga/st?api=1cd6b57d95e28000f9431a9114d63e9d85e341e2&url=";
  $encrypt=encrypt_url($sh);
  $dl=$shortapi.$encrypt;      
?>
<!doctype html>
<html lang="en">
<head>
    <style>
      
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
  <meta charset="utf-8" />
   <title>FilmHit-Drive Download Generator</title>
     <link rel="stylesheet" href="https://bootswatch.com/4/litera/bootstrap.min.css">
    <script async src="https://cdn.hooliganmedia.com/hmads0.js"></script>
</head>
<body>

        <center><h1>FilmHit-Drive Link Generator</h1></center>
        <br />
<div class='container-fluid' style="max-width: 1080px !important;">
<div class='row'>
    <div class="col-md-12">
        <div class='card' style='margin:50px;'>
            <h5 class="card-header">Convert</h5>
            <div class='card-body'>
                <div class="form-group">
                    <center> 
			    <span class="input">
                    <form action="" method="POST">
                        
            <input type="text" size="80"placeholder="Enter google drive public link" name="url" value="<?php
if ($iframeid) {
    echo $_POST['url'];
} else {
    echo "";
}
											      ?>"/><span></span></span><br><br>
				    <div class="ad-hm-slot">
    <div id="hm-billboard-1" class="ad-slot">
    </div>
</div><br><br>
            <button class="button-50" input type="submit" value="Generate" name="submit" >Submit </button>
        </form>
        <div id="myElement"></div>
                        </center>

<div class="col-md-12">
        <div class='card' style='margin:40px;'>
            <h5 class="card-header">Generated Link</h5>
            <div class="card-body">
                <h6 class="text-muted"> Copy Link </h6>
		<textarea class="form-control" rows="6" readonly>
<?php
if ($iframeid) {
    echo 'https://' . $_SERVER['SERVER_NAME'] . '?id=' . $iframeid . '</textarea>';
?></textarea><br/>
        <center>
        <h2>CREATED WITH LOVE BY CODER729</h2>
		<br>
				    <div class="ad-hm-slot">
    <div id="hm-billboard-2" class="ad-slot">
    </div>
</div><br>
        <a href="<?php
    echo 'https://' . $_SERVER['SERVER_NAME'] . '?id=' . $iframeid;
?>"><button class="button-50">Download Now</button></a></center>
        <?php
}
?>
</textarea>
</div>
    </div>


        <br><br>
  <section class="footme">
	  <center> Google Drive Direct Link Generator <a id="nochange" href="mailto:coding729@gmail.com">CODER729</a></center>
  </section>
</body>
</html>
