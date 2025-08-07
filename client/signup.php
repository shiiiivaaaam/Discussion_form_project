<div class="container">
<h1 class="heading">SignUp</h1>
<form method ="post" action ="./server/requests.php ">
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="username" class="form-label">User Name</label>
    <input type="text" name="username"class="form-control" id="username" placeholder="enter your username" required>

  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email"class="form-control" id ="email"placeholder="enter your email" required>
  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password"class="form-control" id="password"placeholder="create Password" required>
  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <label for="address" class="form-label">Address</label>
    <input type="text" name="address"class="form-control" id="address" placeholder="enter your address" required>
  </div>
  <div class="col-6 offset-sm-3 margin-bottom-15">
    <button type="submit" name="signup" class="btn btn-primary">SignUp</button>
  </div>

</form>
</div>
