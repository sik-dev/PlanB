<?php

class Usuario
{
  private $id;
  private $descripcion;
  private $email;
  private $pass;
  private $nombre;
  private $pais;
  private $foto;
  private $media;

  function __construct(
    $id, 
    $descripcion, 
    $email, 
    $pass, 
    $nombre, 
    $pais, 
    $foto, 
    $media
  )
  {
    $this->id = $id;
    $this->descripcion = $descripcion;
    $this->email = $email;
    $this->pass = $pass;
    $this->nombre = $nombre;
    $this->pais = $pais;
    $this->foto = $foto;
    $this->media = $media;
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

  public function getDescripcion()
  {
    return $this->descripcion;
  }

  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function getPass()
  {
    return $this->pass;
  }

  public function setPass($pass)
  {
    $this->pass = $pass;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getPais()
  {
    return $this->pais;
  }

  public function setPais($pais)
  {
    $this->pais = $pais;
  }

  public function getFoto()
  {
    return $this->foto;
  }

  public function setFoto($foto)
  {
    $this->foto = $foto;
  }

  public function getMedia()
  {
    return $this->media;
  }

  public function setMedia($media)
  {
    $this->media = $media;
  }
}