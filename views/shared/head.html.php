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
          <li class="nav-item"><a href="/" class="nav-link link-dark px-2 active" aria-current="page">Home</a></li>
        </ul>
        <ul class="nav">
          <?php if (App\Http\Auth::isGuest()): ?>
            <li class="nav-item"><a href="/login" class="nav-link link-dark px-2">Login</a></li>
            <li class="nav-item"><a href="/register" class="nav-link link-dark px-2">Register</a></li>
            <?php else: ?>
              <li class="nav-item">
                <span class="nav-link text-muted">ID: <?= App\Http\Auth::id() ?></span>
              </li>
              <li class="nav-item"><a href="/edit" class="nav-link link-dark px-2">Edit</a></li>
              <li class="nav-item">
                <a href="/logout" class="nav-link link-dark px-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                  <form class="d-none" action="/logout" id="logout-form" method="POST"></form>
                </a>
              </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>
<? if (isset($flash)): ?>
  <? if (App\Functions\array_get($flash, 'success')): ?>
    <div class="alert alert-success" role="alert">
        <?= App\Functions\array_get($flash, 'success'); ?>
    </div>
  <? endif; ?>
  <? if (App\Functions\array_get($flash, 'error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= App\Functions\array_get($flash, 'error'); ?>
    </div>
  <? endif; ?>
<? endif; ?>
