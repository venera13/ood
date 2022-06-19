import Rect from '../../domain/Rect.js';
import Point from '../../domain/Point.js';

export default class Rectangle
{
    private _leftTop!: Point;
    private _width!: number;
    private _height!: number;

    constructor(frame: Rect)
    {
        this.setFrame(frame)
    }

    public getFrame(): Rect
    {
        return new Rect(this._leftTop, this._width, this._height);
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

    private setFrame(rect: Rect): void
    {
        this._leftTop = rect.leftTop;
        this._width = rect.width;
        this._height = rect.height;
    }
}