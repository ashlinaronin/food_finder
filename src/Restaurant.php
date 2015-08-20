<?php
    class Restaurant
    {
        private $name;
        private $seats;
        private $location;
        private $evenings;
        private $cuisine_id;
        private $id;

        function __construct ($new_name, $new_seats, $new_location, $new_evenings, $new_cuisine_id, $new_id = null)
        {
            $this->name = (string) $new_name;
            $this->seats = (int) $new_seats;
            $this->location = (string) $new_location;

            //Cast evenings as int bc PHP is so dumb it can't get booleans
            //out of MySQL otherwise
            $this->evenings = (int) $new_evenings;
            $this->cuisine_id = $new_cuisine_id;
            $this->id = $new_id;
        }


        // Getters and Setters
        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getSeats()
        {
            return $this->seats;
        }

        function setSeats($new_seats)
        {
            $this->seats = (int) $new_seats;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = (string)$new_location;
        }

        function getEvenings()
        {
            return $this->evenings;
        }

        function setEvenings($new_evenings)
        {
            $this->evenings = (int)$new_evenings;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }


        // Database storage methods
        //CRUD Create
        function save()
        {
            $GLOBALS['DB']->exec(
                "INSERT INTO restaurants (name, seats, location, evenings, cuisine_id) VALUES (
                    '{$this->getName()}',
                    {$this->getSeats()},
                    '{$this->getLocation()}',
                    {$this->getEvenings()},
                    {$this->getCuisineId()}
                );"
            );
            $this->id = $GLOBALS['DB']->lastInsertId();

        }
        // CRUD Update
        function updateName($new_name)
        {
            $GLOBALS ['DB']->exec("UPDATE restaurants SET name  = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }


        // CRUD Delete
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = {$this->getId()};");
        }


        // CRUD Read
        static function getAll()
        {
            $db_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
            $all_restaurants = array();
            foreach ($db_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $seats = $restaurant['seats'];
                $location = $restaurant['location'];
                $evenings = $restaurant['evenings'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];

                $new_restaurant = new Restaurant(
                    $name, $seats, $location, $evenings, $cuisine_id, $id
                );
                array_push($all_restaurants, $new_restaurant);
            }
            return $all_restaurants;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM restaurants; ");
        }

        static function find($search_name)
        {
            $db_restaurants = $GLOBALS['DB']->query(
                "SELECT * FROM restaurants WHERE name = '{$search_name}';"
            );
            $found_restaurants = array();
            foreach ($db_restaurants as $restaurant) {
                $name = $restaurant['name'];
                $seats = $restaurant['seats'];
                $location = $restaurant['location'];
                $evenings = $restaurant['evenings'];
                $cuisine_id = $restaurant['cuisine_id'];
                $id = $restaurant['id'];

                $new_restaurant = new Restaurant(
                    $name, $seats, $location, $evenings, $cuisine_id, $id
                );
                array_push($found_restaurants, $new_restaurant);
            }

            // We may have multiple results-- just return the first one for now.
            return $found_restaurants[0];
        }

    }
?>
