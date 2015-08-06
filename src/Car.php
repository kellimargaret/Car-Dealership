<?php
    class Car
    {
        private $make_model;
        private $price;
        private $miles;
        private $picture;
        function worthBuying($max_price, $max_miles)
        {
          return $this->price < $max_price && $this->miles < $max_miles;
        }
        function __construct($make_model, $price, $miles, $picture)
        {
          $this->make_model = $make_model;
          $this->price = $price;
          $this->miles = $miles;
          $this->picture = $picture;
        }
        function setMake_Model($new_make_model)
        {
          $this->make_model = $make_model;
        }
        function setPrice($new_price)
        {
          $float_price = (float) $new_price;
          if ($float_price != 0) {
              $formatted_price = number_format($float_price, 2);
              $this->price = $formatted_price;
          }
        }
        function setMiles($new_miles)
        {
          $this->miles = $new_miles;
        }
        function setPicture($new_image)
        {
          $this->picture = $image_path;
        }
        function getMake_Model()
        {
          return $this->make_model;
        }
        function getPrice()
        {
          return $this->price;
        }
        function getMiles()
        {
          return $this->miles;
        }
        function getPicture()
        {
          return $this->picture;
        }
    }
?>
