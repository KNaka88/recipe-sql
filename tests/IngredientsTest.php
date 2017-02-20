<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Ingredients.php";

    $server = 'mysql:host=localhost:8889;dbname=recipe_database_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class IngredientsTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Ingredients::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $item = "milk";
            $test_ingredients = new Ingredients($item);

            //Act
            $test_ingredients->save();

            //Assert
            $result = Ingredients::getAll();
            $this->assertEquals($test_ingredients, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $item = "milk";
            $item2 = "tomato sauce";
            $test_ingredients = new Ingredients($item);
            $test_ingredients->save();
            $test_ingredients2 = new Ingredients($item2);
            $test_ingredients2->save();

            //Act
            $result = Ingredients::getAll();

            //Assert
            $this->assertEquals([$test_ingredients, $test_ingredients2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $item = "milk";
            $item2 = "tomato sauce";
            $test_ingredients = new Ingredients ($item);
            $test_ingredients->save();
            $test_ingredients2 = new Ingredients($item2);
            $test_ingredients2 ->save();

            //Act
            Ingredients::deleteAll();

            //Assert
            $result = Ingredients::getAll();
            $this->assertEquals([], $result);
        }

        function test_getID()
        {
            //Arrange
            $item = "milk";
            $id = 1;
            $test_ingredients = new Ingredients($item, $id);

            //Act
            $result = $test_ingredients->getId();

            //Assert
            $this->assertEquals(1, $result);

        }

        function test_find()
        {
            //Arrange
            $item = "milk";
            $item2 = "tomato sauce";
            $test_ingredients = new Ingredients($item);
            $test_ingredients->save();
            $test_ingredients2 = new Ingredients($item2);
            $test_ingredients2->save();

            //Act
            $id = $test_ingredients->getId();
            $result = Ingredients::find($id);

            //Assert
            $this->assertEquals($test_ingredients, $result);
        }


    }
?>
