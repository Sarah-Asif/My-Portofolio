<?php
$pageTitle = 'Projects'; $active = 'projects';
require __DIR__ . '/includes/header.php';
$projects = db()->query('SELECT * FROM projects ORDER BY created_at DESC, id DESC')->fetchAll();
$cats = array_unique(array_column($projects, 'category'));
?>
<h1 class="mb-3">Projects</h1>
<div class="row g-2 mb-4">
  <div class="col-md-8"><label for="projectSearch" class="visually-hidden">Search projects</label>
    <input id="projectSearch" type="search" class="form-control" placeholder="Search by title, description or technology..."></div>
  <div class="col-md-4"><label for="projectCategory" class="visually-hidden">Filter by category</label>
    <select id="projectCategory" class="form-select">
      <option value="">All categories</option>
      <?php foreach ($cats as $c): ?><option value="<?= e($c) ?>"><?= e($c) ?></option><?php endforeach; ?>
    </select></div>
</div>
<div class="row g-4">
  <?php foreach ($projects as $pr): ?>
  <div class="col-md-6 col-lg-4 project-item" data-category="<?= e($pr['category']) ?>"
       data-text="<?= e(strtolower($pr['title'] . ' ' . $pr['description'] . ' ' . $pr['tech'])) ?>">
    <article class="card project">
      <div class="card-thumb" aria-hidden="true">&lt;/&gt;</div>
      <div class="card-body d-flex flex-column">
        <h2 class="h5"><?= e($pr['title']) ?></h2>
        <p><?= e($pr['description']) ?></p>
        <p class="small text-body-secondary mb-2"><strong>Tech:</strong> <?= e($pr['tech']) ?></p>
        <div class="mt-auto d-flex justify-content-between align-items-center">
          <span class="badge text-bg-primary"><?= e($pr['category']) ?></span>
          <?php if ($pr['link']): ?><a class="btn btn-sm btn-outline-primary" href="<?= e($pr['link']) ?>" target="_blank" rel="noopener noreferrer">View</a><?php endif; ?>
        </div>
      </div>
    </article>
  </div>
  <?php endforeach; ?>
</div>
<p id="noResults" class="text-center text-body-secondary d-none mt-4">No projects match your search.</p>
<?php require __DIR__ . '/includes/footer.php'; ?>
