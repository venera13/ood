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

        this.notifyObservers();
    }

    public getShapes(): Array<Shape>
    {
        return this.shapes;
    }

    public selectedShape(index: number): void
    {
        this.shapes[index].selected = true;

        this.notifyObservers();
    }

    public unselectedShape(): void
    {
        this.shapes.map((shape: Shape) =>
        {
            shape.selected = false;
        });

        this.notifyObservers();
    }

    public resizeFrame(index: number, selectedAngle: string, clickX: number, clickY: number): void
    {
        this.shapes[index].resizeFrame(selectedAngle, clickX, clickY);

        this.notifyObservers();
    }

    public moveShape(index: number, transformX: number, transformY: number): void
    {
        this.shapes[index].moveFrame(transformX, transformY);

        this.notifyObservers();
    }

    private notifyObservers(): void
    {
        this.observers.map((observer: ShapesObserverInterface) =>
        {
            observer.renderShapes();
        })
    }
}