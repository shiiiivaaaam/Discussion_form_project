<div class="container">
    <div class="offset-sm-1 margin-bottom-15">
        <h5>Answers:</h5>
<?php 
$query =$conn->prepare("select * from answers where question_id = ?;");
$query->bind_param("s",$q_id);
$query->execute();
$result = $query->get_result();
foreach($result as $row){
    $answer =$row["answer"];
    $answer_id =$row["id"];
    $user_id =$row["user_id"];
    $login_u_id =$_SESSION["user"]['user_id'];
    echo "<div class='row'>
    <p class='answer-wrapper my-answer'>$answer";
    
   if ($login_u_id == $user_id) {
    echo "<span class='ms-3'>
            <a class='btn btn-success btn-sm me-2' href='?edit_ans=$answer_id & q_id=$q_id'>Edit</a>
            <a class='btn btn-danger btn-sm' href='./server/requests.php?delete_ans=$answer_id'>Delete</a>
          </span>";
}

    echo "</p></div>";
}

    

?>     
</div>
</div>