export default class WindowView
{
    private window: HTMLElement | null = null;

    constructor()
    {
        this.renderWindow();
        this.renderCanvas();
    }

    private renderWindow(): void
    {
        const window = document.createElement('div');
        window.style.cssText = 'width: 640px; height: 480px; border: 2px solid #000; display:flex; flex-direction: column;';
        window.id = 'window';
        document.body.insertBefore(window, null);

        this.window = document.getElementById('window');
    }

    private renderCanvas(): void
    {
        const canvasElement = document.createElement('canvas');
        canvasElement.id = 'canvas';
        canvasElement.width = 640;
        canvasElement.height = 390;
        this.window?.appendChild(canvasElement);
    }
}