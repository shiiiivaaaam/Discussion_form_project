<div class="container">
<h1 class="heading">LogIn</h1>
<form method ="post" action ="./server/requests.php">
  
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id ="email"placeholder="enter your email" required>
  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="password"placeholder="enter your Password" required>
  </div>
  
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <button type="submit" name="login" class="btn btn-primary">LogIn</button>
    
  </div>

  <p class="fixed-bottom container" style="bottom:50px;" >admin email - admin@gmail.com password-1234 </p>

</form>
</div>
