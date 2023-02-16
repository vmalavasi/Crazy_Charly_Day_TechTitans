<?php

namespace iutnc\crazyCharlieDay\action;

class AccueilAction extends Action
{



    /**
     * @return string
     */

    public function execute(): string
    {

        if (isset($_SESSION['user_connected']))
        {
            $html = '';
            $user = unserialize($_SESSION['user_connected']);
            if ($user->active === 1) {
                $mail = $user->email;

                $html = <<< END
                    <h1>Bienvenue $mail</h1>
                    <h2>Veuillez choisir une action dans la liste ci dessous</h2>
                    
                    <div class="accueil-action">
                        <ul>
                            <li><a href="?action=modify-passwd">Changer de mot de passe</a></li>
                            <li><a href="?action=modify-email">Changer d'adresse mail</a></li>
                        </ul>
                    </div> <br>
                
            END;

                }

            }


        else
        {
            $html = "<h1>Bienvenue !</h1>";
        }
        return $html;
    }
}
?>