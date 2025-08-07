<div class="container">
    <h1 class="heading">Question</h1>
    <div class="col-8">
        <?php 
            @include('./common/db.php');
            $q_id = $_GET['q_id'];
            $query = $conn->prepare('select * from `questions` where id =?;');
            $query->bind_param('i',$q_id);
            if ($query->execute()){
                $result=$query->get_result();
                $row = $result->fetch_assoc();
                

            }else {
                echo'edit-ans-details query 1 not executed;';
            }

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

<?php if (isset($_SESSION['user']) && isset($_GET['edit_ans'])) {
        $ans_id= $_GET['edit_ans'];
        $query1  = $conn->prepare('select * from `answers` where id =?;');
        $query1->bind_param('i',$ans_id);
        if($query1->execute()){
            $result1 = $query1->get_result();
            $row1=$result1->fetch_assoc();
            $content = $row1['answer'];
        }
        else{
            echo'query not executed ;';
        }
        ?>
        <form action="./server/requests.php" method ='post'>
            <input type="hidden" name="q_id" value ="<?php echo$q_id ?>">
            <input type="hidden" name="ans_id" value ="<?php echo$ans_id ?>">
        <textarea class="form-control margin-bottom-15" name="ans"><?php echo $content; ?></textarea>
        <button name ="update" class="btn btn-primary">Update Your Answer</button>
        </form>
        <?php }?>


    
        
    </div>
</div>