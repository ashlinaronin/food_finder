<?php
    //set up
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=food_finder';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    // Landing page. [R]ead
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'cuisines' => Cuisine::getAll()
        ));
    });

    // [C]reate cuisine, display all cuisines
    $app->post("/cuisines", function() use ($app) {
        $cuisine = new Cuisine(
            $_POST['name'],
            $_POST['spicy'],
            $_POST['price']
        );
        $cuisine->save();
        return $app['twig']->render('index.html.twig', array(
            'cuisines' => Cuisine::getAll()
        ));
    });


    // [R]ead one particular cuisine
    $app->get("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine.html.twig', array(
            'cuisine' => $cuisine,
            'matching_restaurants' => $cuisine->getRestaurants()
        ));
    });

    //[U]pdate a particular cuisine /cuisines/{id}/edit

    //[D]elete a particular cuisine /cuisines/{id}

    //[C]reate a particular restaurant associated with a cuisine
    // Also display other restaurants associated with this cuisine
    $app->post("/restaurants", function() use ($app) {
        $restaurant = new Restaurant(
            $_POST['name'],
            $_POST['seats'],
            $_POST['location'],
            $_POST['evenings'],
            $_POST['cuisine_id']
        );
        $restaurant->save();
        $cuisine = Cuisine::find($_POST['cuisine_id']);
        return $app['twig']->render('cuisine.html.twig', array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    //[U]pdate a particular restaurant /restaurants/{id}

    //[Delete] a particular restaurant /restaurants/{id}




    return $app;

    //CRUD (Create,Read,Update, Delete)

    //CRUD Create

    //CRUD Read

    //CRUD Update

    //CRUD Delete



?>
