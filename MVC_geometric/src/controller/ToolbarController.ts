import ToolbarView from '../view/ToolbarView.js';
import Shapes from '../model/Shapes.js';

export default class ToolbarController
{
    private readonly toolbarView: ToolbarView;
    private readonly shapes: Shapes;
    
    constructor(toolbarView: ToolbarView, shapes: Shapes)
    {
        this.toolbarView = toolbarView;
        this.shapes = shapes;
    }

    public addShape(type: string): void
    {
        this.shapes.addShape(type);
    }
}