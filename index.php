<?php
if(isset($_POST['submit'])){
    $Pincode = $_POST['pincode'];
    $date = date("d-m-y");

    $link = "https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/calendarByPin?pincode=";
    $link .= $Pincode;
    $link .= "&date=";
    $link .= $date;


    $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => $link,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.93 Safari/537.36'
  ),
));

$response = curl_exec($curl);
$response = json_decode($response, true);
// echo "<pre>";
// print_r($response);
curl_close($curl);
// echo $response;

}
?>

<form action="" method="POST">
<input type="number" name="pincode">
<input type="submit" value="Submit" name="submit">
</form>
<ul>
<?php
foreach($response['centers'] as $list){
    foreach($list['sessions'] as $sessions){
    echo "
    <li>".$list['name']."</li>
    <li>".$list['center_id']."</li>
    <li>".$list['address']."</li>
    <li>".$sessions['vaccine']."</li>
    <li>".$sessions['min_age_limit']."</li>
    <li>".$sessions['date']."</li>
    <li>".$sessions['available_capacity']."</li>
    <br>
    ";
    }
}
?>
</ul>