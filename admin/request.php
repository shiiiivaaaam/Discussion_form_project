<?php
    @include_once("../common/db.php");
    if (isset($_POST["delete"])) {
        $id = $_POST["delete"];
        $query = $conn->prepare("delete from `users` where id =?;");
        $query2 = $conn->prepare("delete from `questions` where id =?;");
        $query3 = $conn->prepare("delete from `answers` where id =?;");
        $query->bind_param("i", $id);
        $query2->bind_param("i", $id);
        $query3->bind_param("i", $id);
        if ($query->execute() === TRUE && $query2->execute() === TRUE && $query3->execute() === TRUE) {
            echo "
                <script>
                    alert('User Deleted Successfully');
                    window.location.href = 'user-table.php';
                </script>
            
            
            
            ";
        }
        else {
            echo "coudlnt delete user ";
        }
    }else if (isset($_POST["delete_ques"])) {
        $id = $_POST["delete_ques"];
            $query = $conn->prepare("delete from `questions` where id =?;");
            $query2 = $conn->prepare("delete from `answers` where question_id=? ");
            $query2->bind_param("i", $id);
        $query->bind_param("i", $id);
        if ($query->execute() === TRUE && $query2->execute() === TRUE) {
            echo "
                <script>
                    alert('Question Deleted Successfully');
                    window.location.href = 'questions.php';
                </script>
            
            
            
            ";
        }
        else {
            echo "coudlnt delete user ";
        }
    }else if (isset($_POST["delete_ans"])) {
        $id = $_POST["delete_ans"];
            $query = $conn->prepare("delete from `answers` where id =?;");
        $query->bind_param("i", $id);
        if ($query->execute() === TRUE) {
            echo "
                <script>
                    alert('Answer Deleted Successfully');
                    window.location.href = 'answers.php';
                </script>
            
            
            
            ";
        }
        else {
            echo "coudlnt delete user ";
        }
    }



?>