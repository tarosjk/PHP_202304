<?php
session_start();

require './dbconnect.php';

// エラーメッセージ
$errors = [
  'pizza-name' => '',
  'chef-name'  => '',
  'toppings'   => '',
];

// 再反映用の変数
// $pizzaname = '';
// $chefname = '';
// $toppings = '';
$pizzaname = $chefname = $toppings = '';

if (isset($_POST['submit'])) {
  // 1. エラーチェック（必須入力、最大文字数）
  // 2. データベース登録
  // 3. リダイレクト（TOPページへ）

  // 1.エラーチェック
  if (empty($_POST['pizza-name'])) {
    $errors['pizza-name'] = 'ピザの名前は必須です';
  } else {
    $pizzaname = $_POST['pizza-name'];

    if (mb_strlen($_POST['pizza-name']) > 100) {
      $errors['pizza-name'] = 'ピザの名前は100文字以内で入力してください';
    }
  }

  if (empty($_POST['chef-name'])) {
    $errors['chef-name'] = 'シェフの名前は必須です';
  } else {
    $chefname = $_POST['chef-name'];

    if (mb_strlen($_POST['chef-name']) > 100) {
      $errors['chef-name'] = 'シェフの名前は100文字以内で入力してください';
    }
  }

  if (empty($_POST['toppings'])) {
    $errors['toppings'] = 'トッピングは必須です';
  } else {
    $toppings = $_POST['toppings'];

    if (mb_strlen($_POST['toppings']) > 100) {
      $errors['toppings'] = 'トッピングは100文字以内で入力してください';
    }
  }

  if (!array_filter($errors)) {
    // エラーなし
    // 2.データベースへの登録
    $stmt = $db->prepare('INSERT INTO pizzas (pizzaname, chefname, toppings) VALUES (?,?,?)');
    $stmt->bindValue(1, $_POST['pizza-name']);
    $stmt->bindValue(2, $_POST['chef-name']);
    $stmt->bindValue(3, $_POST['toppings']);
    $result = $stmt->execute();

    if ($result) {
      $_SESSION['success'] = 'ピザの登録が完了しました';

      // 3.リダイレクト（TOPページへ）
      header("location:pizza.php");
      exit; //全処理ストップ
    }
  }
}

?>
<?php include 'templates/header.php'; ?>

<div class="container">
  <h1 class="my-5 text-center h4">ピザの追加</h1>

  <div class="row justify-content-center">
    <div class="col-md-8 p-4 bg-white rounded">
      <form action="add.php" method="post">
        <div class="mb-3">
          <label for="pizza-name" class="form-label">ピザの名前</label>
          <input type="text" class="form-control" id="pizza-name" name="pizza-name" value="<?= $pizzaname ?>" maxlength="100">
          <small class="text-danger"><?= $errors['pizza-name'] ?></small>
        </div>
        <div class="mb-3">
          <label for="chef-name" class="form-label">シェフの名前</label>
          <input type="text" class="form-control" id="chef-name" name="chef-name" value="<?= $chefname ?>" maxlength="100">
          <small class="text-danger"><?= $errors['chef-name'] ?></small>
        </div>
        <div class="mb-3">
          <label for="toppings" class="form-label">トッピング</label>
          <input type="text" class="form-control" id="toppings" name="toppings" value="<?= $toppings ?>">
          <small class="text-danger"><?= $errors['toppings'] ?></small>
        </div>
        <div class="text-center">
          <button class="btn btn-primary">追加する</button>
          <input type="hidden" name="submit" value="submit">
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'templates/footer.php'; ?>