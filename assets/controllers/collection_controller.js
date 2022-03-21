import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    container;
    counter;
    newWidget;
    templateId;

    connect() 
    {
        this.container = this.element;
        this.counter = this.container.dataset.itemCounter;
        this.templateId = this.container.dataset.templateId;

        this.newWidget = this.container.querySelector(`[id=${this.templateId}]`);
    }

    add()
    {
        // Remplacement de la chaine "__name__"
        // "newWidget" est une Chaine de caractères
        let newWidget = this.newWidget.innerHTML.replace(/__name__/g, this.counter);

        // Incrémentation du compteur
        this.counter++;

        // Mise à jour du compteur
        this.container.dataset.itemCounter = this.counter;

        // Création d'un Noeu HTML a partir de la chaine "newWidget"
        var parser = new DOMParser();
        var widget = parser.parseFromString(newWidget, 'text/html');

        // Injection du noeu HTML dans le container de collection
        this.container.prepend( widget.body );
    }
}
