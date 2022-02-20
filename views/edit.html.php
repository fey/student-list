<?php

use App\Support\HtmlHelper;

use function App\Functions\array_get;
/**
 * @var \App\Students\Student $student
 * @var \App\Http\Forms\EditForm $form
 */
?>

<?php include('shared/head.html.php') ?>
<main>
    <h1 class="p-5">Edit student</h1>
    <div class="card">
      <div class="card-body p-3">
      <form action="/edit" method="POST">
          <div class="mb-3">
            <label for="user_first_name" class="form-label">First name</label>
            <input
              type="text"
              name="user[first_name]"
              <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('first_name', $errors)]) ?>"
              id="user_first_name"
              aria-describedby="first_name_help"
              value="<?= $form->getFirstName() ?>"
              >
            <div class="invalid-feedback"><?= array_get($errors, 'first_name') ?></div>
          </div>
          <div class="mb-3">
            <label for="user_last_name" class="form-label">Last name</label>
            <input
              type="text"
              name="user[last_name]"
              <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('last_name', $errors)]) ?>"
              id="user_last_name"
              aria-describedby="first_name_help"
              value="<?= $form->getLastName() ?>"
            >
            <div class="invalid-feedback"><?= array_get($errors, 'last_name') ?></div>
          </div>
          <div class="mb-3">
            <label for="user_email" class="form-label">Email address</label>
            <input
              type="email"
              name="user[email]"
              <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('email', $errors)]) ?>"
              id="user_email"
              aria-describedby="emailHelp"
              value="<?= $form->getEmail() ?>"
            >
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            <div class="invalid-feedback"><?= array_get($errors, 'email') ?></div>
          </div>
          <div class="mb-3">
            <label for="user_password" class="form-label">Password</label>
            <input
              type="password"
              name="user[password]"
              <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('password', $errors)]) ?>"
              id="user_password"
            >
            <div class="invalid-feedback"><?= array_get($errors, 'password') ?></div>
          </div>
          <div class="mb-3">
            <label for="user_group_id" class="form-label">Group ID</label>
            <input
              type="text"
              name="user[group_id]"
              <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('group_id', $errors)]) ?>"
              id="user_group_id"
              value="<?= $form->getGroupId() ?>"
            >
            <div class="invalid-feedback"><?= array_get($errors, 'group_id') ?></div>
          </div>
          <div class="mb-3">
            <label for="user_exam_points" class="form-label">Exam Points</label>
            <input
              type="number"
              name="user[exam_points]"
              <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('exam_points', $errors)]) ?>"
              id="user_exam_points"
              value="<?= $form->getExamPoints() ?>"
            >
            <div class="invalid-feedback"><?= array_get($errors, 'exam_points') ?></div>
          </div>
          <div class="mb-3">
            <label for="user_birthday_date" class="form-label">Birthday Date</label>
            <input type="date" name="user[birthday]" <?= HtmlHelper::class(['form-control','is-invalid' => array_key_exists('birthday', $errors)]) ?>"
            id="user_birthday_date"
            max="2005-01-01"
            value="<?= $form->getBirthday()->format('Y-m-d') ?>"
          >
            <div class="invalid-feedback"><?= array_get($errors, 'birthday') ?></div>
          </div>
          <div class="form-check">
            <input
              <?= HtmlHelper::class(['form-control-input', 'is-invalid' => array_key_exists('gender', $errors)]) ?>"
              type="radio"
              name="user[gender]"
              id="user_gender1"
              value="male"
              <?= $form->getGender() == 'male' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="user_gender1">
              Male
            </label>
          </div>
          <div class="form-check">
            <input
              <?= HtmlHelper::class(['form-control-input', 'is-invalid' => array_key_exists('gender', $errors)]) ?>"
              type="radio"
              name="user[gender]"
              id="user_gender2"
              value="female"
              <?= $form->getGender() == 'female' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="user_gender2">
              Female
            </label>
            <div class="invalid-feedback"><?= array_get($errors, 'gender') ?></div>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
      </div>

    </div>
  </main>
<?php include('shared/footer.html.php') ?>
