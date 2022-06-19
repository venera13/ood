import Shapes from './model/Shapes.js';
import ToolbarView from './view/ToolbarView.js';
import ShapesView from './view/ShapesView.js';
import WindowView from './view/WindowView.js';

const shapes = new Shapes();
const shapesView = new ShapesView(shapes);
shapes.addObserver(shapesView);

new WindowView();
const toolbarView = new ToolbarView(shapes);
