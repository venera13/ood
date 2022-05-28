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
            <?php
            foreach ($params['functions'] as $function)
            {
                ?>
              <div class="harmonics__item"><?= $function?></div>
                <?php
            } ?>
        </div>
        <a class="button" href="/ood/MVC?action=addNew">Add new</a>
        <a class="button" href="/ood/MVC?action=deleteSelected">Delete selected</a>
      </div>
      <div class="drawer__values">
        <div class="values__item">
          <label for="amplitude">Amplitude</label>
          <input type="text" id="amplitude" class="input" />
        </div>
        <div class="values__item">
          <label for="sin">Sin</label>
          <input type="radio" name="function" id="sin" checked />
          <label for="cos">Cos</label>
          <input type="radio" name="function" id="cos" />
        </div>
        <div class="values__item">
          <label for="frequency">Frequency</label>
          <input type="text" id="frequency" class="input" />
        </div>
        <div class="values__item">
          <label for="phase">Phase</label>
          <input type="text" id="phase" class="input" />
        </div>
      </div>
    </div>
    <div class="drawer__wrapper-second-item">
      <img class="image" src="/ood/MVC?action=getChart">
    </div>
  </div>
</div>
</body>
</html>