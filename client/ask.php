<div class="container">
<h1 class="heading">Ask Your Question</h1>
<form method ="post" action ="./server/requests.php">
  
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id ="title"placeholder="enter your title" >
  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="description" class="form-label">Description:</label>
    <textarea name="description" class="form-control"id="description" placeholder="Describe your Question"></textarea>
    </div>

    <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="category" class="form-label">Select Category:</label>
   <?php @include("category.php")?>
  </div>
  
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <button type="submit" name="ask" class="btn btn-primary">Submit</button>
  </div>

</form>
</div>
