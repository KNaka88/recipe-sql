<?php
    class Ingredients
    {
        private $item;
        private $id;

        function __construct($item, $id = null)
        {
            $this->item = $item;
            $this->id = $id;
        }

        function setItem($new_item)
        {
            $this->item = (string) $new_item;
        }

        function getItem()
        {
            return $this->item;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO Ingredients (item) VALUES ('{$this->getItem()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_items = $GLOBALS['DB']->query("SELECT * FROM ingredients;");
            $ingredients = array();
            foreach($returned_items as $returned_item) {
                $item = $returned_item['item'];
                $id = $returned_item['id'];
                $new_ingredient = new Ingredients($item, $id);
                array_push($ingredients, $new_ingredient);
            }
            return $ingredients;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM ingredients;");
        }

        static function find($search_id)
        {
            $found_ingredient = null;
            $ingredients = Ingredients::getAll();
            foreach($ingredients as $ingredient) {
                $ingredient_id = $ingredient->getId();
                if ($ingredient_id == $search_id) {
                  $found_ingredient = $ingredient;
                }
            }
            return $found_ingredient;
        }
    }
?>
