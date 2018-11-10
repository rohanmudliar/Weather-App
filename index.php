<?php error_reporting(0);
    $weather = '';
    if($_GET["city"]) {
        $_GET["city"] = str_replace(" ","",$_GET["city"]);

        $file_headers = @get_headers("https://www.weather-forecast.com/locations/".$_GET["city"]."/forecasts/latest");

        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $exists = false;
        } else {
            $pageContents  = file_get_contents("https://www.weather-forecast.com/locations/".$_GET["city"]."/forecasts/latest");

            $pageArray = explode('Weather (4&ndash;7 days)</h2></span><p class="b-forecast__table-description-content"><span class="phrase">', $pageContents);

            $secondArray = explode('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9"><span class="b-forecast__table-description-title"><h2>10 Day', $pageArray[1]);

            $weather= $secondArray[0];
        }
    }
     ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Weather App
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>

<body>

    <div class="container">
        <div class="intro">
            <h1>What's The Weather?</h1>
        </div>
        <div class="desp">
            <h5>Enter the name of a city.</h5>
        </div>
        <form>
            <input class="form-control form-control-lg width" type="text" name="city" placeholder="Eg: Mumbai" autocomplete="off" autofocus value="<?php echo $_GET['city'] ?>">
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="data">
        <?php
            if($weather) {
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                Please enter a city name.
              </div>';
            }
            ?>
        </div>

    </div>

</body>

</html>