import ShapeInterface from './ShapeInterface';
import Rect from '../Rect.js';
import Point from '../Point.js';

export default class Ellipse implements ShapeInterface
{
    private _center: Point;
    private _verticalRadius: number;
    private _horizontalRadius: number;
    private _selected: boolean = false;

    constructor(center: Point, verticalRadius: number, horizontalRadius: number)
    {
        this._center = center;
        this._verticalRadius = verticalRadius;
        this._horizontalRadius = horizontalRadius;
    }

    getFrame(): Rect
    {
        const leftTop = new Point(this._center.x - this._horizontalRadius, this._center.y - this._verticalRadius);
        return new Rect(leftTop, this._horizontalRadius * 2, this._verticalRadius * 2);
    }

    setFrame(rect: Rect): void 
    {
        this._center = new Point(rect.leftTop.x + rect.width/2, rect.leftTop.y + rect.height/2);
        this._verticalRadius = rect.height/2;
        this._horizontalRadius = rect.width/2;

    }

    get center(): Point
    {
        return this._center;
    }

    get verticalRadius(): number
    {
        return this._verticalRadius;
    }

    get horizontalRadius(): number
    {
        return this._horizontalRadius;
    }

    get selected(): boolean
    {
        return this._selected;
    }

    set center(value: Point)
    {
        this._center = value;
    }

    set verticalRadius(value: number)
    {
        this._verticalRadius = value;
    }

    set horizontalRadius(value: number)
    {
        this._horizontalRadius = value;
    }

    set selected(value: boolean)
    {
        this._selected = value;
    }
}