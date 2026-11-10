<?php
$pageTitle = 'Skills & Education'; $active = 'skills';
require __DIR__ . '/includes/header.php';
$skills = [];
foreach (db()->query('SELECT * FROM skills ORDER BY category, level DESC') as $s) $skills[$s['category']][] = $s;
$edu = db()->query('SELECT * FROM education ORDER BY id')->fetchAll();
?>
<div class="row g-5">
  <section class="col-lg-6" aria-labelledby="sk">
    <h1 id="sk" class="h2 mb-4">Skills</h1>
    <?php foreach ($skills as $category => $list): ?>
      <h2 class="h5 mt-4"><?= e($category) ?></h2>
      <?php foreach ($list as $s): ?>
        <div class="mb-3">
          <div class="d-flex justify-content-between"><span><?= e($s['name']) ?></span><span><?= (int)$s['level'] ?>%</span></div>
          <div class="progress" role="progressbar" aria-label="<?= e($s['name']) ?>" aria-valuenow="<?= (int)$s['level'] ?>" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" style="width: <?= (int)$s['level'] ?>%"></div>
          </div>
        </div>
      <?php endforeach; endforeach; ?>
  </section>
  <section class="col-lg-6" aria-labelledby="ed">
    <h2 id="ed" class="h2 mb-4">Education</h2>
    <div class="timeline">
      <?php foreach ($edu as $ed): ?>
        <div class="item">
          <h3 class="h5 mb-0"><?= e($ed['degree']) ?></h3>
          <div class="text-primary"><?= e($ed['institution']) ?></div>
          <small class="text-body-secondary"><?= e($ed['period']) ?></small>
          <p class="mb-0 mt-1"><?= e($ed['description']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
