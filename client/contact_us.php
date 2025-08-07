<div class="container">
    <h2 >Contact Us</h2>
    <form action="./server/requests.php" method="post">
<div class="mb-3 col-4">
  <label for="name" class="form-label">Name</label>
  <input type="text" name="name" id="name" class="form-control"  placeholder="Name" required>
</div>
<div class="mb-3 col-4">
  <label for="email" class="form-label">Email address</label>
  <input type="email" name = "email" id="email" class="form-control" placeholder="Email" required>
</div>
<div class="mb-3 col-4">
  <label for="message" class="form-label">Message:</label>
  <textarea class="form-control" name="message" id ="message" rows="3" placeholder="enter your message" required></textarea>
</div>
    <button class="btn btn-primary" type ="submit" name="email_submit" >Sent Message</button>
</div>
</form>
