import Rect from '../domain/Rect.js';
import Ellipse from './shapes/Ellipse.js';

export default class EllipseView
{
    private readonly canvas: any;
    private readonly frame: Rect;
    private readonly ellipse: Ellipse;

    constructor(canvas: any, frame: Rect)
    {
        this.canvas = canvas;
        this.frame = frame;

        this.ellipse = new Ellipse(frame);
    }

    public render(): void
    {
        this.canvas.beginPath();
        this.canvas.fillStyle = "#8c9eeb";
        this.canvas.ellipse(this.ellipse.center.x, this.ellipse.center.y, this.ellipse.horizontalRadius, this.ellipse.verticalRadius, 0, 2 * Math.PI, false);
        this.canvas.fill();
    }
}