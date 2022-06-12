import ObserverInterface from './ObserverInterface';

export default interface ObservableInterface
{
    registerObserver(observer: ObserverInterface): void;
    removeObserver(observer: ObserverInterface): void;
    notifyObservers(): void;
}