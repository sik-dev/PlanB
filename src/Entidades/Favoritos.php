<?php

class Favoritos
{
  private $id;
  private $idViaje;
  private $idUser;

  function __construct(
    $id,
    $idViaje,
    $idUser
  )
  {
    $this->id = $id;
    $this->idViaje = $idViaje;
    $this->idUser = $idUser;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getIdViaje()
  {
    return $this->idViaje;
  }

  public function setIdViaje($idViaje)
  {
    $this->idViaje = $idViaje;
  }

  public function getIdUser()
  {
    return $this->idUser;
  }

  public function setIdUser($idUser)
  {
    $this->idUser = $idUser;
  }
}
