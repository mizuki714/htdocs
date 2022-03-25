<?php
function getSearch($searchbar){
 $button= $_GET ['submit'];
$search = $_GET ['searchbar'];
//creates the connection using PHPMotors connect function 
$db = phpmotorsConnect();
$sql = "SELECT * FROM inventory WHERE MATCH( InvID, invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor, classificationId, invStock) AGAINST ('%" . $searchbar . "%')";
// Create the prepared statement using the phpmotors connection
$stmt = $db->prepare($sql);
//find the number of rows returned
$foundnum = $stmt->fetchAll(PDO::FETCH_ASSOC);
//if no results found
if ($foundnum == 0)
{
    echo "Sorry, We are unable to find a vehicle with a search term of '<b>$searchbar</b>'.";
}
else{
//if results are found
    //creates the connection using PHPMotors connect function 
    $db = phpmotorsConnect();
    echo "<h1><strong> $foundnum Results Found for \"".$searchbar."\"</strong></h1>";
    $sql = "SELECT * FROM inventory WHERE MATCH( InvID, invYear, invMake, invModel, invDescription, invPrice, invMiles, invColor, classificationId, invStock) AGAINST ('%" . $search . "%')";
    $stmt = $db->prepare($sql);
   if ($foundnum < 0)
 {
    $class = $_POST['classificationId'];
    $make = $_POST['invMake'];
    $model = $_POST['invModel'];
    $description = $_POST['invDescription'];
    $price = $_POST['invPrice'];
    $stock = $_POST['invStock'];
    $miles = $_POST['invMiles'];
    $color = $_POST['invColor'];
    $stmt->bindValue(':classificationId', $class, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $make, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $model, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $description, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $price, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $stock, PDO::PARAM_STR);
    $stmt->bindValue(':invMiles', $miles, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $color, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $message = $stmt->rowCount();
   //filter and store data 
$classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING));
$invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
$invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
$invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
$invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING, FILTER_FLAG_ALLOW_FRACTION));
$invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING));
$invMiles = trim(filter_input(INPUT_POST, 'invMiles', FILTER_SANITIZE_NUMBER_INT));
$invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));

if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription)|| empty($invPrice) || empty($invStock) || empty($invMiles) || empty($invColor)) {
  $message = "Please Enter a Search Term.";
} 
else {
  buildSearchResultPage($class,$make,$model,$price,$stock,$miles,$color);
}
 }
}

function buildSearchResultPage($runrows){
    if ($runrows == $runrows["invId"]){
      echo "<h5 class='card-title'>".$runrows["invId"] ."</h5>";
    }
    elseif ($runrows == $runrows["invYear"]){
      echo "<h5 class='card-title'>".$runrows["invYear"] ."</h5>";
       }
    elseif ($runrows == $runrows["invMake"]){
      echo "<h5 class='card-title'>".$runrows["invMake"] ."</h5>";
      }
    elseif ($runrows == $runrows["invModel"]){
      echo "<h5 class='card-title'>".$runrows["invModel"] ."</h5>";
      }
    elseif ($runrows == $runrows["invDescription"]){
      echo "<h5 class='card-title'>".$runrows["invDescription"] ."</h5>";
      }
    elseif ($runrows == $runrows["invPrice"]){
      echo "<h5 class='card-title'>".$runrows["invPrice"] ."</h5>";
      }
    elseif ($runrows == $runrows["invStock"]){
      echo "<h5 class='card-title'>".$runrows["invStock"] ."</h5>";
      }
    elseif ($runrows == $runrows["invMiles"]){
      echo "<h5 class='card-title'>".$runrows["invMiles"] ."</h5>";
      }
    elseif ($runrows == $runrows["invColor"]){
      echo "<h5 class='card-title'>".$runrows["invColor"] ."</h5>";
      }
    elseif ($runrows == $runrows["classificationId"]){
      echo "<h5 class='card-title'>".$runrows["classificationId"] ."</h5>";
   }
else{
     echo "Sorry, An error has occured.";
   }
   return $runrows;
  }
  }

?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php';?>
