<?php 

session_start();
if (isset($_SESSION['user']) && $_SESSION['user']['admin']==1){


?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Admin Dashboard</title>
    <?php @include("../client/commonFiles.php");?>
</head>
<body>
    <?php 
        
    
    @include("./header.php");

         

        @include('./footer.php');
    ?>
    <div class="container">
        <h1 class="text-center">Admin Dashboard</h1>
    </div>

</body>
</html>

<?php }else {
    
    echo "access denied.";
}
?>