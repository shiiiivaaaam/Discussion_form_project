<?php 

session_start();
if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1){


?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Answers Table</title>
    <?php @include("../client/commonFiles.php");?>
</head>
<body>
    <?php 
        
    
    @include("./header.php");
    @include("../common/db.php");

    $query = $conn->prepare("select * from `answers`");
    if ($query->execute()){
        $result = $query ->get_result();

    }else {
        echo "couldnt load from database ";
    }
       

        @include('./footer.php');
    ?>

    <div class="container">
        <h1 class="text-center">Answers List</h1>
           <table class="table table-success table-striped">
   <thead>
    <tr>
      <th scope="col">Id.No.</th>
      <th scope="col">answer</th>
     
      <th scope="col">question_id</th>
      <th scope="col">user_id</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($result as $row){ ?>
    <tr>
      <th scope="row"><?php echo $row['id'] ?></th>
      <td><?php echo $row['answer'] ?></td>
      
      <td><?php echo $row['question_id'] ?></td>
      <td><?php echo $row['user_id'] ?></td>
      <form action="./request.php" method ='post'>
      <td><button name="delete_ans" value="<?php echo $row['id'] ?>" class="btn btn-danger btn-sm">X</button></td>
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