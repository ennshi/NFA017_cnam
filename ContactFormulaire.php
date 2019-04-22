<?php
class ContactFormulaire{
    private $nom;
    private $mail;
    private $sujet;
    private $message;
    
    public function recupForm($nom, $mail, $sujet, $message){
        $this->nom = $nom;
        $this->mail = $mail;
        $this->sujet = $sujet;
        $this->message = $message;
    }
    public function testForm(){
        
    }
    public function envoiMail($nom, $mail, $sujet, $message){
        mail('admin@gmail.com', 'New message', "$nom $mail $sujet $message");
    }
    public function afficheMessage(){
        
    }
    public function afficheErreur() {
        
    }
}