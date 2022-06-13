import ShapeInterface from './Shapes/ShapeInterface';

export default class ShapeElement
{
    private _active: boolean = false;
    private _shape: ShapeInterface;
    
    constructor(shape: ShapeInterface) 
    {
        this._shape = shape;
    }

    get active(): boolean 
    {
        return this._active;
    }

    get shape(): ShapeInterface 
    {
        return this._shape;
    }

    set active(value: boolean) 
    {
        this._active = value;
    }

    set shape(value: ShapeInterface)
    {
        this._shape = value;
    }
}