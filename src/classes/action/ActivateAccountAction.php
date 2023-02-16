<?php

namespace iutnc\crazyCharlieDay\action;

use iutnc\crazyCharlieDay\db\ConnectionFactory;
use PDO;

class ActivateAccountAction extends Action
{



    /**
     * @return string
     */

    public function execute(): string
    {
        if (isset($_SESSION['user_connected']))
        {
            if (isset($_GET['token']))
            {
                $token = filter_var($_GET['token'], FILTER_SANITIZE_STRING);
                $user = unserialize($_SESSION['user_connected']);
                $db = ConnectionFactory::makeConnection();
                $date = date('Y-m-d H:i:s', time());
                $stmt = $db->prepare("SELECT * FROM user WHERE activation_token = '$token'
                                            AND activation_expires > str_to_date('$date', '%Y-%m-%d %H:%i:%s')
                                            AND id = '$user->id'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$row)
                {
                    $html = "Le token a expiré, veuillez réessayer : <br /><br />";
                    $html .= "<button onclick=\"window.location.href='?action=activate-account&token=$token'\">Activer Compte</button>";
                }
                else
                {
                    $stmt = $db->prepare("update user set active = 1, activation_token=null, activation_expires=null
                                        where activation_token = '$token'");
                    $stmt->execute();
                    $user->active = 1;
                    $_SESSION['user_connected'] = serialize($user);
                    $html = "Activation réussie !";
                }
            }
            else
            {
                $html = "Le token est invalide";
            }
        }
        else
        {
            $html = 'Veuillez vous connecter avant d\'accéder au site';
        }
        return $html;
    }
}
?>