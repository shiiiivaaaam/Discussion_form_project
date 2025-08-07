<?php 
session_start();
if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1){


?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Questions Table</title>
    <?php @include("../client/commonFiles.php");?>
</head>
<body>
    <?php 
        
    
    @include("./header.php");
    @include("../common/db.php");

    $query = $conn->prepare("select * from `questions`");
    if ($query->execute()){
        $result = $query ->get_result();

    }else {
        echo "couldnt load from database ";
    }
       

        @include('./footer.php');
    ?>

    <div class="container">
        <h1 class="text-center">Questions List</h1>
           <table class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">Id.No.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">category_id</th>
      <th scope="col">user_id</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row){ ?>
    <tr>
      <th scope="row"><?php echo $row['id'] ?></th>
      <td><?php echo $row['title'] ?></td>
      <td><?php echo $row['description'] ?></td>
      <td><?php echo $row['category_id'] ?></td>
      <td><?php echo $row['user_id'] ?></td>
      <form action="./request.php" method ='post'>
      <td><button name="delete_ques" value="<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">X</button></td>
      </form>
    </tr>
<?php } ?>


  </tbody>
</table>
    </div>
 

</body>
</html>

<?php }else {
    
    echo "access denied.";
}
?>