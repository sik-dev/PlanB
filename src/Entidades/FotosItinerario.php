<?php

class FotosItinerario
{
  private $id;
  private $ruta;
  private $idItinerario;

  function __construct(
    $id, 
    $ruta, 
    $idItinerario
  )
  {
    $this->id = $id;
    $this->ruta = $ruta;
    $this->idItinerario = $idItinerario;
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getRuta()
  {
    return $this->ruta;
  }

  public function setRuta($ruta)
  {
    $this->ruta = $ruta;
  }

  public function getIdItinerario()
  {
    return $this->idItinerario;
  }

  public function setIdItinerario($idItinerario)
  {
    $this->idItinerario = $idItinerario;
  }
}