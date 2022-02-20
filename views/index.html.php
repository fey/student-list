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
        <li <?= HtmlHelper::class(['page-item', 'disabled' => $currentPage === 1]) ?>>
          <a <?= HtmlHelper::href(query: ['page' => $currentPage - 1]) ?> <?= HtmlHelper::class(['page-link']) ?>>Previous</a>
        </li>
        <? foreach(range(1, $pagesCount) as $page): ?>
        <li <?= HtmlHelper::class(['page-item', 'active' => $page === $currentPage]) ?>>
          <a <?= HtmlHelper::href(query: ['page' => $page]) ?> <?= HtmlHelper::class(['page-link']) ?>><?= $page ?></a>
        </li>
        <? endforeach; ?>
        <li <?= HtmlHelper::class(['page-item', 'disabled' => $currentPage === $pagesCount]) ?>>
          <a <?= HtmlHelper::class(['page-link']) ?> <?= HtmlHelper::href(query: ['page' => $currentPage + 1]) ?>>Next</a>
        </li>
      </ul>
    </nav>
  </main>
<?php include('shared/footer.html.php') ?>
