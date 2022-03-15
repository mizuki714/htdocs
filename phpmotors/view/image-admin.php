<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/doctype.php'; ?>
<title> PHP Motors | Image Admin </title>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<nav>
    <?php echo $navList; ?>
</nav>
<main>
<?php 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?>

<h1>Image Management Here</h1>
<p>Choose one of the options below:</p>

<h2>Add New Vehicle Image</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem" >Vehicle</label>
	<?php echo $prodSelect; ?> <br> <br>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
        <div class="yes">
        <label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
        </div>
		<div class="no">
        <label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </div>
	</fieldset>
    <br>
 <label>Upload Image:</label><br>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>

<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>

<?php include $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php' ?>
<?php unset($_SESSION['message']); ?>