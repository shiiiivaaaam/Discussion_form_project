<?php  


    session_start();
    @include("../common/db.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

if (isset($_POST["signup"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    // STEP 1: Check if email exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "This email is already registered. Please login or use a different email.";
    } else {
         $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // STEP 2: Insert new user
        $stmt = $conn->prepare("INSERT INTO `users`(`id`, `username`, `password`, `email`, `address`) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $hashed_password, $email, $address);
        
        $result = $stmt->execute();
        
        if ($result) {
            $user_id = $conn->insert_id;
            $_SESSION["user"] = ['username' => $username, "email" => $email,"user_id"=>$user_id];
            header("Location: /discuss");
        } else {
            echo "SignUp Failed.";
        }
    }
}
  
else if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $hashed_password = $row["password"];

       
        if (password_verify($password, $hashed_password)) {
            
            $_SESSION["user"] = [
                'username' => $row["username"],
                "email" => $row["email"],
                "user_id" => $row["id"],
                'admin'=>$row['admin']
            ];
            header("Location: /discuss");
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}

else if (isset($_GET["logout"])){
    session_unset();
    header("location: /discuss");
}
else if (isset($_POST["ask"])){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category_id = $_POST["category"];
    $user_id = $_SESSION["user"]['user_id'];

    $question = $conn->prepare("insert into `questions`(`id`,`title`,`description`,`category_id`,`user_id`)
    values(NULL,'$title','$description','$category_id','$user_id');
    ");

    $result = $question->execute();
    if ($result) {
        
        header("location:/discuss");
    }
    else {
        echo "SignUp Failed";
    }
}else if (isset($_POST["answer"])){
    $answer = $_POST["answer"];
    $question_id = $_POST["q_id"];
    $user_id = $_SESSION["user"]['user_id'];

    $query=$conn->prepare("insert into `answers`(`answer`,`question_id`,`user_id`)
    values(?,?,?)
    ");

    // $answer=$conn->prepare("insert into `answers`(`id`,`answer`,`question_id`,`user_id`)
    // values(NULL,'$answer','$question_id','$user_id');
    // ");

    $query->bind_param("sss",$answer ,$question_id, $user_id);

    $result = $query->execute();
    if ($result) {
        
        header("location:/discuss/?q_id=$question_id");

    }else {
        echo "Answer not submitted ";
    }
}else if (isset($_GET["delete"])){
         $delete_id = $_GET["delete"];
        $login_id  = $_SESSION['user']['user_id'];
        $query=$conn->prepare("delete from questions where id=? and user_id=?;");
        $query->bind_param("ii",$delete_id, $login_id);
        $result = $query->execute();
        if ($result) {
            header("Location:/discuss");
        }else {
            echo "Couldnt delete the question";
        }
    }
   else if (isset($_GET["delete_ans"])) {
    $delete_id = $_GET["delete_ans"];
    $login_id  = $_SESSION['user']['user_id'];

    // Step 1: Get the question_id first
    $q = $conn->prepare("SELECT question_id FROM answers WHERE id = ? AND user_id = ?");
    $q->bind_param("ii", $delete_id, $login_id);
    $q->execute();
    $result = $q->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $q_id = $row['question_id'];

        // Step 2: Now safely delete it
        $query = $conn->prepare("DELETE FROM answers WHERE id = ? AND user_id = ?");
        $query->bind_param("ii", $delete_id, $login_id);
        $result = $query->execute();

        if ($result) {
            header("Location: /discuss/?q_id=$q_id");
        } else {
            echo "Couldn’t delete the answer.";
        }

    } else {
        echo "Answer not found or you don't own it.";
    }
}else if (isset($_POST["email_submit"])) {
    


require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/PHPMailer.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = ''; // your Gmail
        $mail->Password = '';         // your App Password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('', $name); //fill email here.
        $mail->addAddress(''); // fill email here.

        $mail->isHTML(true);
        $mail->Subject = 'Discuss Message Contact Us';
        $mail->Body    = "Name: $name<br>Email: $email<br>Message:<br>" . nl2br($message);
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Invalid Request.";
}


}else if (isset($_POST["edit"])){
    $id = $_POST["q_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $category_id = $_POST["category"];
    $user_id = $_SESSION["user"]['user_id'];

    $question = $conn->prepare("update questions set title=? ,description=?,category_id=? where id =? and user_id=?");

    $question->bind_param("ssiii", $title, $description, $category_id,$id, $user_id);
    $result = $question->execute();
    if ($result) {
        
        header("location:/discuss/?q_id=$id");
    }
    else {
        echo "Failed to Edit";
    }
}  else if(isset($_POST['update'])) {
    $ans_id = $_POST['ans_id'];
    $q_id = $_POST['q_id'];
    $answer = $_POST['ans'];
    $query = $conn->prepare('update `answers` set answer = ? where id =?;');
    $query->bind_param('si',$answer,$ans_id);
    if($query->execute()){ 
        echo"<script>
            // alert('Answer updated Successfully');
            window.location.href = '/discuss?q_id=$q_id';
        </script>" ;
    }else {
        echo 'couldnt update answer';
    }


}


  

    
   

?>
