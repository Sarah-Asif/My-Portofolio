<?php
require_once __DIR__ . '/includes/functions.php';
$errors = []; $old = ['name'=>'','email'=>'','subject'=>'','message'=>''];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_ok()) { $errors['form'] = 'Invalid session. Please reload and try again.'; }
    foreach ($old as $k => $_) $old[$k] = trim($_POST[$k] ?? '');
    if (mb_strlen($old['name']) < 2 || mb_strlen($old['name']) > 100) $errors['name'] = 'Name must be 2-100 characters.';
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($old['email']) > 120) $errors['email'] = 'Enter a valid email address.';
    if (mb_strlen($old['subject']) < 3 || mb_strlen($old['subject']) > 150) $errors['subject'] = 'Subject must be 3-150 characters.';
    if (mb_strlen($old['message']) < 10 || mb_strlen($old['message']) > 2000) $errors['message'] = 'Message must be 10-2000 characters.';
    if (!$errors) {
        try {
            db()->prepare('INSERT INTO messages (name,email,subject,message) VALUES (?,?,?,?)')
                ->execute([$old['name'], $old['email'], $old['subject'], $old['message']]);
            flash('Thank you! Your message has been sent.');
            header('Location: contact.php'); exit;
        } catch (PDOException $ex) { $errors['form'] = 'Sorry, your message could not be saved. Please try again.'; }
    }
}
$pageTitle = 'Contact'; $active = 'contact';
require __DIR__ . '/includes/header.php';
?>
<div class="row justify-content-center"><div class="col-lg-7">
  <h1 class="mb-3">Contact Me</h1>
  <?php if (isset($errors['form'])): ?><div class="alert alert-danger"><?= e($errors['form']) ?></div><?php endif; ?>
  <form id="contactForm" method="post" action="contact.php" novalidate>
    <?= csrf_field() ?>
    <?php foreach (['name'=>['Name','text'],'email'=>['Email','email'],'subject'=>['Subject','text']] as $f=>[$label,$type]): ?>
    <div class="mb-3">
      <label for="<?= $f ?>" class="form-label"><?= $label ?></label>
      <input type="<?= $type ?>" class="form-control <?= isset($errors[$f])?'is-invalid':'' ?>" id="<?= $f ?>" name="<?= $f ?>" value="<?= e($old[$f]) ?>" required>
      <div class="invalid-feedback"><?= e($errors[$f] ?? '') ?></div>
    </div>
    <?php endforeach; ?>
    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea class="form-control <?= isset($errors['message'])?'is-invalid':'' ?>" id="message" name="message" rows="5" required><?= e($old['message']) ?></textarea>
      <div class="invalid-feedback"><?= e($errors['message'] ?? '') ?></div>
    </div>
    <button type="submit" class="btn btn-primary">Send Message</button>
  </form>
</div></div>
<?php require __DIR__ . '/includes/footer.php'; ?>
