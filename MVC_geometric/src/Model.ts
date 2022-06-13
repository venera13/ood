import Window from './Window.js';
import Observable from './Observable/Observable.js';
import Rectangle from './Shapes/Rectangle.js';
import Point from './Point.js';
import ShapeInterface from './Shapes/ShapeInterface';
import Rect from './Rect.js';
// import ShapeElement from './ShapeElement.js';

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
    // private shapes: Array<ShapeInterface> = [];
    // private shapes: Array<{[key: string]: ShapeInterface}> = [];
    private shapes: Array<{key: string; value: ShapeInterface}> = [];
    private mouseIsDown: boolean = false;
    private selectedShape!: ShapeInterface | null;
    private selectedAngle!: Angle | null;

    constructor()
    {
        super();
        
        this.window = new Window(620, 390);
    }
    
    public handleResizeWindow(width: number, height: number): void
    {
        this.window.width = width;
        this.window.height = height;
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
                this.shapes[index].value.selected = !this.shapes[index].value.selected;

                this.notifyObservers();

                return;
            }
            else
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.selected = false;
            }
        })

        this.notifyObservers();
    }

    public handleMouseDown(event: MouseEvent): void
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        this.shapes.forEach((shapeElement: any) =>
        {
            const shape = shapeElement.value;

            if (clickX >= shape.getFrame().leftTop.x - 3 && clickX <= shape.getFrame().leftTop.x + 3
                && clickY >= shape.getFrame().leftTop.y - 3 && clickY <= shape.getFrame().leftTop.y + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.LEFT_TOP;
                return;
            }
            if (clickX >= shape.getFrame().leftTop.x + shape.getFrame().width - 3 && clickX <= shape.getFrame().leftTop.x + shape.getFrame().width + 3
                && clickY >= shape.getFrame().leftTop.y - 3 && clickY <= shape.getFrame().leftTop.y + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.RIGHT_TOP;
                return;
            }
            if (clickX >= shape.getFrame().leftTop.x + shape.getFrame().width - 3 && clickX <= shape.getFrame().leftTop.x + shape.getFrame().width + 3
                && clickY >= shape.getFrame().leftTop.y + shape.getFrame().height - 3 && clickY <= shape.getFrame().leftTop.y + shape.getFrame().height + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.RIGHT_BOTTOM;
                return;
            }
            if (clickX >= shape.getFrame().leftTop.x - 3 && clickX <= shape.getFrame().leftTop.x + 3
                && clickY >= shape.getFrame().leftTop.y + shape.getFrame().height - 3 && clickY <= shape.getFrame().leftTop.y + shape.getFrame().height + 3)
            {
                this.mouseIsDown = true;
                this.selectedShape = shape;
                this.selectedAngle = Angle.LEFT_BOTTOM;
                return;
            }
        })
    }

    handleMouseMove(event: MouseEvent): void
    {
        const clickX = event.offsetX;
        const clickY = event.offsetY;

        if (this.selectedShape && this.mouseIsDown && this.selectedAngle)
        {
            this.resizeShape(clickX, clickY);
        }
    }

    handleMouseUp(event: MouseEvent): void
    {
        this.selectedShape = null;
        this.mouseIsDown = false;
        this.selectedAngle = null;

        this.notifyObservers();
    }

    getChangedData(): any 
    {
        return {
            'shapes': this.shapes
        };
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

        // const leftTopX = Math.min(shapeFrame.leftTop.x, clickX);
        // const leftTopY = Math.min(shapeFrame.leftTop.y, clickY);
        // const rightBottomX = Math.max(shapeFrame.leftTop.x + shapeFrame.width, clickX);
        // const leftBottomY = Math.max(shapeFrame.leftTop.y + shapeFrame.height, clickY);
        // newFrame = new Rect(new Point(leftTopX, leftTopY), rightBottomX - leftTopX, leftBottomY - leftTopY);

        if (this.selectedAngle == Angle.LEFT_TOP)
        {
            // const leftTopX = (clickX < shapeFrame.leftTop.x) ? Math.min(shapeFrame.leftTop.x, clickX) : clickX;
            // const leftTopY = (clickY < shapeFrame.leftTop.y) ? Math.min(shapeFrame.leftTop.y, clickY) : clickY;
            // const rightBottomX = Math.max(shapeFrame.leftTop.x + shapeFrame.width, clickX);
            // const rightBottomY = Math.max(shapeFrame.leftTop.y + shapeFrame.height, clickY);
            // newFrame = new Rect(new Point(leftTopX, leftTopY), rightBottomX - leftTopX, rightBottomY - leftTopY);
            newFrame = new Rect(new Point(clickX, clickY), Math.abs(shapeFrame.leftTop.x + shapeFrame.width - clickX), Math.abs(shapeFrame.leftTop.y + shapeFrame.height - clickY));
        }
        else if(this.selectedAngle == Angle.LEFT_BOTTOM)
        {
            const leftTopX = (clickX > shapeFrame.leftTop.x) ? clickX : Math.min(shapeFrame.leftTop.x, clickX);
            const leftTopY = shapeFrame.leftTop.y;
            const rightBottomX = Math.max(shapeFrame.leftTop.x + shapeFrame.width, clickX);
            // const rightBottomY = Math.max(shapeFrame.leftTop.y + shapeFrame.height, clickY - shapeFrame.leftTop.y);
            newFrame = new Rect(new Point(leftTopX, leftTopY), rightBottomX - leftTopX, Math.abs(clickY - shapeFrame.leftTop.y));

            // newFrame = new Rect(new Point(clickX, shapeFrame.leftTop.y), Math.abs(shapeFrame.leftTop.x + shapeFrame.width - clickX), Math.abs(clickY - shapeFrame.leftTop.y));
        }
        else if(this.selectedAngle == Angle.RIGHT_TOP)
        {
            const leftTopX = (clickX < shapeFrame.leftTop.x) ? clickX : Math.min(shapeFrame.leftTop.x, clickX);
            const leftTopY = clickY;
            const rightBottomX = Math.max(shapeFrame.leftTop.x + shapeFrame.width, clickX);
            // const rightBottomY = Math.max(shapeFrame.leftTop.y + shapeFrame.height, clickY - shapeFrame.leftTop.y);
            // newFrame = new Rect(new Point(shapeFrame.leftTop.x, clickY), Math.abs(clickX - shapeFrame.leftTop.x), Math.abs(shapeFrame.leftTop.y + shapeFrame.height - clickY));
            newFrame = new Rect(new Point(leftTopX, leftTopY), Math.abs(clickX - shapeFrame.leftTop.x), Math.abs(shapeFrame.leftTop.y + shapeFrame.height - clickY));
        }
        else if(this.selectedAngle == Angle.RIGHT_BOTTOM)
        {
            const leftTopX = (clickX < shapeFrame.leftTop.x) ? clickX : Math.min(shapeFrame.leftTop.x, clickX);
            const leftTopY = shapeFrame.leftTop.y;
            const rightBottomX = Math.max(shapeFrame.leftTop.x + shapeFrame.width, clickX);
            // const rightBottomY = Math.max(shapeFrame.leftTop.y + shapeFrame.height, clickY - shapeFrame.leftTop.y);

            newFrame = new Rect(new Point(leftTopX, leftTopY), Math.abs(clickX - shapeFrame.leftTop.x), Math.abs(clickY - shapeFrame.leftTop.y));
            // newFrame = new Rect(new Point(shapeFrame.leftTop.x, shapeFrame.leftTop.y), Math.abs(clickX - shapeFrame.leftTop.x), Math.abs(clickY - shapeFrame.leftTop.y));
        }

        this.shapes.forEach((shapeElement: any) =>
        {
            console.log(shapeElement.value);
            console.log(shape);
            if (shapeElement.value == shape)
            {
                const index = this.shapes.indexOf(shapeElement, 0);
                this.shapes[index].value.setFrame(newFrame);
            }
        })

        console.log('notify');
        console.log(this.shapes);
        this.notifyObservers();
    }
}