import ShapeInterface from './ShapeInterface';
import Rect from '../Rect';
import Point from '../Point';

export default class Triangle implements ShapeInterface
{
    getFrame(): Rect
    {
        return new Rect(new Point(0, 0), 0, 0);
    }

    setFrame(rect: Rect): void 
    {
    }
    
}