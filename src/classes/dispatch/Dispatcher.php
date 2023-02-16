<?php

namespace iutnc\crazyCharlieDay\dispatch;

use iutnc\crazyCharlieDay\action\AccueilAction;
use iutnc\crazyCharlieDay\action\ActivateAccountAction;
use iutnc\crazyCharlieDay\action\ModifyEmailAction;
use iutnc\crazyCharlieDay\action\ModifyPasswordAction;
use iutnc\crazyCharlieDay\action\RegisterAction;
use iutnc\crazyCharlieDay\action\SigninAction;
use iutnc\crazyCharlieDay\action\Signout;
use iutnc\crazyCharlieDay\exceptions\AuthException;

class Dispatcher
{

    private ?string $action;



    /**
     * Constructeur prenant en parametre une action a executer
     * @param string|null $action action a executer
     */

    public function __construct(?string $action)
    {
        $this->action = $action;
    }



    /**
     * @return void
     * @throws AuthException
     */

    public function run() : void
    {
        switch ($this->action)
        {
            case 'register':
                $action = new RegisterAction();
                $html = $action->execute();
                break;
            case 'signin':
                $action = new SigninAction();
                $html = $action->execute();
                break;
            case 'signout':
                $action = new Signout();
                $html = $action->execute();
                break;
            case 'modify-email':
                $action = new ModifyEmailAction();
                $html = $action->execute();
                break;
            case 'modify-passwd':
                $action = new ModifyPasswordAction();
                $html = $action->execute();
                break;
            case 'activate-account':
                $action = new ActivateAccountAction();
                $html = $action->execute();
                break;
            default:
                $action = new AccueilAction();
                $html = $action->execute();
        }
        $this->renderPage($html);
    }



    /**
     * @param string $html
     * @return void
     */

    private function renderPage(string $html) : void
    {
        if (isset($_SESSION['user_connected']))
        {
            $inscription = '';
            $connection = '<li class="element"><a href="?action=signout">Se Deconnecter</a></li>';
        }
        else
        {
            $inscription = '<li class="element"><a href="?action=register">S\'inscrire</a></li>';
            $connection = '<li class="element"><a href="?action=signin">Se Connecter</a></li>';
        }
        echo <<<END
            <!DOCTYPE html>
            <html lang="fr">
                <head>
                    <title>CourtCircuit</title>
                    <meta charset="UTF-8"> 
                    <link rel="stylesheet" href="style.css">  
                </head>
                <body>
                    <nav class="menu">
                        <div></div>
                        <ul class="navList">
                            <li class="element"><a href="index.php">Accueil</a></li>
                            $inscription
                            $connection  
                        </ul>
                    </nav>
                    <div class="content">
                        $html
                    </div>
                    
                </body>
            
            </html>
            
             
            END;

    }

}
?>