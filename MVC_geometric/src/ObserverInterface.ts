import ObservableInterface from './ObservableInterface';

export default interface ObserverInterface
{
    update(observable: ObservableInterface): void;
}