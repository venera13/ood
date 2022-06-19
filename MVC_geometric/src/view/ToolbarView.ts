import ToolbarController from '../controller/ToolbarController.js';
import Shapes from '../model/Shapes.js';

enum ShapeTypes {
    RECTANGLE = 'rectangle',
    TRIANGLE = 'triangle',
    ELLIPSE = 'ellipse',
}

export default class ToolbarView
{
    private readonly toolbarController: ToolbarController;
    private readonly shapes: Shapes;
    private readonly window: HTMLElement | null;

    constructor(shapes: Shapes) 
    {
        this.window = document.getElementById('window');
        this.render();

        this.shapes = shapes;
        this.toolbarController = new ToolbarController(this, this.shapes);

        this.mouseClickEvent();
    }

    private render(): void
    {
        const canvas = document.getElementById('canvas');
        const menuElement = document.createElement('div');
        menuElement.style.cssText = 'width: 100%; min-height: 90px; border-bottom: 1px solid #000; display: flex; align-items: center; padding: 20px; box-sizing: border-box;';
        menuElement.id = 'menu';
        this.window?.insertBefore(menuElement, canvas);

        const menu = document.getElementById('menu');

        const rectangle = document.createElement('div');
        rectangle.id = 'rectangle';
        rectangle.style.cssText = 'width: 50px; height: 50px; background-color:#4867ef; margin-right: 15px; cursor: pointer;';

        const ellipse = document.createElement('div');
        ellipse.id = 'ellipse';
        ellipse.style.cssText = 'width: 50px; height: 50px; border-radius: 50%; background-color:#4867ef; margin-right: 15px; cursor: pointer;';

        const triangle = document.createElement('div');
        triangle.id = 'triangle';
        triangle.style.cssText = 'width: 0; height: 0; border: solid 30px; border-color: transparent transparent #4867ef transparent; cursor: pointer; margin-bottom: 19px;';

        menu?.appendChild(rectangle);
        menu?.appendChild(ellipse);
        menu?.appendChild(triangle);
    }

    private mouseClickEvent(): void
    {
        const rectangle = document.getElementById('rectangle');
        rectangle?.addEventListener('click', () => this.toolbarController.addShape(ShapeTypes.RECTANGLE));
        const ellipse = document.getElementById('ellipse');
        ellipse?.addEventListener('click', () => this.toolbarController.addShape(ShapeTypes.ELLIPSE));
        const triangle = document.getElementById('triangle');
        triangle?.addEventListener('click', () => this.toolbarController.addShape(ShapeTypes.TRIANGLE));
    }
}