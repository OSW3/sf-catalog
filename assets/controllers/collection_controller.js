import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    container;
    counter;
    newWidget;
    templateId;

    connect() {

        this.container = this.element;
        this.counter = this.container.dataset.itemCounter;
        this.templateId = this.container.dataset.templateId;

        this.newWidget = this.container.querySelector(`[id=${this.templateId}]`);

    }

    add()
    {
        // Remplacement de la chaine "__name__"
        this.newWidget = this.newWidget.innerHTML.replace(/__name__/g, this.counter);

        // Incrémentation du compteur
        this.counter++;

        // Mise à jour du compteur
        this.container.dataset.counter = this.counter;

        console.log( this.newWidget );
    }
}
