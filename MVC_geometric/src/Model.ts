import ObservableInterface from './ObservableInterface';
import ObserverInterface from './ObserverInterface';

export default class Model implements ObservableInterface
{
    private readonly observers: Array<ObserverInterface> = [];

    notifyObservers(): void
    {
        this.observers.map((observer: ObserverInterface) =>
        {
            observer.update(this);
        })
    }

    registerObserver(observer: ObserverInterface): void
    {
        this.observers.push(observer);
    }

    removeObserver(observer: ObserverInterface): void
    {
        const index = this.observers.indexOf(observer, 0);
        if (index > -1)
        {
            this.observers.splice(index, 1);
        }
    }
    
}