<?php
    //set up
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Cuisine.php";
    require_once __DIR__."/../src/Restaurant.php";

    // We need to enable patch and delete http methods in order to use them for routes
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=food_finder';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    // Landing page. [R]ead
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'cuisines' => Cuisine::getAll()
        ));
    });

    // Delete all
    $app->delete("/", function() use ($app) {
        Cuisine::deleteAll();
        Restaurant::deleteAll();

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
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    //[U]pdate a particular cuisine /cuisines/{id}
    $app->patch("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->updatePrice($_POST['price']);
        return $app ['twig']->render('cuisine.html.twig', array(
            'cuisine'=> $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));

    });


    // Form for editing a cuisine
    $app->get("/cuisines/{id}/edit", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));

    });

    //[D]elete a particular cuisine /cuisines/{id}
    $app->delete("/cuisines/{id}", function($id) use ($app) {
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return $app['twig']->render('index.html.twig', array('cuisines' => Cuisine::getAll()));
    });

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

    //[U]pdate a particular restaurant
    $app->patch("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $restaurant->updateName($_POST['name']);

        // get cuisine to display on feedback page
        $cuisine_id = $restaurant->getCuisineId();
        $cuisine = Cuisine::find($cuisine_id);

        return $app['twig']->render('cuisine.html.twig', array(
            'cuisine'=> $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));

    });

    //[Delete] a particular restaurant
    $app->delete("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);
        $cuisine_id = $restaurant->getCuisineId();
        $restaurant->delete();

        $cuisine = Cuisine::find($cuisine_id);

        return $app['twig']->render('cuisine.html.twig', array(
            'cuisine' => $cuisine,
            'restaurants' => $cuisine->getRestaurants()
        ));
    });

    //Display restaurant edit form
    $app->get("/restaurants/{id}", function($id) use ($app) {
        $restaurant = Restaurant::find($id);

        return $app['twig']->render('restaurant_edit.html.twig', array(
            'restaurant' => $restaurant
        ));

    });

    return $app;


?>
