<?php 
    @include("./common/db.php");
    $q_id = $_GET["edit"];
    $query = $conn->prepare("select * from questions where `id` = ?");
    $query ->bind_param("i", $q_id);
    

    if($query -> execute()){
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $description = $row["description"];
        $c_id = $row["category_id"];

    }else {
        echo "couldnt edit";
    }



?>


<div class="container">
<h1 class="heading">Edit Your Question</h1>
<form method ="post" action ="./server/requests.php">
  <input type="hidden" value="<?php echo $q_id; ?>" name="q_id">
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="title" class="form-label">Edit Title:</label>
    <input type="text" name="title" class="form-control" id ="title" value="<?php echo $title ?>" >
  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="description" class="form-label">Edit Description:</label>
    <textarea name="description" class="form-control"id="description" ><?php echo $description ?></textarea>
    </div>

    <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="category" class="form-label">Edit Category:</label>
   <?php @include("category.php")?>
  </div>
  
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <button type="submit" name="edit" class="btn btn-primary">Edit</button>
  </div>

</form>
</div>
