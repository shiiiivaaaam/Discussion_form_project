<div class="container">

<div class="row">
<div class="col-8">
    <h1 class="heading">Questions</h1>
<?php 
    @include('./common/db.php');
    if(isset($_GET['c_id'])){
        $c_id=$_GET['c_id'];
        $query = "select * from questions where category_id = $c_id";
    }else if (isset($_GET["latest"])){
        $query = "select * from questions order by id desc";
    }
    else if (isset($_GET["u_id"])){
        $user_id = $_GET["u_id"];
        $query = "select * from questions where user_id = $user_id";
    }else if (isset($_GET["search"])){
        $search = $_GET["search"];
        $query = "select * from questions where `title` like '%$search%'";
    }
    else{
        $query = 'select * from questions';
    }
    
    $result = $conn->query($query);
    foreach ($result as $row){
        $q_id = $row['id'];
        $title = $row['title'];
        $user_id = $row["user_id"];
        $login_u_id  = $_SESSION["user"]["user_id"];
        echo "<div class='row question-list'>
        <h4 class='my-question'><a href='?q_id=$q_id'>$title</a>";
        echo '<div>';
        echo($login_u_id == $user_id)?"<a class='btn btn-success btn-sm margin-right-15' href='?edit=$q_id'>edit</a>":"";
        echo($login_u_id == $user_id)?"<a class='btn btn-danger btn-sm' href='./server/requests.php?delete=$q_id'>delete</a>":"";
        echo"</div>";
        echo "</h4></div>";
    }
?>
</div>
<div class="col-4">
   <?php @include('categorylist.php'); ?>
</div>
</div>

</div>