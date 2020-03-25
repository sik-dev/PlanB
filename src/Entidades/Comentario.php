<?php

class Comentario
{
  private $id;
  private $texto;
  private $fecha;
  private $idUser;
  private $idViaje;
  private $pais;
  private $foto;
  private $media;

  function __construct(
    $id, 
    $texto, 
    $fecha, 
    $idUser, 
    $idViaje
  )
  {
    $this->id = $id;
    $this->texto = $texto;
    $this->fecha = $fecha;
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
    /* return $this; */
  }

  public function getTexto()
  {
    return $this->texto;
  }

  public function setTexto($texto)
  {
    $this->texto = $texto;
  }

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
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