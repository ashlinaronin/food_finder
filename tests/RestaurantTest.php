<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Restaurant.php";
    //require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=food_finder';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Restaurant::deleteAll();
        //     Cuisine::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $test_name = "Mario's Pizza";
            $test_seats = 100;
            $test_location = "Downtown";
            $test_evenings = true;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);

            //Act
            $result = $test_restaurant->getName();


            //Assert
            $this->assertEquals($test_name, $result);
        }




    }



?>
