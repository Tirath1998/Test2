<?php 
if (isset($_GET['code'])) {
  # code...
  $code = $_GET['code'];
	$context = $_GET['context'];
	$scope = $_GET['scope'];
}
else
{
  $code = "";
}
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://login.bigcommerce.com/oauth2/token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "client_id": "if337gf51vmw82opwq0hapvgnmhunz1",
  "client_secret": "50d3229b0cf9657f98f8de34d5d435b719d84a97d67e43bf2b1b8d4bc7abc30e",
  "code": "'.$code.'",
  "context": "'.$context.'",
  "scope": "'.$scope.'",
  "grant_type": "authorization_code",
  "redirect_uri": "https://staging.apiworx.net/APITesting/bigcommerce/callback.php"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
$unique = uniqid();
curl_close($curl);

$data = json_decode($response);
$data2 = $response;
$keyToCheck = "access_token";


//echo $checkBP;die;
$file_path = 'example_'.$unique.'.txt'; // Replace with your desired file path
// Open the file in write mode ('w' mode).
$file = fopen($file_path, 'w');
// Write data to the file.
fwrite($file, $response);
// Close the file.
fclose($file);


?>
<!DOCTYPE html>
<html>
<head>
  <title>
    
  </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    .blink_me {
  animation: blinker 2s linear infinite;
}

@keyframes blinker {
  50% {
    opacity: 0;
  }
}
  </style>
</head>
<body>
<center>
<img src="BIGC.png">
</center>

<h1 style="color: #53D453; text-align: center;" class="blink_me">BigConnect App installed successfully</h1>

<?php 
if (property_exists($data, $keyToCheck)) {
    ?>
      <h2 style="text-align: center;">Access Token <i class="fa fa-check" aria-hidden="true" style="color: #53D453;"></i></h2>
  <br>
<center>
  <div style="overflow-x:auto; width: 70%;">
<table border="1px" style="width: 70%; border-radius: 10px; ">
  <tr>
    <th>Access Token</th>

    <td><?php //echo json_decode($data2)->access_token; ?></td>
  </tr>
  <tr>
    <th>Scope</th>
    <td><?php //echo json_decode($data2)->scope; ?></td>
  </tr>
  <tr>
    <th>User ID</th>
    <td><?php //echo json_decode($data2)->user->id; ?></td>
  </tr>/
  <tr>
    <th>Username</th>
    <td><?php //echo json_decode($data2)->user->username; ?></td>
  </tr>/
  <tr>
    <th>Email</th>
    <td><?php //echo json_decode($data2)->user->email; ?></td>
  </tr>
  <tr>
    <th>Context</th>
    <td><?php //echo json_decode($data2)->context; ?></td>
  </tr>
  <tr>
    <th>Account UUID</th>
    <td><?php //echo json_decode($data2)->account_uuid; ?></td>
  </tr>
</table>
</div>

</center>
    <?php
} else {
    ?>
        <h2 style="text-align: center;">Access Token <i class="fa fa-close" style="color: red;"></i></h2>
        
    <?php
}
?>
<h3 style="text-align: center;">Please contact customer service for further assistance :- support@apiworx.com </h3>
</body>
</html>



