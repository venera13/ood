import ObserverInterface from './ObserverInterface';
import ObservableInterface from './ObservableInterface';
import Model from './Model';
import Controller from './Controller.js';

export default class View implements ObserverInterface
{
    private readonly model: Model;
    private readonly controller: Controller;

    constructor(model: Model)
    {
        this.model = model;
        this.controller = new Controller(this.model, this);

        console.log('Controller');
    }

    update(observable: ObservableInterface)
    {
    }
}