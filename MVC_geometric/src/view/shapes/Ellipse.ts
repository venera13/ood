import Rect from '../../domain/Rect.js';
import Point from '../../domain/Point.js';

export default class Ellipse
{
    private _center!: Point;
    private _verticalRadius!: number;
    private _horizontalRadius!: number;

    constructor(frame: Rect)
    {
        this.setFrame(frame)
    }

    public getFrame(): Rect
    {
        const leftTop = new Point(this._center.x - this._horizontalRadius, this._center.y - this._verticalRadius);
        return new Rect(leftTop, this._horizontalRadius * 2, this._verticalRadius * 2);
    }

    private setFrame(rect: Rect): void
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
}