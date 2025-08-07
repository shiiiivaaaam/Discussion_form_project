    <h1 class="heading">Categories</h1>
<?php 
    // @include('./common/db.php');
    $query = $conn->prepare("select * from category");
    $query->execute();
    $result  = $query->get_result();
    foreach ($result as $row){
        $id = $row["id"];
        $name = ucfirst($row['name']);
        echo "<div class='row question-list'>
        <h4><a href='?c_id=$id'>$name</a></h4>
        </div>";
    }
?>