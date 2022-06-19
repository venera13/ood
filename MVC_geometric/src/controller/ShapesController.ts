import ShapesView from '../view/ShapesView.js';
import Shapes from '../model/Shapes.js';

export default class ShapesController
{
    private readonly shapeView: ShapesView;
    private readonly shapes: Shapes;

    constructor(shapesView: ShapesView, shapes: Shapes)
    {
        this.shapeView = shapesView;
        this.shapes = shapes;
    }

    public selectedShape(index: number): void
    {
        this.shapes.selectedShape(index);
    }

    public unselectedShape(): void
    {
        this.shapes.unselectedShape();
    }

    public resizeFrame(index: number, selectedAngle: string, clickX: number, clickY: number): void
    {
        this.shapes.resizeFrame(index, selectedAngle, clickX, clickY);
    }

    public moveShape(index: number, transformX: number, transformY: number): void
    {
        this.shapes.moveShape(index, transformX, transformY);
    }
}