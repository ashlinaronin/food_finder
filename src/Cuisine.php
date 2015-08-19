<?php
    class Cuisine
    {
        private $name;
        private $spicy;
        private $price;
        private $id;

        function __construct ($new_name, $new_spicy, $new_price, $new_id = null)
        {
            $this->name = (string) $new_name;
            $this->spicy = (int) $new_spicy;
            $this->price = (int) $new_price;
            $this->id = $new_id;
        }

        //getters and setters


        function getName()
        {
            return $this->name;
        }

        function getSpicy()
        {
            return $this->spicy;
        }

        function getPrice()
        {
            return $this->price;
        }

        //set
        function setPrice($new_price)
        {
            $this->price = (int) $new_price;
        }

        function getId()
        {
            return $this->id;
        }

        //Database storage methods
        //CRUD Create
        function save()
        {

        }

        //CRUD Read
        function getAll()
        {

        }

        // function find($search_name)
        // {
        //
        // }

        function getRestaurants()
        {

        }

        //CRUD Update
        function update($new_price)
        {

        }

        //CRUD Delete
        function delete()
        {

        }

        function deleteAll()
        {

        }

    }


 ?>
