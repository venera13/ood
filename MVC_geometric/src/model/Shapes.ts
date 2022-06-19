import ShapesObserverInterface from './ShapesObserverInterface.js';
import Shape from './Shape.js';

export default class Shapes
{
    private observers: Array<ShapesObserverInterface> = [];
    private shapes: Array<Shape> = [];

    public addObserver(observer: ShapesObserverInterface)
    {
        this.observers.push(observer);
    }

    public addShape(type: string)
    {
        let shape: Shape = new Shape(type);
        this.shapes.push(shape);

        this.notifyObservers(shape);
    }

    public getShapes(): Array<Shape>
    {
        return this.shapes;
    }

    private notifyObservers(shape: Shape): void
    {
        this.observers.map((observer: ShapesObserverInterface) =>
        {
            observer.onShapeAdded(shape);
        })
    }
}