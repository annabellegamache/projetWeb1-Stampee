import FormValidator from "./FormValidator.js";

export default class Formulaire {

    /**
     * Récupérer le formulaire, le bouton et les éléments DOM nécessaires
     * Gestion du clic du bouton data-js-submit
     * Instanciation de la classe FormValidator avec le formulaire à valider en argument
     * Si valide, gestion du message 'Merci !'
     */

    constructor(el) {
        this._el = el;
        this._elBtn = this._el.querySelector('[data-js-submit]');
        this._elBtn.addEventListener('click', this.onClick.bind(this), false); 
        
    }

    
    onClick(e){
        e.preventDefault();
       // console.log("validation")
        let valide = new FormValidator(this._el, this._el.name).valide; 
        if (valide){
            this._el.submit();
        };
      }

    
}
