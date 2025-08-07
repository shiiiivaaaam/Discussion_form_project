<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Discussion Project</title>
    <?php @include("client/commonFiles.php");?>
</head>
<body>
    <?php 
        session_start();
    
    @include("client/header.php");
        if(isset($_GET["signup"]) && (!isset($_SESSION['user']) || !isset($_SESSION['user']['username']))) {
            @include("client/signup.php");
        }else if (isset($_GET["login"]) && (!isset($_SESSION['user']) || !isset($_SESSION['user']['username']))) {
            @include("client/login.php");
        }else if (isset($_GET['ask'])){
            @include('./client/ask.php');

        }
        else if (isset($_GET['edit_ans'])){
            @include('./client/edit-ans-details.php');
        }
            else if (isset($_GET['q_id'])){
            @include('./client/question-details.php');
        
        }else if(isset($_GET['contact'])) {
            @include('./client/contact_us.php');
        }
        else if (isset($_GET['edit'])){
            @include('./client/question-edit.php');
        }
        
        else {
            @include('./client/questions.php');
        }

        @include('./common/footer.php');
    ?>

</body>
</html>