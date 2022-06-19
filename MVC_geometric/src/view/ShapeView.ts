import ShapeObserverInterface from '../model/ShapeObserverInterface.js';
import ShapeController from '../controller/ShapeController.js';
import Shape from '../model/Shape.js';

export default class ShapeView implements ShapeObserverInterface
{
    private readonly controller: ShapeController;
    private readonly shape: Shape;

    constructor(shape: Shape)
    {
        this.shape = shape;

        this.controller = new ShapeController(this, this.shape);
    }

    public onShapeChanged(): void
    {

    }
}