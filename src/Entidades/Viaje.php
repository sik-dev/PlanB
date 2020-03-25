<?php

class Viaje
{
  private $id;
  private $paisOrigen;
  private $ciudadOrigen;
  private $paisDestino;
  private $ciudadDestino;
  private $foto;
  private $precio;
  private $transporte;
  private $descripcion;
  private $idUser;

  function __construct(
    $id, 
    $paisOrigen, 
    $ciudadOrigen, 
    $paisDestino, 
    $ciudadDestino, 
    $foto, 
    $precio,
    $transporte,
    $descripcion,
    $idUser
  )
  {
    $this->id = $id;
    $this->paisOrigen = $paisOrigen;
    $this->ciudadOrigen = $ciudadOrigen;
    $this->paisDestino = $paisDestino;
    $this->ciudadDestino = $ciudadDestino;
    $this->foto = $foto;
    $this->precio = $precio;
    $this->transporte = $transporte;
    $this->descripcion = $descripcion;
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

  public function getPaisOrigen()
  {
    return $this->paisOrigen;
  }

  public function setPaisOrigen($paisOrigen)
  {
    $this->paisOrigen = $paisOrigen;
  }

  public function getCiudadOrigen()
  {
    return $this->ciudadOrigen;
  }

  public function setCiudadOrigen($ciudadOrigen)
  {
    $this->ciudadOrigen = $ciudadOrigen;
  }

  public function getPaisDestino()
  {
    return $this->paisDestino;
  }

  public function setPaisDestino($paisDestino)
  {
    $this->paisDestino = $paisDestino;
  }

  public function getCiudadDestino()
  {
    return $this->ciudadDestino;
  }

  public function setCiudadDestino($ciudadDestino)
  {
    $this->ciudadDestino = $ciudadDestino;
  }

  public function getFoto()
  {
    return $this->foto;
  }

  public function setFoto($foto)
  {
    $this->foto = $foto;
  }

  public function getPrecio()
  {
    return $this->precio;
  }

  public function setPrecio($precio)
  {
    $this->precio = $precio;
  }

  public function getTransporte()
  {
    return $this->transporte;
  }

  public function setTransporte($transporte)
  {
    $this->transporte = $transporte;
  }

  public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
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