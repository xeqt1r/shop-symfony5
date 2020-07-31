<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments")
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{

    public function __construct()
    {
        $this->dateAdded = new DateTime('now');
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAdded;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     */
    private $owner;

    /**
     * @var Product
     * @ORM\ManyToOne(targetEntity="App\Entity\Product",inversedBy="comments")
     */
    private $product;

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return Comment
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return Comment
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}
