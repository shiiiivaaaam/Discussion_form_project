<div class="container">
    <h1 class="heading">Question</h1>
    <div class="col-8">
        <?php 
            @include('./common/db.php');
            $q_id = $_GET['q_id'];
            $query = "select * from questions where id = $q_id";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $user_id = $row["user_id"];
            $login_u_id = $_SESSION["user"]['user_id'];
            echo '<div class="row">';
            echo "<h4 class='margin-bottom-15 question-title my-question '>Question:".$row["title"];
        echo "<div>";
        echo($login_u_id == $user_id)?"<a class='btn btn-success btn-sm margin-right-15' href='?edit=$q_id'>edit</a>":"";
        echo($login_u_id == $user_id)?"<a class='btn btn-danger btn-sm' href='./server/requests.php?delete=$q_id'>delete</a>":"";
        echo "</h4>";
        echo "<div>";
            echo "</div>";
            echo "<p class='margin-bottom-15'>"."->".$row['description'].'</p>';
            @include('answers.php');
        
        ?>



     <?php if (isset($_SESSION['user'])) {?>
        <form action="./server/requests.php" method ='post'>
            <input type="hidden" name="q_id" value ="<?php echo$q_id ?>">
        <textarea class="form-control margin-bottom-15" name="answer" id="answer" required></textarea>
        <button class="btn btn-primary">Submit Your Answer</button>
        </form>
        <?php 
        }else {
            ?>
           <a href="?login=true"> <button class="btn btn-primary">Submit Your Answer</button></a>
        <?php }?>
        
    </div>
</div>