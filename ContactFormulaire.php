<?php
class ContactFormulaire{
    private $nom;
    private $mail;
    private $sujet;
    private $message;
    private $captcha_session;
    private $captcha;
    private $erreurs = array();
    
    public function recupForm($nom, $mail, $sujet, $message, $cap){
        $this->captcha_session = $_SESSION['code'];
        $this->nom = $nom;
        $this->mail = $mail;
        $this->sujet = $sujet;
        $this->message = $message;
        $this->captcha = $cap;
        
    }
    
    public function testForm(){
        $test = true;
        if(empty($this->nom)||empty($this->mail)||empty($this->sujet)||empty($this->message)||empty($this->captcha)){
            $test = false;
            $this->addErreur("Tous les champs doivent etre remplis.");
        }
        if(!filter_var($this->mail, FILTER_VALIDATE_EMAIL)){
            $test = false;
            $this->addErreur("L'adresse email n'est pas valide.");
        }
        if(strlen($this->nom)<2||!ctype_alpha($this->nom)){
            $test = false;
            $this->addErreur("Le nom n'est pas valide.");
        }
        if(strlen($this->sujet)<3){
            $test = false;
            $this->addErreur("Le sujet est trop court.");
        }
        if(strlen($this->message)<5){
            $test = false;
            $this->addErreur("Le message est trop court.");
        }
        if($this->captcha != $this->captcha_session){
            $test = false;
            $this->addErreur("Captcha n'est pas correct.");
        }
        return $test;

    }
    public function envoiMail(){
        mail('admin@gmail.com', 'New message', "$this->nom $this->mail $this->sujet $this->message");
    }
    public function afficheMessage(){
        return $this->message;
    }
    private function addErreur($msg){
        $this->erreurs[] = $msg;
    }
    public function afficheErreur() {
        return $this->erreurs;
    }
}