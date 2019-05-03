<?php


  $city = "";
  $result = "";
  $userInput = "";
  $file_headers = "";


  if($_GET) {

      $userInput = $_GET['city'];

      $city = preg_replace("/[\s_]/", "+", $_GET['city']);

      $link = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=4cec5b9fe4b8b0c4c79d948024717c65";

      $urlContents = @file_get_contents($link);

      $file_headers = @get_headers($link);

      //using "true" flag for json_decode to return the data in a form of an associative array
      $weatherArray = json_decode($urlContents, true);

      $weather = "In ".$userInput." this days: ".$weatherArray['weather'][0]['description'].". ";
      $weather .="<br> Temperature: ".$weatherArray['main']['temp']."&#176; Celsius";
      $weather .= "<br>Humidity: ".$weatherArray['main']['humidity']."%";
      $weather .= "<br>Wind: ".$weatherArray['wind']['speed']." m/s";
      $weather .= "<br>Pressure: ".$weatherArray['main']['pressure']." hpa";

      //No reason to have it here. Might just get rid of one or the other
      $result = $weather;

      if(!$file_headers || (strpos($file_headers[0], "HTTP/1.1 404 Not Found") !== false)) {

        $result = "<div class='alert alert-danger'>The city you've entered could not be found</div>";
      } else {

        $result = "<div class='alert alert-info'>".$result."</div>";
      }





    }


?>

<style type="text/css">
  body {
  background: url('https://source.unsplash.com/UGQpaq08Igw/1920x1080') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
  }

  .title {
    margin-top: 150px;
  }

  #result {
    margin-top: 30px;
    display: flex;
    justify-content: center;
  }




</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Weather with API</title>
  <meta charset="utf-8">
  <meta name="description" content="Weather scraper">
  <meta name="keywords" content="HTML, CSS, Bootstrap, PHP, weather forecast using API">
  <meta name="author" content="Artem Streltsov">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

  <div class="container bg-transparent mt-5">

    <div class="col-xl-6 offset-xl-3 py-4 bg-transparent" id="header">

      <h1 class="text-center title"> What's The Weather?</h1>
      <p class="lead text-center"> <strong>Enter the name of a city.</strong> </p>


      <form>

        <div class="form-group d-flex justify-content-center py-3">
          <input name="city" type="text" id="city" placeholder="Eg. London, Tokyo" class="form-control w-75"
          value="<?php echo $userInput; ?>">
        </div>

        <div class="form-group d-flex justify-content-center">

          <button class="btn btn-primary btn-lg" type="submit"> Submit </button>

        </div>
      </form>

    </div>

    <div id="result"> <? echo $result; ?></div>


  </div>





</body>

</html>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
