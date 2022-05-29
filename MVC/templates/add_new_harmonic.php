<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add new harmonic</title>
    <link href="styles/add_new_harmonic.css" rel="stylesheet" />
</head>
<body>
<div class="add-new-harmonic">
  <h1 class="title">Add new harmonic</h1>
  <div class="add-new-harmonic__values">
    <div class="add-new-harmonic__item">
      <label for="amplitude">Amplitude</label>
      <input type="text" id="amplitude" class="input" value="<?= $params['harmonic_value']['amplitude'] ?>"
             onchange="document.location.href='/ood/MVC?action=addNew&harmonic_type=<?= $params['harmonic_value']['harmonic_type'] ?>&frequency=<?= $params['harmonic_value']['frequency'] ?>&phase=<?= $params['harmonic_value']['phase'] ?>&amplitude=' + this.value" />
    </div>
    <div class="add-new-harmonic__item">
      <label for="sin">Sin</label>
      <input type="radio" name="function" id="sin" <?php if ($params['harmonic_value']['harmonic_type'] === 'sin'): ?>checked <?php endif ?> value="sin"
             onchange="document.location.href='/ood/MVC?action=addNew&amplitude=<?= $params['harmonic_value']['amplitude'] ?>&frequency=<?= $params['harmonic_value']['frequency'] ?>&phase=<?= $params['harmonic_value']['phase'] ?>&harmonic_type=' + this.value" />
      <label for="cos">Cos</label>
      <input type="radio" name="function" id="cos" <?php if ($params['harmonic_value']['harmonic_type'] === 'cos'): ?>checked <?php endif ?> value="cos"
             onchange="document.location.href='/ood/MVC?action=addNew&amplitude=<?= $params['harmonic_value']['amplitude'] ?>&frequency=<?= $params['harmonic_value']['frequency'] ?>&phase=<?= $params['harmonic_value']['phase'] ?>&harmonic_type=' + this.value" />
    </div>
    <div class="add-new-harmonic__item">
      <label for="frequency">Frequency</label>
      <input type="text" id="frequency" class="input" value="<?= $params['harmonic_value']['frequency'] ?>"
             onchange="document.location.href='/ood/MVC?action=addNew&harmonic_type=<?= $params['harmonic_value']['harmonic_type'] ?>&amplitude=<?= $params['harmonic_value']['amplitude'] ?>&phase=<?= $params['harmonic_value']['phase'] ?>&frequency=' + this.value" />
    </div>
    <div class="add-new-harmonic__item">
      <label for="phase">Phase</label>
      <input type="text" id="phase" class="input" value="<?= $params['harmonic_value']['phase'] ?>"
             onchange="document.location.href='/ood/MVC?action=addNew&harmonic_type=<?= $params['harmonic_value']['harmonic_type'] ?>&amplitude=<?= $params['harmonic_value']['amplitude'] ?>&frequency=<?= $params['harmonic_value']['frequency'] ?>&phase=' + this.value" />
    </div>
    <div class="text"><?= $params['harmonic'] ?? '' ?></div>
    <a class="button" href="/ood/MVC?action=addNewHarmonic&&harmonic_type=<?= $params['harmonic_value']['harmonic_type'] ?>&amplitude=<?= $params['harmonic_value']['amplitude'] ?>&frequency=<?= $params['harmonic_value']['frequency'] ?>&phase=<?= $params['harmonic_value']['phase'] ?>">Ok</a>
    <a class="button" href="/ood/MVC?action=addNewHarmonicCancel">Cancel</a>
  </div>
</div>
</body>