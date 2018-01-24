<?php
require_once 'request.php';
require_once 'view.php';
/**
 * Classe abstraite Controleur
 * Fournit des services communs aux classes Controleur d�riv�es
 */
abstract class Controleur {
    /** Action � r�aliser */
    private $action;
    
    /** Requ�te entrante */
    protected $requete;
    /**
     * D�finit la requ�te entrante
     * 
     * @param Requete $requete Requete entrante
     */
    public function setRequete(Requete $requete)
    {
        $this->requete = $requete;
    }
    /**
     * Ex�cute l'action � r�aliser.
     * Appelle la m�thode portant le m�me nom que l'action sur l'objet Controleur courant
     * 
     * @throws Exception Si l'action n'existe pas dans la classe Controleur courante
     */
    public function executerAction($action)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        }
        else {
            $classeControleur = get_class($this);
            throw new Exception("Action '$action' non d�finie dans la classe $classeControleur");
        }
    }
    /**
     * M�thode abstraite correspondant � l'action par d�faut
     * Oblige les classes d�riv�es � impl�menter cette action par d�faut
     */
    public abstract function index();
    /**
     * G�n�re la vue associ�e au contr�leur courant
     * 
     * @param array $donneesVue Donn�es n�cessaires pour la g�n�ration de la vue
     */
    protected function genererVue($donneesVue = array())
    {
        // D�termination du nom du fichier vue � partir du nom du contr�leur actuel
        $classeControleur = get_class($this);
        $controleur = str_replace("controller", "", $classeControleur);
        
        // Instanciation et g�n�ration de la vueF
        $vue = new Vue($this->action, $controleur);
        $vue->generer($donneesVue);
    }
}