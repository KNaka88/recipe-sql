<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Recipe.php";

    $server = 'mysql:host=localhost:8889;dbname=recipe_database_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class RecipeTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Recipe::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $name = "spaghetti";
            $rating = 3;
            $test_recipe = new Recipe($name, $rating);

            //Act
            $test_recipe->save();

            //Assert
            $result = Recipe::getAll();
            $this->assertEquals($test_recipe, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "spaghetti";
            $rating = 3;
            $name2 = "sushi";
            $rating2 = 5;
            $test_recipe = new Recipe($name, $rating);
            $test_recipe->save();
            $test_recipe2 = new Recipe($name2, $rating2);
            $test_recipe2->save();

            //Act
            $result = Recipe::getAll();

            //Assert
            $this->assertEquals([$test_recipe, $test_recipe2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $name = "spaghetti";
            $rating = 3;
            $name2 = "sushi";
            $rating2 = 5;
            $test_recipe = new Recipe ($name, $rating);
            $test_recipe->save();
            $test_recipe2 = new Recipe($name2, $rating2);
            $test_recipe2 ->save();

            //Act
            Recipe::deleteAll();

            //Assert
            $result = Recipe::getAll();
            $this->assertEquals([], $result);
        }

        function test_getID()
        {
            //Arrange
            $name = "spaghetti";
            $rating = 3;
            $id = 1;
            $test_recipe = new Recipe($name, $rating, $id);

            //Act
            $result = $test_recipe->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        function test_find()
        {
            //Arrange
            $name = "spaghetti";
            $rating = 3;
            $name2 = "sushi";
            $rating2 = 5;
            $test_recipe = new Recipe($name, $rating);
            $test_recipe->save();
            $test_recipe2 = new Recipe($name2, $rating2);
            $test_recipe2->save();

            //Act
            $id = $test_recipe->getId();
            $result = Recipe::find($id);

            //Assert
            $this->assertEquals($test_recipe, $result);
        }


    }
?>
