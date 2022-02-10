<?php include('shared/head.html.php') ?>
<main>
  <h1 class="p-5">Sign in</h1>
  <div class="card">
    <div class="card-body p-3">
      <form action="/login" method="POST">
        <div class="mb-3">
          <label for="user_email" class="form-label">Email address</label>
          <input name="email" type="email" class="form-control" id="user_email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="user_password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control" id="user_password">
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
      </form>
    </div>

  </div>
</main>
<?php include('shared/footer.html.php') ?>
