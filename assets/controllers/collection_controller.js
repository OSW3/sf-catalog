import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    counter;
    newWidget;
    templateId;

    connect() {

        let container = this.element;
        this.counter = container.dataset.itemCounter;
        this.templateId = container.dataset.templateId;

        
        this.newWidget = container.querySelector(`[id=${this.templateId}]`);
        console.log( this.newWidget );

        // this.newWidget = document.getElementById(this.templateId);

        console.log( this.newWidget );
    }

    add()
    {
    }
}
