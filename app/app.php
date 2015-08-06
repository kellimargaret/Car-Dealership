<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__ . '/../src/Car.php';

    $app = new Silex\Application();
    $app->get("/", function() {
        return "
            <!DOCTYPE html>
            <html>
            <head>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
                <title>Find a Car</title>
            </head>
            <body>
                <div class='container'>
                    <h1>Find a Car!</h1>
                    <form action='/car_results'>
                        <div class='form-group'>
                            <label for='price'>Enter Maximum Price:</label>
                            <input id='price' name='price' class='form-control'type='number'>
                        </div>
                        <div class='form-group'>
                            <label for='miles'>Enter Maximum Mileage:</label>
                            <input id='miles' name='miles' class='form-control' type='number'>
                        </div>
                        <button type='submit' class='btn-success'>Submit</button>
                    </form>
                </div>
            </body>
            </html>
            ";
    });

    $app->get("/car_results", function() {
        $first_car = new Car("2014 Porsche 911", 7864, 114991, "images/porsche.jpg");
        $second_car = new Car("2011 Ford F450", 14000, 55995, "images/ford.jpeg");
        $third_car = new Car("2013 Lexus RX 350", 20000, 44700, "images/lexus.jpg");
        $fourth_car = new Car("Mercedes Benz CLS550", 37979, 39900, "images/mercedes.jpg");
        $cars = array($first_car, $second_car, $third_car, $fourth_car);
        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ($car->worthBuying($_GET["price"], $_GET["miles"])) {
                array_push($cars_matching_search, $car);
            }
        }
        $output = "";
        foreach ($cars_matching_search as $car)
        {
            $new_price = $car->getPrice();
            $miles = $car->getMiles();
            $make_model = $car->getMake_Model();
            $picture = $car->getPicture();
            $output = $output . "
                    <li> $make_model </li>
                    <li> <img src='$picture'></li>
                    <ul>
                          <li> $$new_price </li>
                          <li> $miles </li>
                    </ul>
        ";
        }
        if (empty($cars_matching_search))
        {
            $output = 'We have no cars for you!';
        }
        return "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Your Car Dealership's Homepage</title>
                <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
            </head>
            <body>
                <div class='container'>
                    <h1>Your Car Dealership</h1>
                    <ul>
                        $output
                    </ul>
                </div>
            </body>
            </html>
        ";
    });



    return $app;

?>
