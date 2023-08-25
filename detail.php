<?php
session_start();

require './dbconnect.php';

// 削除用
if (isset($_POST['delete'])) {
  $stmt = $db->prepare('DELETE FROM pizzas WHERE id = ?');
  $stmt->bindValue(1, $_POST['delete']);
  $result = $stmt->execute();
  $affectedRow = $stmt->rowCount();
  if ($result && $affectedRow) {
    // echo '削除成功';
    header('location: pizza.php');
    exit;
  }
}

// 表示用
if (isset($_GET['id'])) {
  // １件のデータを取得
  $stmt = $db->prepare('SELECT * FROM pizzas WHERE id = ?');
  $stmt->bindValue(1, $_GET['id']);
  $result = $stmt->execute();

  if ($result) {
    $pizza = $stmt->fetch();
  }
} else {
  header('location:pizza.php');
  exit;
}

?>
<?php include 'templates/header.php'; ?>

<div class="container">
  <h1 class="text-center display-4 my-5">Pizza Detail</h1>

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

  <?php if (isset($pizza) && !empty($pizza)) : ?>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header text-center">
            <h2 class="h4 fw-bold"><?= htmlspecialchars($pizza['pizzaname']) ?></h2>
          </div>
          <div class="card-body">
            <p class="fw-bold">トッピング</p>
            <p class="card-text">
              <?= htmlspecialchars($pizza['toppings']) ?>
            </p>
            <p class="card-text"><span class="fw-bold">シェフ</span> <?= htmlspecialchars($pizza['chefname']) ?></p>
            <p class="card-text"><span class="fw-bold">登録日</span> <?= htmlspecialchars($pizza['created_at']) ?></p>
          </div>
          <div class="card-footer d-flex justify-content-end">
            <a href="update.php?id=<?= htmlspecialchars($pizza['id']) ?>" class="btn btn-primary me-2">編集</a>
            <form name="delete" action="detail.php" method="post" id="delete-form">
              <button class="btn btn-danger" id="btn-delete">削除</button>
              <input type="hidden" name="delete" value="<?= htmlspecialchars($pizza['id']) ?>">
            </form>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <p>ピザの情報がありません。</p>
  <?php endif; ?>
</div>

<script>
  const deleteForm = document.querySelector('#delete-form')
  deleteForm.addEventListener('submit', e => {
    e.preventDefault() //フォームの送信ストップ
    const result = confirm('本当に削除しますか？')
    // console.log(result)
    if (result) {
      // フォームの送信を行う
      deleteForm.submit()
    }
  })
</script>

<?php include 'templates/footer.php'; ?>