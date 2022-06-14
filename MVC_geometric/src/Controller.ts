import Model from './Model';
import View from './View';

enum ShapeTypes {
    RECTANGLE = 'rectangle',
    TRIANGLE = 'triangle',
    ELLIPSE = 'ellipse',
}

export default class Controller
{
    private readonly model: Model;
    private readonly view: View;

    constructor(model: Model, view: View) 
    {
        this.model = model;
        this.view = view;

        this.handleResizeWindow();
        this.addShape();
        this.handleClick();
    }

    public handleResizeWindow(): void
    {
        const window = document.getElementById('window');
        window?.addEventListener('resize', () => this.model.handleResizeWindow(window.offsetWidth, window.offsetHeight));
    }

    public addShape(): void
    {
        const rectangle = document.getElementById('rectangle');
        rectangle?.addEventListener('click', () => this.model.addShape(ShapeTypes.RECTANGLE));
    }

    public handleClick(): void
    {
        const el = document.getElementById('canvas');
        el?.addEventListener('mouseup', (event: any) => this.model.handleMouseUp(event), false);
        el?.addEventListener('click', (event: any) => this.model.handleClickElement(event), false);
        el?.addEventListener('mousedown', (event: any) => this.model.handleMouseDown(event), false);
        el?.addEventListener('mousemove', (event: any) => this.model.handleMouseMove(event), false);
        document.addEventListener('keyup', (event: any) => this.model.handleKeyUp(event), false)
    }

    public moveShape(): void
    {

    }

    public resizeShape(): void
    {

    }

    public removeShape(): void
    {

    }
}