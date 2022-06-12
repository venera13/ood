import Rect from '../Rect';

export default interface ShapeInterface
{
    getFrame(): Rect;
    setFrame(rect: Rect): void;
}