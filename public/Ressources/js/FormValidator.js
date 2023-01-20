export default class FormValidator {

    /**
     * Récupérer les champs à valider :
     *      - Champs required
     *      - Champs courriel
     *      - Champs mdp
     * Initiatialiser _isValid à true
     * Faire la poutine de validation et la gestion d'affichage des messages d'erreurs
     * Getter isValid
     */

     constructor(el, nom) {
       this._el = el;
       this.elname = nom;
       this._elCourriel = this._el.uti_courriel;
       this._elMdp = this._el.uti_mdp;
       this._isvalide = true;
       this._courrielRegex = /(.+)@(.+){1,}\.(.+){1,}/;

       /*validation nouveau membre*/
       if(this.elname == 'inscription'){
        this._elNom = this._el.uti_nom;
        this._elPrenom = this._el.uti_prenom;
       }
       
       this.valideFormulaire();
    }

    get valide() {
        return this._isvalide;
    }
   
    valideFormulaire() {
        
        let  elMsgError = document.querySelector('[data-js-error-msg]');
        elMsgError.textContent = '';
        /**
         * ÉLÉMENTS INPUT
         */
        
        // Récupère tous les éléments input (sauf radio)  du formulaire
        let elControls = this._el.querySelectorAll('input');
        

        for (let i = 0, l = elControls.length; i < l; i++) {

            // Récupère les éléments DOM à travailler
            
            
            
            

            // Valide les champs required
            if (elControls[i].required && elControls[i].value == '') {
                elMsgError.textContent = 'Tous les champs sont obligatoire';
                this._isvalide = false;
                elControls[i].classList.add('inputErreur');
            } 
            
            // Valide le format courriel
            if (elControls[i].type == 'email') {
                
                if (elControls[i].value != '') {
                    let courriel = elControls[i].value;

                    if (this._courrielRegex.test(courriel)) {
                        if (elMsgError.classList.contains('error')) {
                            elMsgError.classList.remove('error');
                            elMsgError.textContent = '';
                        }
                    } else {
                        elMsgError.classList.add('error');
                        elMsgError.textContent = 'L\'adresse courriel saisie n\'est pas valide.';
                        this._isvalide = false;
                    }
                }
            }

        }
    }
}