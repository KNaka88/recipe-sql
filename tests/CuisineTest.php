<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost:8889;dbtype=recipe_database_test';
    $usertype = 'root';
    $password = 'root';
    $DB = new PDO($server, $usertype, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Cuisine::deleteAll();
        }

        function test_gettype()
        {
            //Arrange
            $type = "Italian";
            $test_Cuisine = new Cuisine($type);

            //Act
            $result = $test_Cuisine->gettype();

            //Assert
            $this->assertEquals($type, $result);
        }

        function test_getId()
        {
            //Arrange
            $type = "Italian";
            $id = 1;
            $test_Cuisine = new Cuisine($type, $id);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $type = "Italian";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $type = "Italian";
            $type2 = "Japanese";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $type = "Italian";
            $type2 = "Japanese";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $type = "Italian";
            $type2 = "Japanese";
            $test_Cuisine = new Cuisine($type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($type2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::find($test_Cuisine->getId());

            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }
    }




?>
