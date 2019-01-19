<?php
/**
 * Created by IntelliJ IDEA.
 * User: ahm
 * Date: 23/11/2017
 * Time: 13.38
 */


$eksekusiIndexFoodProduct = 'java -jar Halal.jar -docs /var/www/halal/public/resources/foodproducts';

$a = shell_exec($eksekusiIndexFoodProduct);

$eksekusiIndexIngredients = 'java -jar Halal.jar -docs /var/www/halal/public/resources/ingredients';

$b = shell_exec($eksekusiIndexIngredients);

echo $a;
echo $b;

// $a = shell_exec('java -jar C:\Users\ahm\IdeaProjects\Halal\out\artifacts\Halal_jar\Halal.jar -search "happy"');

// var_dump($a);

?>