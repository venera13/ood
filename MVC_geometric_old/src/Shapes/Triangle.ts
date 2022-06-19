import ShapeInterface from './ShapeInterface';
import Rect from '../Rect.js';
import Point from '../Point.js';

export default class Triangle implements ShapeInterface
{
    private _vertex1: Point;
    private _vertex2: Point;
    private _vertex3: Point;
    private _selected: boolean = false;

    constructor(vertex1: Point, vertex2: Point, vertex3: Point)
    {
        this._vertex1 = vertex1;
        this._vertex2 = vertex2;
        this._vertex3 = vertex3;
    }

    getFrame(): Rect
    {
        const minX = Math.min(this._vertex1.x, this._vertex2.x, this._vertex3.x);
        const minY = Math.min(this._vertex1.y, this._vertex2.y, this._vertex3.y);
        const maxX = Math.max(this._vertex1.x, this._vertex2.x, this._vertex3.x);
        const maxY = Math.max(this._vertex1.y, this._vertex2.y, this._vertex3.y);

        return new Rect(new Point(minX, minY), maxX - minX, maxY - minY);
    }

    setFrame(rect: Rect): void 
    {
        const currentFrame = this.getFrame();
        this._vertex1 = Triangle.getNewVertex(rect, currentFrame, this._vertex1);
        this._vertex2 = Triangle.getNewVertex(rect, currentFrame, this._vertex2);
        this._vertex3 = Triangle.getNewVertex(rect, currentFrame, this._vertex3);
    }

    private static getNewVertex(rect: Rect, currentFrame: Rect, point: Point): Point
    {
        const x = rect.leftTop.x + (point.x - currentFrame.leftTop.x) / currentFrame.width * rect.width;
        const y = rect.leftTop.y + (point.y - currentFrame.leftTop.y) / currentFrame.height * rect.height;
        return new Point(x, y);
    }

    get vertex1(): Point
    {
        return this._vertex1;
    }

    get vertex2(): Point
    {
        return this._vertex2;
    }

    get vertex3(): Point
    {
        return this._vertex3;
    }

    get selected(): boolean
    {
        return this._selected;
    }

    set vertex1(value: Point)
    {
        this._vertex1 = value;
    }

    set vertex2(value: Point)
    {
        this._vertex2 = value;
    }

    set vertex3(value: Point)
    {
        this._vertex3 = value;
    }

    set selected(value: boolean)
    {
        this._selected = value;
    }
}