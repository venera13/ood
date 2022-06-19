import Rect from '../domain/Rect.js';
import Rectangle from './shapes/Rectangle.js';

export default class RectangleView
{
    private readonly canvas: any;
    private readonly frame: Rect;
    private readonly rectangle: Rectangle;

    constructor(canvas: any, frame: Rect) 
    {
        this.canvas = canvas;
        this.frame = frame;
        
        this.rectangle = new Rectangle(frame);
    }
    
    public render(): void
    {
        this.canvas.fillStyle = "#8c9eeb";
        this.canvas.fillRect(this.rectangle.leftTop.x, this.rectangle.leftTop.y, this.rectangle.width, this.rectangle.height);
    }
}