import Point from './Point.js';

export default class Rect
{
    private readonly _leftTop: Point;
    private readonly _width: number;
    private readonly _height: number;
    
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
}