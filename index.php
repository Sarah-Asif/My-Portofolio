<?php
$pageTitle = 'Home'; $active = 'index';
require __DIR__ . '/includes/header.php';
$p = db()->query('SELECT * FROM profile LIMIT 1')->fetch();
$latest = db()->query('SELECT * FROM projects ORDER BY created_at DESC, id DESC LIMIT 3')->fetchAll();
?>
<section class="hero mb-5">
  <div class="row align-items-center g-4">
    <div class="col-md-3 d-flex justify-content-center"><div class="avatar" aria-hidden="true"><?= e(mb_substr($p['full_name'], 0, 1)) ?></div></div>
    <div class="col-md-9">
      <h1 class="display-5 fw-bold">Hi, I'm <?= e($p['full_name']) ?></h1>
      <p class="lead"><?= e($p['title']) ?></p>
      <a href="projects.php" class="btn btn-light me-2">View Projects</a>
      <a href="contact.php" class="btn btn-outline-light">Contact Me</a>
    </div>
  </div>
</section>

<section class="row g-4 mb-5" aria-labelledby="about">
  <div class="col-lg-8">
    <h2 id="about">About Me</h2>
    <p><?= nl2br(e($p['bio'])) ?></p>
    <p class="mb-0"><strong>Experience:</strong> <span id="experienceYears" data-start="<?= e($p['career_start']) ?>"></span> of learning &amp; building</p>
  </div>
  <div class="col-lg-4">
    <div class="card"><div class="card-body">
      <h3 class="h5">Quick Info</h3>
      <ul class="list-unstyled mb-0">
        <li><strong>Email:</strong> <a href="mailto:<?= e($p['email']) ?>"><?= e($p['email']) ?></a></li>
        <li><strong>Phone:</strong> <?= e($p['phone']) ?></li>
        <li><strong>Location:</strong> <?= e($p['location']) ?></li>
      </ul>
    </div></div>
  </div>
</section>

<section aria-labelledby="latest">
  <h2 id="latest" class="mb-3">Latest Projects</h2>
  <div class="row g-4">
    <?php foreach ($latest as $pr): ?>
    <div class="col-md-4"><article class="card project">
      <div class="card-thumb" aria-hidden="true">&lt;/&gt;</div>
      <div class="card-body">
        <h3 class="h5"><?= e($pr['title']) ?></h3>
        <p class="small text-body-secondary"><?= e(mb_strimwidth($pr['description'], 0, 100, '...')) ?></p>
        <span class="badge text-bg-primary"><?= e($pr['category']) ?></span>
      </div>
    </article></div>
    <?php endforeach; ?>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
