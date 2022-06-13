import Model from './Model.js';
import View from './View.js';

const model = new Model();
const view = new View(model);
model.registerObserver(view);
