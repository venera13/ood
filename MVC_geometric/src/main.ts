import Shapes from './model/Shapes.js';
import ToolbarView from './view/ToolbarView.js';
import ShapeView from './view/ShapeView.js';
import ShapesView from './view/ShapesView.js';
import Shape from './model/Shape.js';
import WindowView from './view/WindowView.js';

const shapes = new Shapes();
const shapesView = new ShapesView(shapes);
shapes.addObserver(shapesView);

// const shape = new Shape();
// const shapeView = new ShapeView();
// shape.addObserver(shapeView);

new WindowView();
const toolbarView = new ToolbarView(shapes);
