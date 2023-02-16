<?php

namespace iutnc\crazyCharlieDay\auth;

use iutnc\crazyCharlieDay\application\User;
use iutnc\crazyCharlieDay\db\ConnectionFactory;
use iutnc\crazyCharlieDay\exceptions\AuthException;

class Auth
{



    /**
     * @param string $email email entre par l'utilisateur
     * @param string $passwd mot de passe entré par l'utilisateur
     * @return bool vrai si l'authentification a réussi false sinon
     * @throws AuthException
     */

    public static function authenticate(string $email, string $passwd) : bool
    {
        $db = ConnectionFactory::makeConnection();
        $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$row)
            throw new AuthException("Auth failed : Invalid credentials");
        else {
            if (password_verify($passwd, $row['password'])) {
                // Création et serialisation connecté
                $usr = new User($row['id'], $row['email'], $row['password'], $row['role']);
                $usr->active = intval($row['active']);
                $_SESSION['user_connected'] = serialize($usr);
                return true;
            } else {
                throw new AuthException("Auth failed : Invalid credentials");
            }
        }
    }



    /**
     * @param string $email email entré par l'utilisateur souhaitant s'incrire
     * @param string $passwd mot de passe entré par l'utilisateur souhaitant s'inscrire
     * @return string une chaîne indiquant à l'utilisateur si la connection a réussie ou non
     */

    public static function register(string $email, string $passwd) : string
    {
        $db = ConnectionFactory::makeConnection();
        $stmt_email_existant = $db->prepare("SELECT email FROM user");
        $stmt_email_existant->execute();

        $trouve_email = false;
        while ($row_email_existant = $stmt_email_existant->fetch(\PDO::FETCH_ASSOC) and !$trouve_email)
        {
            if ($row_email_existant['email'] === $email)
            {
                $trouve_email = true;
            }
        }

        if ($trouve_email)
        {
            $html = "Inscription échouée : Email déjà existant";
        }
        elseif (!self::verifyPasswordStrength($passwd))
        {
            $html = "Inscription échouée : Mot de passe trop court";
        }
        else
        {
            $hash = password_hash($passwd, PASSWORD_DEFAULT, ['cost' => 12]);
            $db = ConnectionFactory::makeConnection();
            $stmt = $db->prepare("INSERT INTO user (email, password, role) VALUES (:email, :passwd, 1)"); // L'identifiant de l'utilisateur est auto incrémenté
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':passwd', $hash);
            $stmt->execute();
            $html = "Inscription réussie";
        }
        return $html;
    }



    /**
     * @param string $passwd mot de passe a tester
     * @return bool vrai si le mot de passe fait au moins dix caracteres
     */

    public static function verifyPasswordStrength(string $passwd) : bool
    {
        if (strlen($passwd) < 10)
        {
            return false;
        }
        else
            return true;
    }



    /**
     * @param string $nom_token nom du token a creer
     * @return string renvoie le token généré par la méthode bin2hex
     * @throws \Exception
     */

    public static function creerToken(string $nom_token, int $id) : string
    {
        $token = bin2hex(random_bytes(64));
        $db = ConnectionFactory::makeConnection();
        $expiration = date('Y-m-d H:i:s',time() + 60*10);
        $colonne_token = $nom_token.'_token';
        $colonne_expires = $nom_token.'_expires';
        $stmt = $db->prepare("UPDATE user SET $colonne_token = '$token', $colonne_expires = str_to_date('$expiration', '%Y-%m-%d %H:%i:%s') WHERE id = $id");
        $stmt->execute();
        return $token;
    }
}
?>