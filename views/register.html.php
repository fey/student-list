<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Students list</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</head>

<body class="col-lg-8 mx-auto">
  <header>
    <nav class="py-2 bg-light border-bottom">
      <div class="container d-flex flex-wrap">
        <ul class="nav me-auto">
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
        </ul>
        <ul class="nav">
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Login</a></li>
          <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Sign up</a></li>
        </ul>
      </div>
    </nav>
  </header>

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
  <footer class="pt-5 my-5 text-muted border-top">
    Created by the Bootstrap team &middot; &copy; 2021
  </footer>
</body>

</html>
