<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Aukcje
 *
 * @ORM\Table(name="aukcje")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AukcjeRepository")
 */
class Aukcje
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Tytul", type="string", length=255)
     */
    private $tytul;

    /**
     * @var string
     *
     * @ORM\Column(name="Opis", type="string", length=255)
     */
    private $opis;

    /**
     * @var string
     *
     * @ORM\Column(name="Cena", type="string", length=255)
     */
    private $cena;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Koniec", type="datetime")
     */
    private $koniec;

    /**
     * @var string
     *
     * @ORM\Column(name="Zdjecie", type="string", length=255)
     * @Assert\File(mimeTypes={ "application/jpeg" })
     */
    private $zdjecie;
    public function getPhoto()
    {
        return $this->Photo;
    }

    public function setPhoto($Photo)
    {
        $this->photo = $Photo;

        return $this;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tytul
     *
     * @param string $tytul
     *
     * @return Aukcje
     */
    public function setTytul($tytul)
    {
        $this->tytul = $tytul;

        return $this;
    }

    /**
     * Get tytul
     *
     * @return string
     */
    public function getTytul()
    {
        return $this->tytul;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return Aukcje
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set cena
     *
     * @param string $cena
     *
     * @return Aukcje
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return string
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set koniec
     *
     * @param \DateTime $koniec
     *
     * @return Aukcje
     */
    public function setKoniec($koniec)
    {
        $this->koniec = $koniec;

        return $this;
    }

    /**
     * Get koniec
     *
     * @return \DateTime
     */
    public function getKoniec()
    {
        return $this->koniec;
    }

    /**
     * Set zdjecie
     *
     * @param string $zdjecie
     *
     * @return Aukcje
     */
    public function setZdjecie($zdjecie)
    {
        $this->zdjecie = $zdjecie;

        return $this;
    }

    /**
     * Get zdjecie
     *
     * @return string
     */
    public function getZdjecie()
    {
        return $this->zdjecie;
    }
}

