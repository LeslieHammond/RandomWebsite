<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Provider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domain;

    /**
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Link", mappedBy="provider")
     */
    private $link;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ProviderCrawler", mappedBy="provider")
     */
    private $providerCrawler;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProviderTags", mappedBy="provider", cascade={"all"})
     */
    private $providerTags;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetDefaultFields()
    {
        $this->creationDate = new \DateTime('now');
    }

    public function __construct()
    {
        $this->link         = new ArrayCollection();
        $this->providerTags = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getProviderCrawler()
    {
        return $this->providerCrawler;
    }

    public function getProviderTags()
    {
        return $this->providerTags;
    }

    public function addProviderTag(ProviderTags $providerTags)
    {
        $providerTags->setProvider($this);

        $this->providerTags->add($providerTags);
    }

    public function removeProviderTag(ProviderTags $providerTags)
    {
        //$this->providerTags->add($providerTags);
    }

}
