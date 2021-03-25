<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    include "db_conn.php";
    $sql = "select * from form_data_table ORDER BY cin DESC LIMIT 1;";

		$result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_assoc($result);
            $cin = $row['cin']+1;

        }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="data_entry.php" method="POST">
    <h2>Inser Data</h2>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
         <?php if (isset($_GET['success'])) { ?>
     		<p class="success"><?php echo $_GET['success']; ?></p>
     	<?php } ?>
        <label for="cin">CIN/LLPIN</label>
        <input name="cin" id="cin" type="text" value="<?=$cin?>"><br><br>
        <label for="director1">Director 1</label>
        <input type="text" name="director1" id="director1"><br><br>
        <label for="director2">Director 2</label>
        <input type="text" name="director2" id="director2"><br><br>
        <label for="email" >Email</label>
        <input type="text" name="email" id="email"><br><br>
        <input type="submit" value="Save & Next" name="save_next" style="margin-left: 20px;">
        <input type="submit" value="Save & Exit" name="save_exit" style="margin-left: 20px;">
    </form>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>