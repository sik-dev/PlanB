<?php

class Itinerario
{
  private $id;
  private $localizacion;
  private $alojamiento;
  private $titulo;
  private $manana;
  private $tarde;
  private $noche;
  private $idViaje;

  function __construct(
    $id, 
    $localizacion, 
    $alojamiento, 
    $titulo, 
    $manana, 
    $tarde, 
    $noche, 
    $idViaje
  )
  {
    $this->id = $id;
    $this->localizacion = $localizacion;
    $this->alojamiento = $alojamiento;
    $this->titulo = $titulo;
    $this->manana = $manana;
    $this->tarde = $tarde;
    $this->noche = $noche;
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

  public function getLocalizacion()
  {
    return $this->localizacion;
  }

  public function setLocalizacion($localizacion)
  {
    $this->localizacion = $localizacion;
  }

  public function getAlojamiento()
  {
    return $this->alojamiento;
  }

  public function setAlojamiento($alojamiento)
  {
    $this->alojamiento = $alojamiento;
  }

  public function getTitulo()
  {
    return $this->titulo;
  }

  public function setTitulo($titulo)
  {
    $this->titulo = $titulo;
  }

  public function getManana()
  {
    return $this->manana;
  }

  public function setManana($manana)
  {
    $this->manana = $manana;
  }

  public function getTarde()
  {
    return $this->tarde;
  }

  public function setTarde($tarde)
  {
    $this->tarde = $tarde;
  }

  public function getNoche()
  {
    return $this->noche;
  }

  public function setNoche($noche)
  {
    $this->noche = $noche;
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