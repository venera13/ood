import ObserverInterface from '../Observer/ObserverInterface';

export default interface ObservableInterface
{
    registerObserver(observer: ObserverInterface): void;
    removeObserver(observer: ObserverInterface): void;
    notifyObservers(): void;
    getChangedData(): any;
}