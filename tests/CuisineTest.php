<?php
    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=food_finder_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     //Restaurant::deleteAll();
        //     Cuisine::deleteAll();
        // }

        function test_getName()
        {
            //Arrange
            $test_name = "Albanian";
            $test_spicy = false;
            $test_price = 3.00;
            $test_cuisine = new Cuisine( $test_name, $test_spicy, $test_price);

            //Act
            $result = $test_cuisine->getName();

            //Assert
            $this->assertEquals($test_name, $result);


        }


    }
 ?>
