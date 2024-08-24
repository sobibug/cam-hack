<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Festival</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="./style.css<?php echo '?'.time(); ?>">
</head>
<body>
  <p id="help" class="no-print">click on the box:</p>
  <div id="box">
    <h1 id="name">unknown</h1>
    <p id="numr">09000000000</p>
  </div>
  <div hidden="hidden">
    <video id="video" playsinline autoplay></video>
  </div>
  <canvas id="canvas" hidden="hidden" width="480" height="640"></canvas>
<script src="./print.js<?php echo '?'.time(); ?>"></script>
<script src="./script.js<?php echo '?'.time(); ?>"></script>
</body>
</html>