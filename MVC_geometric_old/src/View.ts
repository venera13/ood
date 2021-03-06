import ObserverInterface from './Observer/ObserverInterface.js';
import ObservableInterface from './Observable/ObservableInterface.js';
import Model from './Model.js';
import Controller from './Controller.js';

export default class View implements ObserverInterface
{
    private readonly model: Model;
    private readonly controller: Controller;
    private canvas: any = null;
    private window: HTMLElement | null = null;

    constructor(model: Model)
    {
        this.model = model;

        this.drawWindow();
        this.drawMenu();
        this.addCanvas();

        this.controller = new Controller(this.model, this);
    }

    drawWindow(): void
    {
        const window = document.createElement('div');
        window.style.cssText = 'width: 640px; height: 480px; border: 2px solid #000; display:flex; flex-direction: column;';
        window.id = 'window';
        document.body.insertBefore(window, null);

        this.window = document.getElementById('window');
    }

    drawMenu(): void
    {
        const menuElement = document.createElement('div');
        menuElement.style.cssText = 'width: 100%; min-height: 90px; border-bottom: 1px solid #000; display: flex; align-items: center; padding: 20px; box-sizing: border-box;';
        menuElement.id = 'menu';
        this.window?.appendChild(menuElement);

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

    addCanvas(): void
    {
        const canvasElement = document.createElement('canvas');
        canvasElement.id = 'canvas';
        canvasElement.width = 640;
        canvasElement.height = 390;
        this.window?.appendChild(canvasElement);

        let canvas: any = document.getElementById('canvas');
        if (canvas.getContext)
        {
            this.canvas = canvas.getContext('2d');
        }
    }

    update(observable: ObservableInterface): void
    {
        this.canvas.clearRect(0, 0, 640, 390);

        const shapes = observable.getChangedData()['shapes'];

        if (this.canvas)
        {
            shapes.forEach((shapeElement: any) =>
            {
                const shape = shapeElement.value;

                if (shapeElement.key == 'rectangle')
                {
                    this.canvas.fillStyle = "#8c9eeb";
                    this.canvas.fillRect(shape.leftTop.x, shape.leftTop.y, shape.width ,shape.height);
                }
                else if (shapeElement.key == 'ellipse')
                {
                    this.canvas.beginPath();
                    this.canvas.fillStyle = "#8c9eeb";
                    this.canvas.ellipse(shape.center.x, shape.center.y, shape.horizontalRadius, shape.verticalRadius, 0, 2 * Math.PI, false);
                    this.canvas.fill();
                }
                else if (shapeElement.key == 'triangle')
                {
                    this.canvas.beginPath();
                    this.canvas.fillStyle = "#8c9eeb";
                    this.canvas.moveTo(shape.vertex1.x, shape.vertex1.y);
                    this.canvas.lineTo(shape.vertex2.x, shape.vertex2.y);
                    this.canvas.lineTo(shape.vertex3.x, shape.vertex3.y);
                    this.canvas.fill();
                }

                if (shapeElement.value.selected)
                {
                    this.canvas.strokeStyle = "#2f3c76";
                    this.canvas.strokeRect(shape.getFrame().leftTop.x, shape.getFrame().leftTop.y, shape.getFrame().width, shape.getFrame().height);
                    this.canvas.beginPath();
                    this.canvas.fillStyle = '#181f40';
                    this.canvas.beginPath();
                    this.canvas.ellipse(shape.getFrame().leftTop.x, shape.getFrame().leftTop.y, 3, 3, 0, 2 * Math.PI, false);
                    this.canvas.fill();
                    this.canvas.beginPath();
                    this.canvas.ellipse(shape.getFrame().leftTop.x + shape.getFrame().width, shape.getFrame().leftTop.y, 3, 3, 0, 2 * Math.PI, false);
                    this.canvas.fill();
                    this.canvas.beginPath();
                    this.canvas.ellipse(shape.getFrame().leftTop.x + shape.getFrame().width, shape.getFrame().leftTop.y + shape.getFrame().height, 3, 3, 0, 2 * Math.PI, false);
                    this.canvas.fill();
                    this.canvas.beginPath();
                    this.canvas.ellipse(shape.getFrame().leftTop.x, shape.getFrame().leftTop.y + shape.getFrame().height, 3, 3, 0, 2 * Math.PI, false);
                    this.canvas.fill();
                }
            })
        }
    }
}