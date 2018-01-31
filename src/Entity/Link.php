<?php
// src/Entity/Link.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Link
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1023, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="link")
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

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
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
