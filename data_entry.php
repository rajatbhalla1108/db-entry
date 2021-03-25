<?php 
session_start();
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 
    $cin = validate($_POST['cin']);
    $director1 = validate($_POST['director1']);
    $director2 = validate($_POST['director2']);
    $email = validate($_POST['email']);

 
    if (empty($cin)) {
        header("Location: form.php?error=CIN/LLN no required");
        exit();
    } elseif (empty($email)) {
        header("Location: form.php?error=Email is required");
        exit();
    } else {
        $sql = "INSERT INTO form_data_table (director_1,director_2,email)
        VALUES ('$director1','$director1','$email')";
        if (mysqli_query($conn, $sql)) {
            if ($_POST['save_next']) {
                header("Location: form.php?success=Data Inserted Successfully");
            }
            else
            {
                header("Location: home.php");
            }
        } else {
            header("Location: form.php?error=Data not inserted due to".$sql);
        }
    }
}
else
{
    header("Location: index.php");
    exit();
}