<?php

class Email {
    public string $adressRecipient;
    public string $body;
    public string $message;

    public function __construct($adressRecipient, $body, $message) {
        $this->adressRecipient = $adressRecipient;
        $this->body = $body;
        $this->message = $message;
    }
}

class MailService {
    private static $instance;
    private $count;

     private function __construct() {
        $this->count = 0;
    }

    static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new MailService();
        }
        return self::$instance;
    }

    public function incrementCount() {
        $this->count++;
    }


    public function getCount() {
        return $this->count;
    }

}

class MailFactory {
    public function makeEmail($adressRecipient, $body, $message): Email {
        return new Email($adressRecipient, $body, $message);
    }
}

$factory = new MailFactory();
$email = $factory->makeEmail("pera@email", "smt", "tekst poruke");
MailService::getInstance()->incrementCount();
var_dump($email);
echo "Broj poslatih mejlova: " . MailService::getInstance()->getCount();