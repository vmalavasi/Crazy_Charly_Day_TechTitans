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
                    <main>
                      <h1>Bienvenue $mail sur Court-circuit !</h1>
                      <p>Vous êtes actuellement sur la page de notre boutique Click'n Collect.
                        <br>
                        Vous trouverez ici tous les produits que nous proposons à la vente en magasin.
                    </main>
                    <footer>
                      <p>&copy; 2023 Court-circuit</p>
                    </footer>
                
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