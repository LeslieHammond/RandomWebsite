<?php
// src/Entity/ProviderTags.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderTagsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ProviderTags
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
    private $tag;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;

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

    public function getTag()
    {
        return $this->tag;
    }

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
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
