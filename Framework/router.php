<?php
require_once 'controller.php';
require_once 'request.php';
require_once 'view.php';
/*
 * Classe de routage des requ�tes entrantes.
 */
class Routeur {
    /**
     * M�thode principale appel�e par le contr�leur frontal
     * Examine la requ�te et ex�cute l'action appropri�e
     */
    public function routerRequete() {
        try {
            // Fusion des param�tres GET et POST de la requ�te
            // Permet de g�rer uniform�ment ces deux types de requ�te HTTP
            $requete = new Requete(array_merge($_GET, $_POST));
            $controleur = $this->creerControleur($requete);
            $action = $this->creerAction($requete);
            $controleur->executerAction($action);
        }
        catch (Exception $e) {
            $this->gererErreur($e);
        }
    }
    /**
     * Instancie le contr�leur appropri� en fonction de la requ�te re�ue
     * 
     * @param Requete $requete Requ�te re�ue
     * @return Instance d'un contr�leur
     * @throws Exception Si la cr�ation du contr�leur �choue
     */
    private function creerControleur(Requete $requete) {
        // Gr�ce � la redirection, toutes les URL entrantes sont du type :
        // index.php?controleur=XXX&action=YYY&id=ZZZ
        $controleur = "Accueil";  // Contr�leur par d�faut
        if ($requete->existeParametre('controleur')) {
            $controleur = $requete->getParametre('controleur');
            // Premi�re lettre en majuscules
            $controleur = ucfirst(strtolower($controleur));
        }
        // Cr�ation du nom du fichier du contr�leur
        // La convention de nommage des fichiers controleurs est : controller/controller<$controller>.php
        $classeControleur = "controller" . $controleur;
        $fichierControleur = "controller/" . $classeControleur . ".php";
        if (file_exists($fichierControleur)) {
            // Instanciation du contr�leur adapt� � la requ�te
            require($fichierControleur);
            $controleur = new $classeControleur();
            $controleur->setRequete($requete);
            return $controleur;
        }
        else {
            throw new Exception("Fichier '$fichierControleur' introuvable");
        }
    }
    /**
     * D�termine l'action � ex�cuter en fonction de la requ�te re�ue
     * 
     * @param Requete $requete Requ�te re�ue
     * @return string Action � ex�cuter
     */
    private function creerAction(Requete $requete) {
        $action = "index";  // Action par d�faut
        if ($requete->existeParametre('action')) {
            $action = $requete->getParametre('action');
        }
        return $action;
    }
    /**
     * G�re une erreur d'ex�cution (exception)
     * 
     * @param Exception $exception Exception qui s'est produite
     */
    private function gererErreur(Exception $exception) {
        $vue = new Vue('error');
        $vue->generer(array('msgErreur' => $exception->getMessage()));
    }
}