<?php
    class Restaurant
    {
        private $name;
        private $seats;
        private $location;
        private $evenings;
        private $cuisine_id;
        private $id;

        function __construct ($new_name, $new_seats, $new_location, $new_evenings, $new_cuisine_id = null, $new_id = null)
        {
            $this->name = $new_name;
            $this->seats = $new_seats;
            $this->location = $new_location;
            $this->evenings = $new_evenings;
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
            $this->name = $new_name;
        }

        function getSeats()
        {
            return $this->seats;
        }

        function setSeats($new_seats)
        {
            $this->seats = $new_seats;
        }

        function getLocation()
        {
            return $this->location;
        }

        function setLocation($new_location)
        {
            $this->location = $new_location;
        }

        function getEvenings()
        {
            return $this->evenings;
        }

        function setEvenings($new_evenings)
        {
            $this->evenings = $new_evenings;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }


        // Database storage methods
        //function save()
        //function update()
        //function delete()

        //static function getAll()
        //static function deleteAll()
        //static function find($search_name)

    }
?>
