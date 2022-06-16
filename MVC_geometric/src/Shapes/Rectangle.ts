import ShapeInterface from './ShapeInterface.js';
import Rect from '../Rect.js';
import Point from '../Point.js';

export default class Rectangle implements ShapeInterface
{
    private _leftTop: Point;
    private _width: number;
    private _height: number;
    private _selected: boolean = false;

    constructor(leftTop: Point, width: number, height: number)
    {
        this._leftTop = leftTop;
        this._width = width;
        this._height = height;
    }

    get leftTop(): Point
    {
        return this._leftTop;
    }

    get width(): number
    {
        return this._width;
    }

    get height(): number
    {
        return this._height;
    }

    get selected(): boolean
    {
        return this._selected;
    }

    getFrame(): Rect
    {
        return new Rect(this._leftTop, this._width, this._height);
    }

    setFrame(rect: Rect): void
    {
        this._leftTop = rect.leftTop;
        this._width = rect.width;
        this._height = rect.height;
    }

    set selected(value: boolean)
    {
        this._selected = value;
    }
}