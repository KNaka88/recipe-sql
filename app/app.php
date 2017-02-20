<?php
    date_default_timezone_set("America/Los_angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Recipe.php";
    require_once __DIR__."/../src/Ingredients.php";
    require_once __DIR__."/../src/Cuisine.php";


    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=recipe_database';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('recipes.html.twig', array('recipes' => Recipe::getAll()));
    });

    $app->post("/recipes", function() use ($app) {
        $recipe = new Recipe($_POST['name'], $_POST['rating']);
        $recipe->save();
        return $app['twig']->render('create_recipe.html.twig', array('newrecipes' => $recipe));
    });

    $app->post("/delete_recipe", function() use ($app) {
        Recipe::deleteAll();
        return $app['twig']->render('delete_recipes.html.twig');
    });


    return $app;
?>
