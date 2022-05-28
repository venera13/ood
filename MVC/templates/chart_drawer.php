<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chart Drawer</title>
  <link href="styles/chart_drawer.css" rel="stylesheet" />
</head>
<body>
<div class="drawer">
  <h1 class="title">Chart Drawer</h1>
  <div class="drawer__wrapper">
    <div class="drawer__wrapper-first-item">
      <div class="drawer__harmonics">
        <h2 class="drawer__harmonics-title">Harmonics</h2>
        <div class="harmonics">
            <?php if (count($params) !== 0): ?>
            <?php foreach ($params['harmonics'] as $key => $function) { ?>
              <a class="harmonics__item <?php if ($key === $params['active']): ?>active<?php endif; ?>"
                   href="/ood/MVC?action=switchHarmonic&index=<?= $key ?? 0 ?>" >
                  <?= $function ?>
              </a>
            <?php } ?>
          <?php endif; ?>
        </div>
        <a class="button" href="/ood/MVC?action=addNew">Add new</a>
        <a class="button" href="/ood/MVC?action=deleteSelected&index=<?= $key ?? 0 ?>">Delete selected</a>
      </div>
      <div class="drawer__values">
        <div class="values__item">
          <label for="amplitude">Amplitude</label>
          <input type="text" id="amplitude" class="input"
                 value="<?= count($params) !== 0 ? $params['harmonic_value']['amplitude'] : '' ?>"
                 onchange="document.location.href='/ood/MVC?action=changeHarmonic&index=<?= count($params) ? $params['active'] ?? 0 : 0 ?>&key=amplitude&value=' + this.value"
          />
        </div>
        <div class="values__item">
          <label for="sin">Sin</label>
          <input type="radio" name="function" id="sin" <?php if (count($params) !== 0 && $params['harmonic_value']['is_sin']): ?>checked <?php endif ?> value="sin"
                 onchange="document.location.href='/ood/MVC?action=changeHarmonic&index=<?= count($params) ? $params['active'] ?? 0 : 0 ?>&key=harmonic_type&value=' + this.value"/>
          <label for="cos">Cos</label>
          <input type="radio" name="function" id="cos" <?php if (count($params) !== 0 && $params['harmonic_value']['is_cos']): ?>checked <?php endif ?> value="cos"
                 onchange="document.location.href='/ood/MVC?action=changeHarmonic&index=<?= count($params) ? $params['active'] ?? 0 : 0 ?>&key=harmonic_type&value=' + this.value"/>
        </div>
        <div class="values__item">
          <label for="frequency">Frequency</label>
          <input type="text" id="frequency" class="input" value="<?= count($params) !== 0 ? $params['harmonic_value']['frequency'] : '' ?>"
                 onchange="document.location.href='/ood/MVC?action=changeHarmonic&index=<?= count($params) !== 0 ? $params['active'] ?? 0 : 0 ?>&key=frequency&value=' + this.value"/>
        </div>
        <div class="values__item">
          <label for="phase">Phase</label>
          <input type="text" id="phase" class="input" value="<?= count($params) !== 0 ? $params['harmonic_value']['phase'] : '' ?>"
                 onchange="document.location.href='/ood/MVC?action=changeHarmonic&index=<?= count($params) !== 0 ? $params['active'] ?? 0 : 0 ?>&key=phase&value=' + this.value"/>
        </div>
      </div>
    </div>
    <div class="drawer__wrapper-second-item" id="container">
      <img class="image" src="/ood/MVC?action=getChart">
    </div>
  </div>
</div>
</body>
</html>