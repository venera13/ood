import ObservableInterface from '../Observable/ObservableInterface';

export default interface ObserverInterface
{
    update(observable: ObservableInterface): void;
}