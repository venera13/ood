import Shape from '../model/Shape.js';
import ShapeView from '../view/ShapeView.js';

export default class ShapeController
{
    private readonly shapeView: ShapeView;
    private readonly shape: Shape;
    
    constructor(shapeView: ShapeView, shape: Shape) 
    {
        this.shapeView = shapeView;
        this.shape = shape;
    }
}