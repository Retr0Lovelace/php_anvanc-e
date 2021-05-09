<?php

// Ici, vous retrouverez toutes les fonctionnalités en rapport avec l'interaction d'un utilisateur.

require_once 'user.php';
require_once 'bdd.php';
require_once 'Functions.php';


class manager
{

    public function Connexion(Utilisateur $user){ // Fonction de connexion d'un utilisateur présent dans sign-in.php
        session_start();
        $bdd = new bdd();

        $req=$bdd->getStart()->prepare('SELECT * FROM users WHERE mail_user = :mail_user'); // Requête qui récupèrent toutes les informations en rapport avec le username seulement
        $req->execute(array(
            'mail_user' => $user->getMailUser()
        ));

        $resultat = $req->fetch();

        $isPasswordCorrect = password_verify($user->getPasswordUser(), $resultat['password_user']); // test de la compatibilité du mot de passe et du mot de passe crypté

        if (!$resultat)
        {
            $_SESSION['errors'][0] = "Utilisateur n'existe pas"; // gestion d'erreur
            header("Location: ../");
        }
        else
        {
            if ($isPasswordCorrect && empty($_SESSION['errors'])) {
                //création de la session utilisateur
                $_SESSION['username'] = $resultat['username'];

                header("Location: ../views/tableau.php");
            }
            else {
                $_SESSION['errors'][1] = "Mauvais identifiant ou mot de passe !";  // gestion d'erreur
                header("Location: ../");
            }
        }
    }

    public function Inscription(Utilisateur $user){ // Fonction d'inscription d'un utilisateur présent dans sign-up.php

        session_start();

        $bdd = new bdd();
        $Functions = new Functions();

        $req=$bdd->getStart()->prepare('SELECT * FROM users WHERE nom_user = :nomuser OR mail_user = :mailuser'); // Requête qui récupèrent toutes les informations pour voir si l'utilisateur n'existe ou non
        $req->execute(array(
            'nom_user'=>$user->getNomUser(),
            'mailuser'=>$user->getMailUser()
        ));

        $donne = $req->fetch();

        if ($donne){
            $Functions->setDonne($donne);
        }

        $Functions->Errors($user); // gestion d'erreur

        if (empty($_SESSION['errors'])){
            $req1=$bdd->getStart()->prepare('INSERT INTO users (nom_user, prenom_user,password_user, mail_user, Birth_user,Departement_user) VALUES (:nom_user, :prenom_user,:password_user, :mail_user, :Birth_user,:Departement_user)'); // Création de l'utilisateur dans la bdd

            $pass_hache = password_hash($user->getPasswordUser(), PASSWORD_DEFAULT);

            $req1->execute(array(
                'nom_user'=> $user->getNomUser(),
                'prenom_user' => $user->getPrenomUser(),
                'password_user'=> $pass_hache,
                'mail_user'=>$user->getMailUser(),
                'Birth_user'=> $user->getBirthUser(),
                'Departement_user' => $user->getDepartementUser()
            ));

            //$Functions->Mail_ins($user); //envoi du mail d'inscription (Non fonctionnel)

            $_SESSION['Nom'] = $user->getNomUser(); //création d'un Session

            header("Location: ../views/tableau.php");
        }
        else{
            header("Location: ../views/register.php");
        }

    }

    public function Modification(Utilisateur $user){ // Fonction qui permet à l'utilsateur de modifier ses informations présent dans espace-membre.php

        $bdd = new bdd();
        session_start();

        $Functions = new Functions();
        $Functions->Errors($user);

        $pass_hache = password_hash($user->getPasswordUser(), PASSWORD_DEFAULT); // hachage du mot du nouveau mot de passe

        if (empty($_SESSION['errors'])){
            $req=$bdd->getStart()->prepare('UPDATE users SET nom_user = :nom_user, prenom_user = :prenom_user, password_user = :password_user, mail_user = :mail_user, Birth_user = :Birth_user, Departement_user = :Departement_user WHERE id_user = :id_user');
            $req->execute(array(
                'id_user' => $user->getIdUser(),
                'nom_user'=> $user->getNomUser(),
                'prenom_user' => $user->getPrenomUser(),
                'password_user'=> $pass_hache,
                'mail_user'=>$user->getMailUser(),
                'Birth_user'=> $user->getBirthUser(),
                'Departement_user' => $user->getDepartementUser()
            ));

            header('Location: ../views/tableau.php');
        }
        else{
            header('Location: ../views/modify.php');
        }
    }

    public function Supression(string $id){ // Fonction qui permet à l'admin de supprimer un utilisateur présent dans admin.php

        $bdd = new bdd();

        $id = (int)$id;

        $req = $bdd->getStart()->prepare("DELETE FROM users WHERE id_user = :id_user");
        $req->execute(array(
            'id_user'=> $id
        ));
        header("Location: ../views/tableau.php");
    }

}