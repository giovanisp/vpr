<?php

namespace PROCERGS\VPR\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uf
 *
 * @ORM\Table(name="uf", indexes={@ORM\Index(name="fk_uf_pais", columns={"id_pais"})})
 * @ORM\Entity
 */
class Uf
{
    /**
     * @var string
     *
     * @ORM\Column(name="sg_uf", type="string", length=2, nullable=true)
     */
    private $sgUf;

    /**
     * @var string
     *
     * @ORM\Column(name="nm_uf", type="string", length=255, nullable=false)
     */
    private $nmUf;

    /**
     * @var integer
     *
     * @ORM\Column(name="int_ordem", type="integer", nullable=true)
     */
    private $intOrdem;

    /**
     * @var integer
     *
     * @ORM\Column(name="fg_ativo", type="integer", nullable=true)
     */
    private $fgAtivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_uf", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUf;

    /**
     * @var \PROCERGS\VPR\CoreBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="PROCERGS\VPR\CoreBundle\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id_pais")
     * })
     */
    private $idPais;



    /**
     * Set sgUf
     *
     * @param string $sgUf
     * @return Uf
     */
    public function setSgUf($sgUf)
    {
        $this->sgUf = $sgUf;

        return $this;
    }

    /**
     * Get sgUf
     *
     * @return string 
     */
    public function getSgUf()
    {
        return $this->sgUf;
    }

    /**
     * Set nmUf
     *
     * @param string $nmUf
     * @return Uf
     */
    public function setNmUf($nmUf)
    {
        $this->nmUf = $nmUf;

        return $this;
    }

    /**
     * Get nmUf
     *
     * @return string 
     */
    public function getNmUf()
    {
        return $this->nmUf;
    }

    /**
     * Set intOrdem
     *
     * @param integer $intOrdem
     * @return Uf
     */
    public function setIntOrdem($intOrdem)
    {
        $this->intOrdem = $intOrdem;

        return $this;
    }

    /**
     * Get intOrdem
     *
     * @return integer 
     */
    public function getIntOrdem()
    {
        return $this->intOrdem;
    }

    /**
     * Set fgAtivo
     *
     * @param integer $fgAtivo
     * @return Uf
     */
    public function setFgAtivo($fgAtivo)
    {
        $this->fgAtivo = $fgAtivo;

        return $this;
    }

    /**
     * Get fgAtivo
     *
     * @return integer 
     */
    public function getFgAtivo()
    {
        return $this->fgAtivo;
    }

    /**
     * Get idUf
     *
     * @return integer 
     */
    public function getIdUf()
    {
        return $this->idUf;
    }

    /**
     * Set idPais
     *
     * @param \PROCERGS\VPR\CoreBundle\Entity\Pais $idPais
     * @return Uf
     */
    public function setIdPais(\PROCERGS\VPR\CoreBundle\Entity\Pais $idPais = null)
    {
        $this->idPais = $idPais;

        return $this;
    }

    /**
     * Get idPais
     *
     * @return \PROCERGS\VPR\CoreBundle\Entity\Pais 
     */
    public function getIdPais()
    {
        return $this->idPais;
    }
}
