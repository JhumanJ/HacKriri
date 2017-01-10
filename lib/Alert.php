<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 30/01/16
 * Time: 13:40
 */
class Alert
{
    protected $type;
    protected $dismissible;
    protected $text;

    /**
     * Alert constructor.
     * @param $type
     * @param $dismissible
     */
    public function __construct($type, $dismissible)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
    }

    public function addText($text) {
        $this->text = $this->text.$text.'</br>';
    }

    public function show() {

        $message = '<div class="alert alert-'.$this->type;
        if ($this->dismissible) {
            $message= $message.' alert-dismissible';
        }
        $message=$message.'" role="alert">';
        if ($this->dismissible) {
            $message = $message.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        }
        $message = $message.$this->text.'</div>';

        echo $message;
    }

    public function messageToSession() {
        //unset($_SESSION['message']);
        $_SESSION['message'] = $this;
    }

    public static function displayMessage() {
        if (isset($_SESSION['message'])&&$_SESSION['message'] instanceof Alert) {
            $_SESSION['message']->show();
            unset($_SESSION['message']);
        }
    }
}