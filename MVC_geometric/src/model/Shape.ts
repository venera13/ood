import ShapeObserverInterface from './ShapeObserverInterface.js';
import Rect from '../domain/Rect.js';
import Point from '../domain/Point.js';

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

    public addObserver(observer: ShapeObserverInterface)
    {
        this.observers.push(observer);
    }
}