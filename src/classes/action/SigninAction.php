<?php

namespace iutnc\crazyCharlieDay\action;

use \iutnc\crazyCharlieDay\exceptions\AuthException;
use iutnc\crazyCharlieDay\auth\Auth;

class SigninAction extends Action
{



    /**
     * @return string
     */

    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            $html = <<< END
                        <form id="signin" method="POST" action="?action=signin">
                            <label for="email">Email</label>
                            <input type="email" name="email">
                            <br /><br />
                            
                            <label for="passwd">Mot de passe</label>
                            <input type="password" name="passwd">
                            <br /><br />
                            
                            <button type="submit">Se connecter</button>
                            <button type="button" onclick="window.location.href='?action=forgot-passwd'">Mot de passe oublié</button>
                        </form>
                        END;
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $passwd = filter_var($_POST['passwd'], FILTER_SANITIZE_STRING);

            try
            {
                if (Auth::authenticate($email, $passwd))
                {
                    $user = unserialize($_SESSION['user_connected']);
                    if ($user->active === 1) {
                        $html = "Connexion réussie !";
                    }
                    else
                    {
                        $html = "Le compte doit être activé pour vous connecter";
                    }
                }
            }
            catch (AuthException $e1)
            {
                $html = $e1->getMessage();
            }

        }
        return $html;
    }
}
?>