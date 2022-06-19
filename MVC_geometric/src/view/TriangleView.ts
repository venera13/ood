import Rect from '../domain/Rect.js';
import Triangle from './shapes/Triangle.js';

export default class TriangleView
{
    private readonly canvas: any;
    private readonly frame: Rect;
    private readonly triangle: Triangle;

    constructor(canvas: any, frame: Rect)
    {
        this.canvas = canvas;
        this.frame = frame;

        this.triangle = new Triangle(frame);
    }

    public render(): void
    {
        this.canvas.beginPath();
        this.canvas.fillStyle = '#8c9eeb';
        this.canvas.moveTo(this.triangle.vertex1.x, this.triangle.vertex1.y);
        this.canvas.lineTo(this.triangle.vertex2.x, this.triangle.vertex2.y);
        this.canvas.lineTo(this.triangle.vertex3.x, this.triangle.vertex3.y);
        this.canvas.fill();
    }
}