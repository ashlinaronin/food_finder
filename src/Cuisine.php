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

        }

        function getSpicy()
        {

        }

        function getPrice()
        {

        }

        //set
        function setPrice()
        {

        }

        function getId()
        {

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
