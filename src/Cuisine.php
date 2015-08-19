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

            $GLOBALS['DB']->exec(
                "INSERT INTO cuisines (name, spicy, price) VALUES (
                    '{$this->getName()}',
                    {$this->getSpicy()},
                    {$this->getPrice()}
                );"
            );
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        //CRUD Read
        static function getAll()
        {
            $db_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
            $all_cuisines = array();
            foreach ($db_cuisines as $cuisine) {
                $name = $cuisine['name'];
                $spicy = $cuisine['spicy'];
                $price = $cuisine['price'];
                $id = $cuisine['id'];

                $new_cuisine = new Cuisine($name, $spicy, $price, $id);
                array_push($all_cuisines, $new_cuisine);
            }
            return $all_cuisines;
        }

        // function find($search_name)
        // {
        //
        // }

        static function getRestaurants()
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisines;");
        }

    }


 ?>
