<?php
session_start();
$_SESSION['test'] = 'テストです';

require './dbconnect.php';

$sql = 'SELECT id,pizzaname,toppings FROM pizzas ORDER BY created_at DESC';
$result = $db->query($sql);

if ($result) {
  // $data = $result->fetch(); //1件のみデータを取得
  $pizzas = $result->fetchAll(); //全件データを取得
  // var_dump($pizzas);
} else {
  echo 'データベースへの要求に失敗しました';
}

?>
<?php include 'templates/header.php'; ?>

<div class="container">
  <h1 class="text-center display-4 my-5">Our Special Pizzas</h1>

  <?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
      </svg>
      <svg class="flex-shrink-0 me-2" role="img" aria-label="Success:" style="width: 1em; height: 1em;">
        <use xlink:href="#check-circle-fill" />
      </svg>
      <div>
        <?= htmlspecialchars($_SESSION['success']) ?>
      </div>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <div class="row">
    <?php foreach ($pizzas as $pizza) : ?>
      <div class="col-4 mb-4">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title h5"><?= htmlspecialchars($pizza['pizzaname']) ?></h2>
            <p class="card-text"><?= htmlspecialchars($pizza['toppings']) ?></p>
            <a href="detail.php?id=<?= $pizza['id'] ?>" class="btn btn-primary">詳細</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include 'templates/footer.php'; ?>