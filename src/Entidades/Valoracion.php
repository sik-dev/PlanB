<?php

class Valoracion
{
  private $id;
  private $puntuacion;
  private $idUser;
  private $idViaje;

  function __construct(
    $id, 
    $puntuacion, 
    $idUser, 
    $idViaje
  )
  {
    $this->id = $id;
    $this->puntuacion = $puntuacion;
    $this->idUser = $idUser;
    $this->idViaje = $idViaje;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getPuntuacion()
  {
    return $this->puntuacion;
  }

  public function setPuntuacion($puntuacion)
  {
    $this->puntuacion = $puntuacion;
  }

  public function getIdUser()
  {
    return $this->idUser;
  }

  public function setIdUser($idUser)
  {
    $this->idUser = $idUser;
  }

  public function getIdViaje()
  {
    return $this->idViaje;
  }

  public function setIdViaje($idViaje)
  {
    $this->idViaje = $idViaje;
  }
}