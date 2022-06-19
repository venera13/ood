import ShapeObserverInterface from './ShapeObserverInterface.js';
import Rect from '../domain/Rect.js';
import Point from '../domain/Point.js';

enum Angle {
    LEFT_TOP = 'left_top',
    LEFT_BOTTOM = 'left_bottom',
    RIGHT_TOP = 'right_top',
    RIGHT_BOTTOM = 'right_bottom',
}

export default class Shape
{
    private _type: string;
    private _selected: boolean = false;
    private _frame: Rect;
    private observers!: Array<ShapeObserverInterface>;
    
    constructor(type: string) 
    {
        this._type = type;
        this._frame = new Rect(new Point(260, 145), 100, 100);
    }

    public addObserver(observer: ShapeObserverInterface)
    {
        this.observers.push(observer);
    }
    
    public resizeFrame(selectedAngle: string, clickX: number, clickY: number): void
    {
        if (selectedAngle == Angle.LEFT_TOP)
        {
            this._frame = new Rect(new Point(clickX, clickY), Math.abs(this.frame.leftTop.x + this.frame.width - clickX), Math.abs(this.frame.leftTop.y + this.frame.height - clickY));
        }
        else if(selectedAngle == Angle.LEFT_BOTTOM)
        {
            const leftTopX = (clickX > this.frame.leftTop.x) ? clickX : Math.min(this.frame.leftTop.x, clickX);
            const leftTopY = this.frame.leftTop.y;
            const rightBottomX = Math.max(this.frame.leftTop.x + this.frame.width, clickX);
            this._frame = new Rect(new Point(leftTopX, leftTopY), rightBottomX - leftTopX, Math.abs(clickY - this.frame.leftTop.y));
        }
        else if(selectedAngle == Angle.RIGHT_TOP)
        {
            const leftTopX = (clickX < this.frame.leftTop.x) ? clickX : Math.min(this.frame.leftTop.x, clickX);
            this._frame = new Rect(new Point(leftTopX, clickY), Math.abs(clickX - this.frame.leftTop.x), Math.abs(this.frame.leftTop.y + this.frame.height - clickY));
        }
        else if(selectedAngle == Angle.RIGHT_BOTTOM)
        {
            const leftTopX = (clickX < this.frame.leftTop.x) ? clickX : Math.min(this.frame.leftTop.x, clickX);
            const leftTopY = this.frame.leftTop.y;

            this._frame = new Rect(new Point(leftTopX, leftTopY), Math.abs(clickX - this.frame.leftTop.x), Math.abs(clickY - this.frame.leftTop.y));
        }
    }
    
    public moveFrame(transformX: number, transformY: number): void
    {
        this._selected = true;
        const leftTopX = (this.frame.leftTop.x + transformX + this.frame.width <= 640 && this.frame.leftTop.x + transformX >= 0) ? this.frame.leftTop.x + transformX : this.frame.leftTop.x;
        const leftTopY = (this.frame.leftTop.y + transformY + this.frame.height <= 390 && this.frame.leftTop.y + transformY >= 0) ? this.frame.leftTop.y + transformY : this.frame.leftTop.y;
        this._frame = new Rect(new Point(leftTopX, leftTopY), this.frame.width, this.frame.height);
    }
    
    get type(): string 
    {
        return this._type;
    }

    get frame(): Rect 
    {
        return this._frame;
    }

    get selected(): boolean
    {
        return this._selected;
    }

    set selected(value: boolean)
    {
        this._selected = value;
    }
}