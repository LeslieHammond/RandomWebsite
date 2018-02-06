<?php
// src/Entity/ProviderCrawler.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderCrawlerRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ProviderCrawler
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
    private $service;

    /**
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Provider", inversedBy="providerCrawler")
     * @ORM\JoinColumn(nullable=true)
     */
    private $provider;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetDefaultFields()
    {
        $this->creationDate = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getService()
    {
        return $this->service;
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getProvider(): Provider
    {
        return $this->provider;
    }

    public function setProvider(Provider $provider)
    {
        $this->provider = $provider;
    }

}
