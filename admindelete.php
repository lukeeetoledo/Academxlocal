<?php
include 'config.php';

if(isset($_GET['token'])){
  $date = date("F j, Y, g:i A");
  $ID=$_GET['token'];
  $poster_ID = $_GET['q'];  
  $title = $_GET['r'];
  $sql="DELETE FROM amx_post_tbl WHERE post_id = '$ID';
         DELETE FROM amx_comment_tbl WHERE post_id ='$ID';
         DELETE FROM amx_likedislike_tbl WHERE post_id ='$ID';
         DELETE FROM amx_notifications_tbl WHERE post_ID = '$ID';
         INSERT INTO amx_notifications_tbl SET post_ID= '$ID', actor_ID = 'admin', content = 'Your post, [$title] has been deleted because it has been reported multiple times and does violate our community guidelines.', action_type = 'deleted', poster_ID = '$poster_ID', active = 1, action_time='$date'";
  $result = mysqli_multi_query($conn, $sql);
  if($result){
    header("location:adminhome.php");
  }else{
      echo $conn->error;//getting the error
  }
}
else{
  header("location:adminhome.php");//redirect
}

?>