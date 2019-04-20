<?php
  require('simple_html_dom.php');

  $city = "";
  $result = "";
  $userInput = "";


  if($_GET) {

      $userInput = $_GET['city'];

      $city = preg_replace("/[\s_]/", "-", $_GET['city']);

      $link = "https://www.weather-forecast.com/locations/".$city."/forecasts/latest";

      $file_headers = @get_headers($link);


    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

        $result = "<div class='alert alert-danger'> The city you entered could not be found</div>";
    }
    else {

      $forecastPage = file_get_contents($link);

      $pageArray = explode('Weather Today </h2>(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

      if(sizeof($pageArray) > 1) {

        $secondPageArray = explode ('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9"><span class="b-forecast__table-description-title"><h2>', $pageArray[1]);

        if(sizeof($secondPageArray) > 1) {

          $result = "<div class='alert alert-info'>".$secondPageArray[0]."</div>";

        } else {

          $result = "<div class='alert alert-danger'> Something went wrong </div>";
        }

      } else {

        $result = "<div class='alert alert-danger'> Something went wrong </div>";
      }
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
  }




</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Weather scraper</title>
  <meta charset="utf-8">
  <meta name="description" content="Weather scraper">
  <meta name="keywords" content="HTML, CSS, Bootstrap, PHP, weather scraper">
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

      </form>

    </div>

    <div id="result"> <? echo $result; ?></div>


  </div>


  <script>

  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
