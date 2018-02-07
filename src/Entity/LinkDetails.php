<?php
// src/Entity/Link.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkDetailsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class LinkDetails
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1023, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(name="updateDate", type="datetime", nullable=true)
     */
    private $updateDate;

    /**
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Link", inversedBy="linkDetails")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    private $link;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersistSetDefaultFields()
    {
        $this->creationDate = new \DateTime('now');
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdateSetDefaultFields()
    {
        $this->updateDate = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getShortTitle()
    {
        $length = 100;
        if (strlen($this->title) > $length)
        {
            return substr($this->title, 0, $length) . '...';
        }

        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getImage()
    {
        if (is_resource($this->image))
        {
            return stream_get_contents($this->image);
        }

        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getLink(): Link
    {
        return $this->link;
    }

    public function setLink(Link $link)
    {
        $this->link = $link;
    }
}
