<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__ . '/../src/Car.php';

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function()  use ($app) {
        return $app['twig']->render('cars.html.twig');
      });

    $app->get("/car_results", function() use($app) {
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
        };

        return $app['twig']->render('cars_matching_search.html.twig', array('cars' => $cars_matching_search));

      });



    return $app;

?>
