<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  $str = 'こんにちは世界';

  ?>
  <?= $str; ?>

  <?php
  define('NAME', 'ケンシロウ'); //1.定数名, 2.定数に入れるデータ
  echo NAME;
  ?>

  <br>

  <?php
  $one = '私の名前は';
  $two = "ケンシロウ";
  echo $one . $two;
  echo "私の弟の名前は{$two}です";

  // Heredoc
  $three = <<<HOKUTO
<br>
199x年世界は核の炎に包まれた<br>
私の名前は{$two}です

HOKUTO;

  echo $three;

  ?>

  <?php
  echo "今は午後12時50分ごろです\n";
  echo "休み時間は10分間です";
  ?>
  <br>
  <?php
  $first_name = 'ドラえもん';
  echo strlen($first_name);
  echo mb_strlen($first_name);
  ?>

  <br>

  <?php
  $num = 1.1;
  echo ceil($num);
  ?>

  <br>

  <?php
  $numbers = [20, 30, 40, 50];
  // print_r($numbers);
  ?>

  <pre>
<?php var_dump($numbers); ?>
</pre>

  <?php
  $numbers[] = 60;
  print_r($numbers);
  array_push($numbers, 70, 80, 90);
  print_r($numbers);
  ?>

  <br>

  <?php
  $hokuto = ['ケンシロウ', 'ラオウ', 'トキ'];
  $nanto = ['レイ', 'ユダ', 'シン'];
  $mixed = array_merge($hokuto, $nanto);
  $hokutonanto = sort($mixed);
  print_r($mixed);
  ?>

  <?php
  $ages = [
    'kenshiro' => 18,
    'bat'      => 10,
    'rin'      => 7
  ];

  echo $ages['kenshiro'];

  ?>

  <br>

  <?php
  $machine = [
    ['ファミリーコンピューター', '任天堂', 1983],
    ['メガドライブ', 'セガ', 1988],
    ['ネオジオ', 'SNK', 1990],
  ];
  print_r($machine[1]);
  echo $machine[1][1];

  $machine = [
    ['name' => 'ファミリーコンピューター', 'brand' => '任天堂', 'year' => 1983],
    ['name' => 'メガドライブ', 'brand' => 'セガ', 'year' => 1988],
    ['name' => 'ネオジオ', 'brand' => 'SNK', 'year' => 1990],
  ];
  echo $machine[2]['name'];
  ?>
  <br>

  <?php
  $names = ['ケンシロウ', 'ラオウ', 'レイ'];
  echo count($names);
  for ($i = 0; $i < count($names); $i++) {
    echo $names[$i] . '<br>';
  }

  foreach ($names as $name) {
    echo $name . '<br>';
  }

  ?>

  <?php
  $machines = [
    [
      'name' => 'ファミリーコンピューター',
      'brand' => '任天堂',
      'year' => 1983
    ],
    ['name' => 'メガドライブ', 'brand' => 'セガ', 'year' => 1988],
    ['name' => 'ネオジオ', 'brand' => 'SNK', 'year' => 1990],
  ];

  foreach ($machines as $machine) {
    echo "<p>{$machine['name']} - {$machine['brand']}（{$machine['year']}）</p>";
  }
  ?>

  <h1>ゲーム機の変遷</h1>
  <ul>
    <?php foreach ($machines as $machine) : ?>
      <li><?= $machine['name'] ?> - <?= $machine['brand'] ?>（<?= $machine['year'] ?>）</li>
    <?php endforeach; ?>
  </ul>

  <?php
  var_dump(5 < 10);
  echo 5 < 10;
  ?>

  <?php
  echo formatYenPrice(1000);

  function formatYenPrice($price = 500)
  {
    return $price . '円';
  }

  ?>

  <br>

  <?php
  $name = 'ケンシロウ';

  function outputName()
  {
    global $name;
    echo '俺の名前は' . $name;
  }

  outputName();


  ?>


</body>

</html>