<?php

namespace iutnc\crazyCharlieDay\action;

class CompteAction extends Action
{
    /**
     * @return string
     */

    public function execute(): string
    {
        if (isset($_SESSION['user_connected']))
        {
            $user = unserialize($_SESSION['user_connected']);
            if ($user->active === 1) {
                if ($this->http_method === 'GET') {
                    $mail = $user->email;
                    $html = <<< END
                        <form id="compte" method="POST" action="?action=compte">   
                              <h1>Mon Compte</h1>
                              <div class="account-info">
                                <div class="info-item">
                                  <h2>Adresse e-mail</h2>
                                  <p>$mail</p>
                                  <button><a href="?action=modify-email">l'adresse e-mail</a> </button>
                                <div class="info-item">
                                  <h2>Mot de passe</h2>
                                  <p>********</p>
                                  <button><a href="?action=modify-passwd">Changer le mot de passe</a></button>
                                </div>
                                </div>
                              </div>
                        </form> 
                        END;
                }
            }
            else
            {
                $html = "Le compte doit être activé pour accéder à cette fonctionnalité";
            }

        }
        else
        {
            $html = 'Veuillez vous connecter avant d\'accéder au site';
        }
        return $html;
    }
}