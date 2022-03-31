<?php







$rowPerPage =10;
$pphtml = '';
$page = 1;
$start=0;
if(!empty($_POST["page"])) {
	$page = $_POST["page"];
	$start=($page-1) * $rowPerPage;
}
$limit=" limit " . $start . "," . $rowPerPage;
//$pagination_statement = $pdo_conn->prepare($sql);
// $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
// $pagination_statement->execute();

//$row_count = $pagination_statement->rowCount();
if(!empty($row_count)){
	$pphtml .= "<div style='text-align:center;margin:20px 0px;'>";
	$page_count=ceil($row_count/$rowPerPage);
	if($page_count>1) {
		for($i=1;$i<=$page_count;$i++){
			if($i==$page){
				$pphtml .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
			} else {
				$pphtml .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
			}
		}
	}
	$pphtml .= "</div>";
}

$query = $sql.$limit;
$pdo_statement = $pdo_conn->prepare($query);
$pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
?>