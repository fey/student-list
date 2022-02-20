<?php
/**
 * @var int $currentPage
 * @var \App\Students\Student[] $students
 */

use App\Support\HtmlHelper;

?>

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
        <li
          class="page-item <?= $currentPage === 1 ? 'disabled' : '' ?>"
          class="<?= HtmlHelper::classNames(classes: ['page-item'], extras: ['disabled' => $currentPage === 1]) ?>"
          >
          <a href="?<?= http_build_query(['page' => $currentPage - 1]) ?>" class="page-link">Previous</a>
        </li>
        <? foreach(range(1, $pagesCount) as $page): ?>
        <li
          class="<?= HtmlHelper::classNames(classes: ['page-item'], extras: ['active' => $page === $currentPage]) ?>"
        >
          <a class="page-link" href="?<?= http_build_query(['page' => $page]) ?>"><?= $page ?></a>
        </li>
        <? endforeach; ?>
        <li
        class="<?= HtmlHelper::classNames(classes: ['page-item'], extras: ['disabled' => $currentPage === $pagesCount]) ?>"
        >
          <a class="page-link" href="?<?= http_build_query(['page' => $currentPage + 1]) ?>">Next</a>
        </li>
      </ul>
    </nav>
  </main>
<?php include('shared/footer.html.php') ?>
