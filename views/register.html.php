<?php include('shared/head.html.php') ?>
<main>
    <h1 class="p-5">Registration</h1>
    <div class="card">
      <div class="card-body p-3">
        <form>
          <div class="mb-3">
            <label for="user_first_name" class="form-label">First name</label>
            <input type="text" class="form-control" id="user_first_name" aria-describedby="first_name_help">
          </div>
          <div class="mb-3">
            <label for="user_last_name" class="form-label">Last name</label>
            <input type="text" class="form-control" id="user_last_name" aria-describedby="first_name_help">
          </div>
          <div class="mb-3">
            <label for="user_email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="user_email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="user_password">
          </div>
          <div class="mb-3">
            <label for="user_group_id" class="form-label">Group ID</label>
            <input type="text" class="form-control" id="user_group_id">
          </div>
          <div class="mb-3">
            <label for="user_birthday_date" class="form-label">Birthday Date</label>
            <input type="date" class="form-control" id="user_birthday_date" max="2005-01-01">
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="user[gender]" id="user_gender1" checked>
            <label class="form-check-label" for="user_gender1">
              Male
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="user[gender]" id="user_gender2">
            <label class="form-check-label" for="user_gender2">
              Female
            </label>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
      </div>

    </div>
  </main>
<?php include('shared/footer.html.php') ?>
