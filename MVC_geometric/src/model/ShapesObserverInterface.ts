import Shape from './Shape.js';

export default interface ShapesObserverInterface
{
    onShapeAdded(shape: Shape): void;
}