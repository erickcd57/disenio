<?php

namespace BackendBundle\Entity;

/**
 * Almacen
 */
class Almacen
{
    /**
     * @var integer
     */
    private $idAlmacen;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $referencia;


    /**
     * Get idAlmacen
     *
     * @return integer
     */
    public function getIdAlmacen()
    {
        return $this->idAlmacen;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Almacen
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     *
     * @return Almacen
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
        return $this->referencia;
    }
}
