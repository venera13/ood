import Rect from '../../domain/Rect.js';
import Point from '../../domain/Point.js';

export default class Triangle
{
    private _vertex1!: Point;
    private _vertex2!: Point;
    private _vertex3!: Point;

    constructor(frame: Rect)
    {
        this.getVertices(frame);
    }

    public getFrame(): Rect
    {
        const minX = Math.min(this._vertex1.x, this._vertex2.x, this._vertex3.x);
        const minY = Math.min(this._vertex1.y, this._vertex2.y, this._vertex3.y);
        const maxX = Math.max(this._vertex1.x, this._vertex2.x, this._vertex3.x);
        const maxY = Math.max(this._vertex1.y, this._vertex2.y, this._vertex3.y);

        return new Rect(new Point(minX, minY), maxX - minX, maxY - minY);
    }

    private getVertices(frame: Rect): void
    {
        this._vertex1 = new Point(frame.leftTop.x, frame.leftTop.y + frame.height);
        this._vertex2 = new Point(frame.leftTop.x + frame.width/2, frame.leftTop.y);
        this._vertex3 = new Point(frame.leftTop.x + frame.width, frame.leftTop.y + frame.height);
    }

    private setFrame(rect: Rect): void
    {
        const currentFrame = this.getFrame();
        this._vertex1 = Triangle.getNewVertex(rect, currentFrame, this._vertex1);
        this._vertex2 = Triangle.getNewVertex(rect, currentFrame, this._vertex2);
        this._vertex3 = Triangle.getNewVertex(rect, currentFrame, this._vertex3);
    }

    private static getNewVertex(rect: Rect, currentFrame: Rect, point: Point): Point
    {
        const x = rect.leftTop.x + (point?.x - currentFrame.leftTop.x) / currentFrame.width * rect.width;
        const y = rect.leftTop.y + (point?.y - currentFrame.leftTop.y) / currentFrame.height * rect.height;
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
}