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
        protected function tearDown()
        {
            //Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $test_name = "Albanian";
            $test_spicy = false;
            $test_price = 3;
            $test_cuisine = new Cuisine( $test_name, $test_spicy, $test_price);

            //Act
            $result = $test_cuisine->getName();

            //Assert
            $this->assertEquals($test_name, $result);


        }

        function test_getSpicy()
        {
            //Arrange
            $test_name = "German";
            $test_spicy = false;
            $test_price = 5;
            $test_cuisine = new Cuisine( $test_name, $test_spicy, $test_price);

            //Act
            $result = $test_cuisine->getSpicy();

            //Assert
            $this->assertEquals($test_spicy, $result);


        }

        function test_getPrice()
        {
            //Arrange
            $test_name = "Indian";
            $test_spicy = true;
            $test_price = 1;
            $test_cuisine = new Cuisine( $test_name, $test_spicy, $test_price);

            //Act
            $result = $test_cuisine->getPrice();

            //Assert
            $this->assertEquals($test_price, $result);


        }

        function test_save()

        {
            //Arrange
            $test_name = " Itilanooooo ";
            $test_spicy = true;
            $test_price = 4;
            $test_cuisine = new Cuisine ($test_name, $test_spicy, $test_price) ;
            $test_cuisine->save();



            //Act
            $result = Cuisine::getAll();


            //Assert
            $this->assertEquals($test_cuisine, $result[0]);



        }

        function test_getAll()
        {
            //c1
            //Arrange
            $test_name = " Itilanooooo ";
            $test_spicy = true;
            $test_price = 4;
            $test_cuisine = new Cuisine ($test_name, $test_spicy, $test_price) ;
            $test_cuisine->save();

            $test_name2 = " Mexican ";
            $test_spicy2 = false;
            $test_price2 = 3;
            $test_cuisine2 = new Cuisine ($test_name2, $test_spicy2, $test_price2) ;
            $test_cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine, $test_cuisine2 ], $result);
        }


        function test_getRestaurants()
        {
            //Arrange
            $cuisine_name = "Lebanese";
            $cuisine_spicy = false;
            $cuisine_price = 5;
            $test_cuisine = new Cuisine($cuisine_name, $cuisine_spicy, $cuisine_price);
            $test_cuisine->save();
            $test_cuisine_id = $test_cuisine->getId();

            $test_restaurant1 = new Restaurant(
                "Ben's Bulkogi",
                50,
                "eastside",
                true,
                $test_cuisine_id
            );
            $test_restaurant1->save();

            $test_restaurant2 = new Restaurant(
                "Mario's Pizza Hole",
                35,
                "Hole",
                false,
                $test_cuisine_id
            );
            $test_restaurant2->save();

            //Act
            $result = $test_cuisine->getRestaurants();

            //Assert
            $this->assertEquals([$test_restaurant1, $test_restaurant2], $result);
        }





    }
 ?>
