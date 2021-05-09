<?php

class Utilisateur
{
    private $iduser;
    private $nomuser;
    private $prenomuser;
    private $mailuser;
    private $Birthuser;
    private $passworduser;
    private $Departementuser;

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }


// Liste des getters

    public function getIdUser()
    {
        return $this->iduser;
    }

    public function getNomUser()
    {
        return $this->nomuser;
    }

    public function getPrenomUser()
    {
        return $this->prenomuser;
    }

    public function getMailUser()
    {
        return $this->mailuser;
    }

    public function getBirthUser()
    {
        return $this->Birthuser;
    }

    public function getPasswordUser()
    {
        return $this->passworduser;
    }

    public function getDepartementUser()
    {
        return $this->Departementuser;
    }

    // Liste des setters

    public function setIdUser($iduser)
    {
        $iduser = (int) $iduser;
        if ($iduser > 0)
        {
            $this->iduser = $iduser;
        }
    }

    public function setNomUser($nomuser)
    {
        if (is_string($nomuser))
        {
            $this->nomuser = $nomuser;
        }
    }

    public function setPrenomUser($prenomuser)
    {
        if (is_string($prenomuser))
        {
            $this->prenomuser = $prenomuser;
        }
    }

    public function setMailUser($mailuser)
    {
        if (is_string($mailuser))
        {
            $this->mailuser = $mailuser;
        }
    }

    public function setBirthUser($Birthuser)
    {
        $this->Birthuser = $Birthuser;
    }

    public function setPasswordUser($passworduser)
    {
        if (is_string($passworduser))
        {
            $this->passworduser = $passworduser;
        }
    }

    public function setDepartementUser($Departementuser)
    {
        if (is_string($Departementuser))
        {
            $this->Departementuser = $Departementuser;
        }
    }

}
