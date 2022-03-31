<?php
function probablybrokentoo($search_keyword){
    $limit=10;
	
	$sql = "SELECT * FROM inventory WHERE concat(invId, invMake, invModel,invDescription, invMiles, invPrice, invStock, invColor)LIKE '%$search_keyword%' ORDER BY invMake LIMIT 10";

    $db = phpmotorsConnect();
	$stmt =$db->query($sql);
	$tn = $stmt->fetchColumn();

	$totalNumResult = (int)$tn;
	
	$totalPage = ceil($totalNumResult/$limit);
	if (!isset($_GET['page'])) {
		$page = 1;
	} else{
		$page = $_GET['page'];
	}
	$start = ($page-1) * $limit;
    
	$row = $db->prepare($sql);
	$row->execute([$start, $limit]);

	while ($res = $row->fetch(PDO::FETCH_ASSOC)):
	?>
	<h4><?php echo $res['invMake'];?></h4>
	<p><?php echo $res[$search_keyword];?></p>
<hr>
<?php
endwhile;

for ($page=1 ; $page <= $totalPage ; $page++): ?>
	<a href='<?php echo "?page=$page"; ?>' class="links".> </a>
	<?php endfor;
	?>
<?php
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
	$keywords = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $stmt->closeCursor();
	return $keywords; 
}
?>

<!-- <?php
//original working function

// function probablybrokentoo($search_keyword){

//     $db = phpmotorsConnect();
// 	//THIS IS THE ISSUE ATM , fixed it! 
// 	$sql = "SELECT * FROM inventory WHERE concat(invId, invMake, invModel,invDescription, invMiles, invPrice, invStock, invColor)LIKE '%$search_keyword%' ORDER BY invMake";
// 	$stmt = $db->prepare($sql);
// 	$stmt->execute();
// 	$stmt->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
// 	$keywords = $stmt->fetchAll(PDO::FETCH_ASSOC);
// 	 $stmt->closeCursor();
//	return $keywords; 
//}
?> -->