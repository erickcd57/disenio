<?php

namespace BackendBundle\Entity;

/**
 * Producto
 */
class Producto
{
    /**
     * @var integer
     */
    private $idproducto;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $stock;

    /**
     * @var float
     */
    private $precioUnidad;

    /**
     * @var float
     */
    private $costoUnidad;

    /**
     * @var \BackendBundle\Entity\Almacen
     */
    private $idAlmacen;


    /**
     * Get idproducto
     *
     * @return integer
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Producto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Producto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Producto
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set precioUnidad
     *
     * @param float $precioUnidad
     *
     * @return Producto
     */
    public function setPrecioUnidad($precioUnidad)
    {
        $this->precioUnidad = $precioUnidad;

        return $this;
    }

    /**
     * Get precioUnidad
     *
     * @return float
     */
    public function getPrecioUnidad()
    {
        return $this->precioUnidad;
    }

    /**
     * Set costoUnidad
     *
     * @param float $costoUnidad
     *
     * @return Producto
     */
    public function setCostoUnidad($costoUnidad)
    {
        $this->costoUnidad = $costoUnidad;

        return $this;
    }

    /**
     * Get costoUnidad
     *
     * @return float
     */
    public function getCostoUnidad()
    {
        return $this->costoUnidad;
    }

    /**
     * Set idAlmacen
     *
     * @param \BackendBundle\Entity\Almacen $idAlmacen
     *
     * @return Producto
     */
    public function setIdAlmacen(\BackendBundle\Entity\Almacen $idAlmacen = null)
    {
        $this->idAlmacen = $idAlmacen;

        return $this;
    }

    /**
     * Get idAlmacen
     *
     * @return \BackendBundle\Entity\Almacen
     */
    public function getIdAlmacen()
    {
        return $this->idAlmacen;
    }
}

