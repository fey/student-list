<?php include('shared/head.html.php') ?>

<main>
    <h1 class="p-5">Students list</h1>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">First name</th>
          <th scope="col">Last last</th>
          <th scope="col">Group ID</th>
          <th scope="col" style="width: 25%;">Unified State Exam points</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student): ?>
          <tr>
            <td><?= $student->firstName ?></td>
            <td><?= $student->lastName ?></td>
            <td><?= $student->groupId ?></td>
            <td><?= $student->examPoints ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>

    </table>

    <nav>
      <ul class="pagination">
        <li class="page-item disabled">
          <a class="page-link">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item" aria-current="page">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </main>
<?php include('shared/footer.html.php') ?>
