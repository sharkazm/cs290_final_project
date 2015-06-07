<!-- Title: Dating Website Database -->
<!-- db_favoriteplaces.php: Comes from db_render.php via POST or GET.
  POST: takes users entered favorite place and location and enters it
  into the database. GET: removes the selected favorite place and location
  from the database. It gives a confirmation to the user. -->
<?php
session_start();
if ($_SESSION["logged_on"] != 1){
  header("Location: db_login.php");
}
include 'mysql.php';
include 'db_header.php';
?>

<?php
  
  //from db_render.php via POST. if statement to enter user's favorite place
  if (isset($_POST['favorite_place_submit'])){
    $userid = $_POST['id'];
    $username = $_POST['usn'];
    $location_name = $_POST['fav_place'];
    $location_state = $_POST['location'];

    $sql = "INSERT INTO db_favorite_places (user_id, name, location_id) 
            VALUES ('$userid', '$location_name', (SELECT id FROM db_location WHERE location='$location_state'))";
    $res = mysqli_query($conn, $sql);

    if ($res){
      echo "Favorite added!!!<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "Error happened!<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
  }

//from db_render.php via GET. if statement to delete user's favorite place
if (isset($_GET['id1']) && isset($_GET['placeid'])){
    $user_id = $_GET['id1'];
    $place_id = $_GET['placeid'];
    $username = $_GET['usn'];

    $sql = "DELETE FROM db_favorite_places WHERE id='$place_id'";
    $res = mysqli_query($conn, $sql);

    if ($res){
      echo "Favorite place deleted!!!<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
    else{
      echo "Error happened!<br /><br />";
      echo "Click <a href='db_render.php?usn=$username'>Here </a> to go back.";
    }
  }
?>

<?php
	include 'db_footer.php';
?>
