import ShapesObserverInterface from '../model/ShapesObserverInterface.js';
import Shape from '../model/Shape.js';
import Shapes from '../model/Shapes.js';
import RectangleView from './RectangleView.js';
import EllipseView from './EllipseView.js';
import TriangleView from './TriangleView.js';

export default class ShapesView implements ShapesObserverInterface
{
    private readonly shapes: Shapes;
    private canvas: any = null;

    constructor(shapes: Shapes)
    {
        this.shapes = shapes;
    }

    public onShapeAdded(shape: Shape): void
    {
        this.initContext();
        this.canvas.clearRect(0, 0, 640, 390);

        if (!this.canvas)
        {
            return;
        }
        
        const shapes = this.shapes.getShapes();

        shapes.forEach((shape: Shape) =>
        {
            if (shape.type == 'rectangle')
            {
                const view: RectangleView = new RectangleView(this.canvas, shape.frame);
                view.render();
            }
            else if (shape.type == 'ellipse')
            {
                const view: EllipseView = new EllipseView(this.canvas, shape.frame);
                view.render();
            }
            else if (shape.type == 'triangle')
            {
                const view: TriangleView = new TriangleView(this.canvas, shape.frame);
                view.render();
            }

            if (shape.selected)
            {
                this.canvas.strokeStyle = '#2f3c76';
                this.canvas.strokeRect(shape.frame.leftTop.x, shape.frame.leftTop.y, shape.frame.width, shape.frame.height);
                this.canvas.beginPath();
                this.canvas.fillStyle = '#181f40';
                this.canvas.beginPath();
                this.canvas.ellipse(shape.frame.leftTop.x, shape.frame.leftTop.y, 3, 3, 0, 2 * Math.PI, false);
                this.canvas.fill();
                this.canvas.beginPath();
                this.canvas.ellipse(shape.frame.leftTop.x + shape.frame.width, shape.frame.leftTop.y, 3, 3, 0, 2 * Math.PI, false);
                this.canvas.fill();
                this.canvas.beginPath();
                this.canvas.ellipse(shape.frame.leftTop.x + shape.frame.width, shape.frame.leftTop.y + shape.frame.height, 3, 3, 0, 2 * Math.PI, false);
                this.canvas.fill();
                this.canvas.beginPath();
                this.canvas.ellipse(shape.frame.leftTop.x, shape.frame.leftTop.y + shape.frame.height, 3, 3, 0, 2 * Math.PI, false);
                this.canvas.fill();
            }
        })
    }

    private initContext(): void
    {
        if (this.canvas)
        {
            return;
        }

        const canvas: any = document.getElementById('canvas');
        if (canvas.getContext)
        {
            this.canvas = canvas.getContext('2d');
        }
    }
}