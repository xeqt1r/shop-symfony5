<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="owner")
     */
    private $products;

    /**
     * @var ArrayCollection|Comment[]
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="owner")
     */
    private $comments;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="messageSender")
     */
    private $userSenderMessage;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="messageRecipient")
     */
    private $userRecipientMessage;

    /**
     * @return ArrayCollection
     */
    public function getUserSenderMessage(): ArrayCollection
    {
        return $this->userSenderMessage;
    }

    /**
     * @param ArrayCollection $userSenderMessage
     */
    public function setUserSenderMessage(ArrayCollection $userSenderMessage): void
    {
        $this->userSenderMessage = $userSenderMessage;
    }

    /**
     * @return ArrayCollection
     */
    public function getUserRecipientMessage(): ArrayCollection
    {
        return $this->userRecipientMessage;
    }

    /**
     * @param ArrayCollection $userRecipientMessage
     */
    public function setUserRecipientMessage(ArrayCollection $userRecipientMessage): void
    {
        $this->userRecipientMessage = $userRecipientMessage;
    }





    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment[]|ArrayCollection $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }



    /**
     * @return ArrayCollection
     */
    public function getProducts(): ArrayCollection
    {
        return $this->products;
    }

    /**
     * @param ArrayCollection $products
     */
    public function setProducts(ArrayCollection $products): void
    {
        $this->products = $products;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getRoles()
    {
        return[
            'USER_ROLE'
        ];
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->getEmail();
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
