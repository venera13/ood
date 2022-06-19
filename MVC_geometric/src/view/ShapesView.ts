import ShapesObserverInterface from '../model/ShapesObserverInterface.js';
import Shape from '../model/Shape.js';
import Shapes from '../model/Shapes.js';
import RectangleView from './RectangleView.js';
import EllipseView from './EllipseView.js';
import TriangleView from './TriangleView.js';
import Point from '../domain/Point.js';
import ShapesController from '../controller/ShapesController.js';

enum Angle {
    LEFT_TOP = 'left_top',
    LEFT_BOTTOM = 'left_bottom',
    RIGHT_TOP = 'right_top',
    RIGHT_BOTTOM = 'right_bottom',
}

export default class ShapesView implements ShapesObserverInterface
{
    private readonly shapes: Shapes;
    private readonly controller: ShapesController;
    private canvas: any = null;

    private mouseIsDown: boolean = false;
    private selectedAngle!: string | null;
    private currentPoint!: Point | null;
    private selectedShape!: number | null;

    constructor(shapes: Shapes)
    {
        this.shapes = shapes;
        this.controller = new ShapesController(this, this.shapes);
    }

    public renderShapes(): void
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

            this.mouseEvent();
            this.keyEvent();
        }
    }
    
    private mouseEvent(): void
    {
        const el = document.getElementById('canvas');
        el?.addEventListener('mouseup', () => this.handleMouseUp(), false);
        el?.addEventListener('click', (event: any) => this.handleClickElement(event), false);
        el?.addEventListener('mousedown', (event: any) => this.handleMouseDown(event), false);
        el?.addEventListener('mousemove', (event: any) => this.handleMouseMove(event), false);
    }

    private keyEvent(): void
    {
        document.addEventListener('keyup', (event: KeyboardEvent) => this.handleKeyUp(event), false);
    }

    private handleMouseUp(): void
    {
        this.mouseIsDown = false;
        this.selectedAngle = null;
        this.currentPoint = null;
    }

    private handleKeyUp(event: KeyboardEvent): void
    {
        if (event.which == 46 && this.selectedShape !== null)
        {
            this.controller.removeShape(this.selectedShape);
        }
    }

    private handleClickElement(event: PointerEvent): void
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        this.shapes.getShapes().forEach((shape: Shape, index: number) =>
        {
            if (clickX >= shape.frame.leftTop.x && clickX <= shape.frame.leftTop.x + shape.frame.width
                && clickY >= shape.frame.leftTop.y && clickY <= shape.frame.leftTop.y + shape.frame.height)
            {
                this.mouseIsDown = true;
                this.controller.selectedShape(index);

                return;
            }
            else
            {
                this.mouseIsDown = false;
                this.controller.unselectedShape(index);
            }
        })
    }

    private handleMouseDown(event: MouseEvent): void
    {
        if (!this.checkClickAngle(event))
        {
            this.checkClickShape(event);
        }
    }

    private checkClickShape(event: PointerEvent | MouseEvent): boolean
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        this.currentPoint = new Point(clickX, clickY);

        let hasSelectedShape = false;

        this.shapes.getShapes().forEach((shape: Shape, index: number) =>
        {
            if (clickX >= shape.frame.leftTop.x && clickX <= shape.frame.leftTop.x + shape.frame.width
                && clickY >= shape.frame.leftTop.y && clickY <= shape.frame.leftTop.y + shape.frame.height)
            {
                this.selectedShape = index;
                this.mouseIsDown = true;
                hasSelectedShape = true;
            }
        });

        return hasSelectedShape;
    }

    private checkClickAngle(event: PointerEvent | MouseEvent): boolean
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        let hasSelectedAngle = false;

        this.shapes.getShapes().forEach((shape: Shape, index: number) =>
        {
            if (clickX >= shape.frame.leftTop.x - 3 && clickX <= shape.frame.leftTop.x + 3
                && clickY >= shape.frame.leftTop.y - 3 && clickY <= shape.frame.leftTop.y + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = index;
                this.selectedAngle = Angle.LEFT_TOP;
                hasSelectedAngle = true;
                return;
            }
            else if (clickX >= shape.frame.leftTop.x + shape.frame.width - 3 && clickX <= shape.frame.leftTop.x + shape.frame.width + 3
                && clickY >= shape.frame.leftTop.y - 3 && clickY <= shape.frame.leftTop.y + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = index;
                this.selectedAngle = Angle.RIGHT_TOP;
                hasSelectedAngle = true;
                return;
            }
            else if (clickX >= shape.frame.leftTop.x + shape.frame.width - 3 && clickX <= shape.frame.leftTop.x + shape.frame.width + 3
                && clickY >= shape.frame.leftTop.y + shape.frame.height - 3 && clickY <= shape.frame.leftTop.y + shape.frame.height + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = index;
                this.selectedAngle = Angle.RIGHT_BOTTOM;
                hasSelectedAngle = true;
                return;
            }
            else if (clickX >= shape.frame.leftTop.x - 3 && clickX <= shape.frame.leftTop.x + 3
                && clickY >= shape.frame.leftTop.y + shape.frame.height - 3 && clickY <= shape.frame.leftTop.y + shape.frame.height + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = index;
                this.selectedAngle = Angle.LEFT_BOTTOM;
                hasSelectedAngle = true;
                return;
            }
        });

        return hasSelectedAngle;
    }

    private handleMouseMove(event: MouseEvent): void
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        if (this.selectedShape !== null && this.mouseIsDown && this.selectedAngle)
        {
            this.controller.resizeFrame(this.selectedShape, this.selectedAngle, clickX, clickY);
        }
        else if (this.selectedShape !== null && this.mouseIsDown && this.currentPoint)
        {
            const transformX = clickX - this.currentPoint.x;
            const transformY = clickY - this.currentPoint.y;

            this.currentPoint = new Point(clickX, clickY);

            this.controller.moveShape(this.selectedShape, transformX, transformY);
        }
    }
}