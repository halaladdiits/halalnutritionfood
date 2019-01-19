<?php
//header("Content-type:text/plain");
//header("Content-Disposition:attachment;filename='output-server.txt'");



/*$eksekusi1 = 'java -jar ./Similarity35.jar -reindex -docs /var/www/halal/public/resources3/foodproducts -debug';
$eksekusi2 = 'java -jar ./Similarity35.jar -reindex -docs /var/www/halal/public/resources3/foodproducts';
*/
$eksekusi = 'java -jar ./Similarity36.jar -index /var/www/halal/public/index -docs /var/www/halal/public/resources/foodproducts -u halal -p HalalJaya99 -reindex';

$output = shell_exec($eksekusi);
//$output = shell_exec($eksekusi2);
echo '<pre>'.$output.'</pre>'

?>