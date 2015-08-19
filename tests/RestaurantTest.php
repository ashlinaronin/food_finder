<?php

    /**
    * @backupGlobals disabled
    * @backupStatic Attributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=food_finder_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

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


        function test_getSeats()
        {
            //Arrange
            $test_name = " bens bulkogis ";
            $test_seats = 50;
            $test_location = " eastside";
            $test_evenings = true;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);

            //Act
            $result = $test_restaurant->getSeats();

            //Assert
            $this->assertEquals($test_seats, $result);
        }

        function test_getLocation()
        {
            //Arrange
            $test_name = "Ashlin's Asparagus Apothecary";
            $test_seats = 3;
            $test_location = "underground";
            $test_evenings = false;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);

            //Act
            $result = $test_restaurant->getLocation();

            //Assert
            $this->assertEquals($test_location, $result);
        }

        function test_getEvenings()
        {
            //Arrange
            $test_name = "Ellen's Excellent Egg Sanctuary";
            $test_seats = 15;
            $test_location = "Farmville";
            $test_evenings = false;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);

            //Act
            $result = $test_restaurant->getEvenings();

            //Assert
            $this->assertEquals($test_evenings, $result);
        }

        function test_save()
        {
            //Arrange
            $test_name = "Toms Tomatos ";
            $test_seats = 15;
            $test_location = "Farmville";
            $test_evenings = false;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);
            $test_restaurant->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {

            //Arrange
            //r 1
            $test_name = "Toms Tomatos ";
            $test_seats = 15;
            $test_location = "Farmville";
            $test_evenings = true;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);
            $test_restaurant->save();

            //r 2
            $test_name2 = "bobs Tomatos ";
            $test_seats2 = 13335;
            $test_location2 = "feild";
            $test_evenings2 = true;
            $test_restaurant2 = new Restaurant($test_name2, $test_seats2, $test_location2, $test_evenings2);
            $test_restaurant2->save();


            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }


        function test_updateName()
        {
            //Arrange
            $test_name = "Toms Tomatos ";
            $test_seats = 15;
            $test_location = "Farmville";
            $test_evenings = true;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);
            $test_restaurant->save();

            //Act
            $new_name = "Annie Applesauce";
            $test_restaurant->updateName($new_name);
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($new_name, $result[0]->getName());
            //if $new_name == $result[0] return true;
        }


        function test_delete()
        {
            //Arrange
            //r 1
            $test_name = "Toms Tomatos ";
            $test_seats = 15;
            $test_location = "Farmville";
            $test_evenings = true;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);
            $test_restaurant->save();

            //r 2
            $test_name2 = "bobs Tomatos ";
            $test_seats2 = 13335;
            $test_location2 = "feild";
            $test_evenings2 = true;
            $test_restaurant2 = new Restaurant($test_name2, $test_seats2, $test_location2, $test_evenings2);
            $test_restaurant2->save();


            //Act
            $test_restaurant2->delete();

            //Assert
            $this->assertEquals([$test_restaurant], Restaurant::getAll());

        }

        function test_find()
        {
            //Arrange
            $test_name = "Toms Tomatos ";
            $test_seats = 15;
            $test_location = "Farmville";
            $test_evenings = true;
            $test_restaurant = new Restaurant($test_name, $test_seats, $test_location, $test_evenings);
            $test_restaurant->save();

            //Act
            $result = Restaurant::find($test_restaurant->getName());

            //Assert
            $this->assertEquals($test_restaurant, $result);
        }

    }

?>
