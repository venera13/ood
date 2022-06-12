import Model from './Model';
import View from './View';

export default class Controller
{
    private readonly model: Model;
    private readonly view: View;

    constructor(model: Model, view: View) 
    {
        this.model = model;
        this.view = view;
    }

    public handleClickShape(): void
    {

    }

    public addShape(): void
    {

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