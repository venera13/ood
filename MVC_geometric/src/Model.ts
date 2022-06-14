import Window from './Window.js';
import Observable from './Observable/Observable.js';
import Rectangle from './Shapes/Rectangle.js';
import Point from './Point.js';
import ShapeInterface from './Shapes/ShapeInterface';
import Rect from './Rect.js';

enum ShapeTypes {
    RECTANGLE = 'rectangle',
    TRIANGLE = 'triangle',
    ELLIPSE = 'ellipse',
}
enum Angle {
    LEFT_TOP = 'left_top',
    LEFT_BOTTOM = 'left_bottom',
    RIGHT_TOP = 'right_top',
    RIGHT_BOTTOM = 'right_bottom',
}

export default class Model extends Observable
{
    private readonly window: Window;
    private shapes: Array<{key: string; value: ShapeInterface}> = [];
    private mouseIsDown: boolean = false;
    private selectedShape!: ShapeInterface | null;
    private selectedAngle!: Angle | null;
    private currentPoint!: Point | null;

    constructor()
    {
        super();
        
        this.window = new Window(620, 390);
    }
    
    public addShape(type: ShapeTypes): void
    {
        switch (type)
        {
            case ShapeTypes.RECTANGLE:
                const shape = new Rectangle(new Point(this.window.width/2 - 50, this.window.height/2 - 50), 100, 100);
                this.shapes.push({key: 'rectangle', value: shape});
                break;
        }
        this.notifyObservers();
    }
    
    public handleClickElement(event: PointerEvent): void
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        this.shapes.forEach((shapeElement: any) =>
        {
            const shape = shapeElement.value;

            if (clickX >= shape.getFrame().leftTop.x && clickX <= shape.getFrame().leftTop.x + shape.getFrame().width
                && clickY >= shape.getFrame().leftTop.y && clickY <= shape.getFrame().leftTop.y + shape.getFrame().height)
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.selected = true;
                this.selectedShape = shape;
                this.mouseIsDown = true;
                this.notifyObservers();

                return;
            }
            else
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.selectedShape = null;
                this.mouseIsDown = false;
                this.shapes[index].value.selected = false;
            }
        })

        this.notifyObservers();
    }

    public handleMouseDown(event: MouseEvent): void
    {
        if (!this.checkClickAngle(event))
        {
            this.checkClickShape(event);
        }
    }

    public handleMouseMove(event: MouseEvent): void
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        if (this.selectedShape && this.mouseIsDown && this.selectedAngle)
        {
            this.resizeShape(clickX, clickY);
        }
        else if (this.selectedShape && this.mouseIsDown)
        {
            this.moveShape(clickX, clickY);
        }
    }

    public handleMouseUp(event: MouseEvent): void
    {
        this.mouseIsDown = false;
        this.selectedAngle = null;
        this.currentPoint = null;

        this.notifyObservers();
    }

    public handleKeyUp(event: KeyboardEvent): void
    {
        if (event.which == 46 && this.selectedShape)
        {
            let index = -1;
            this.shapes.forEach((shapeElement: any) =>
            {
                if (shapeElement.value == this.selectedShape)
                {
                    index = this.shapes.indexOf(shapeElement, 0);
                    return;
                }
            })

            if (index > -1)
            {
                this.shapes.splice(index, 1);
            }

            this.notifyObservers();
        }
    }

    public getChangedData(): any
    {
        return {
            'shapes': this.shapes
        };
    }

    private checkClickShape(event: PointerEvent | MouseEvent): boolean
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        this.currentPoint = new Point(clickX, clickY);

        let hasSelectedShape = false;

        this.shapes.forEach((shapeElement: any) =>
        {
            const shape = shapeElement.value;

            if (clickX >= shape.getFrame().leftTop.x && clickX <= shape.getFrame().leftTop.x + shape.getFrame().width
                && clickY >= shape.getFrame().leftTop.y && clickY <= shape.getFrame().leftTop.y + shape.getFrame().height)
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.selected = true;
                this.selectedShape = shape;
                this.mouseIsDown = true;
                hasSelectedShape = true;
            }
            else
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.selected = false;
            }
        });

        if (!hasSelectedShape)
        {
            this.selectedShape = null;
            this.mouseIsDown = false;
        }

        return hasSelectedShape;
    }

    private checkClickAngle(event: PointerEvent | MouseEvent): boolean
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        let hasSelectedAngle = false;

        this.shapes.forEach((shapeElement: any) =>
        {
            const shape = shapeElement.value;

            if (clickX >= shape.getFrame().leftTop.x - 3 && clickX <= shape.getFrame().leftTop.x + 3
                && clickY >= shape.getFrame().leftTop.y - 3 && clickY <= shape.getFrame().leftTop.y + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.LEFT_TOP;
                hasSelectedAngle = true;
                return;
            }
            else if (clickX >= shape.getFrame().leftTop.x + shape.getFrame().width - 3 && clickX <= shape.getFrame().leftTop.x + shape.getFrame().width + 3
                && clickY >= shape.getFrame().leftTop.y - 3 && clickY <= shape.getFrame().leftTop.y + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.RIGHT_TOP;
                hasSelectedAngle = true;
                return;
            }
            else if (clickX >= shape.getFrame().leftTop.x + shape.getFrame().width - 3 && clickX <= shape.getFrame().leftTop.x + shape.getFrame().width + 3
                && clickY >= shape.getFrame().leftTop.y + shape.getFrame().height - 3 && clickY <= shape.getFrame().leftTop.y + shape.getFrame().height + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.RIGHT_BOTTOM;
                hasSelectedAngle = true;
                return;
            }
            else if (clickX >= shape.getFrame().leftTop.x - 3 && clickX <= shape.getFrame().leftTop.x + 3
                && clickY >= shape.getFrame().leftTop.y + shape.getFrame().height - 3 && clickY <= shape.getFrame().leftTop.y + shape.getFrame().height + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.LEFT_BOTTOM;
                hasSelectedAngle = true;
                return;
            }
        });

        return hasSelectedAngle;
    }

    private resizeShape(clickX: number, clickY: number)
    {
        if (!this.selectedShape)
        {
            return;
        }

        const shape = this.selectedShape;
        let newFrame: Rect;
        const shapeFrame = shape?.getFrame();

        if (this.selectedAngle == Angle.LEFT_TOP)
        {
            newFrame = new Rect(new Point(clickX, clickY), Math.abs(shapeFrame.leftTop.x + shapeFrame.width - clickX), Math.abs(shapeFrame.leftTop.y + shapeFrame.height - clickY));
        }
        else if(this.selectedAngle == Angle.LEFT_BOTTOM)
        {
            const leftTopX = (clickX > shapeFrame.leftTop.x) ? clickX : Math.min(shapeFrame.leftTop.x, clickX);
            const leftTopY = shapeFrame.leftTop.y;
            const rightBottomX = Math.max(shapeFrame.leftTop.x + shapeFrame.width, clickX);
            newFrame = new Rect(new Point(leftTopX, leftTopY), rightBottomX - leftTopX, Math.abs(clickY - shapeFrame.leftTop.y));
        }
        else if(this.selectedAngle == Angle.RIGHT_TOP)
        {
            const leftTopX = (clickX < shapeFrame.leftTop.x) ? clickX : Math.min(shapeFrame.leftTop.x, clickX);
            newFrame = new Rect(new Point(leftTopX, clickY), Math.abs(clickX - shapeFrame.leftTop.x), Math.abs(shapeFrame.leftTop.y + shapeFrame.height - clickY));
        }
        else if(this.selectedAngle == Angle.RIGHT_BOTTOM)
        {
            const leftTopX = (clickX < shapeFrame.leftTop.x) ? clickX : Math.min(shapeFrame.leftTop.x, clickX);
            const leftTopY = shapeFrame.leftTop.y;

            newFrame = new Rect(new Point(leftTopX, leftTopY), Math.abs(clickX - shapeFrame.leftTop.x), Math.abs(clickY - shapeFrame.leftTop.y));
        }

        this.shapes.forEach((shapeElement: any) =>
        {
            if (shapeElement.value == shape)
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.setFrame(newFrame);
                return;
            }
        })

        this.notifyObservers();
    }

    private moveShape(clickX: number, clickY: number): void
    {
        if (!this.selectedShape || !this.currentPoint)
        {
            return;
        }

        const transformX = clickX - this.currentPoint.x;
        const transformY = clickY - this.currentPoint.y;

        this.currentPoint = new Point(clickX, clickY);

        const shape = this.selectedShape;
        let newFrame: Rect;
        const shapeFrame = shape?.getFrame();

        const leftTopX = (shapeFrame.leftTop.x + transformX + shapeFrame.width <= this.window.width + 20 && shapeFrame.leftTop.x + transformX >= 0) ? shapeFrame.leftTop.x + transformX : shapeFrame.leftTop.x;
        const leftTopY = (shapeFrame.leftTop.y + transformY + shapeFrame.height <= this.window.height && shapeFrame.leftTop.y + transformY >= 0) ? shapeFrame.leftTop.y + transformY : shapeFrame.leftTop.y;
        newFrame = new Rect(new Point(leftTopX, leftTopY), shapeFrame.width, shapeFrame.height);

        this.shapes.forEach((shapeElement: any) =>
        {
            if (shapeElement.value == shape)
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.setFrame(newFrame);
                return;
            }
        })

        this.notifyObservers();
    }
}