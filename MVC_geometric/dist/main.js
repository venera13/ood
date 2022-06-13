import Model from './Model.js';
import View from './View.js';
var model = new Model();
var view = new View(model);
model.registerObserver(view);
