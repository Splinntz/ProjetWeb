<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
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
     * @ORM\Column(type="string", length=50)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="idUtilisateur", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Advert", mappedBy="idUser", orphanRemoval=true)
     */
    private $adverts;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->adverts = new ArrayCollection();
        $this->tchats = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->TchatsAux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

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

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(?float $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIdUtilisateur() === $this) {
                $comment->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Advert[]
     */
    public function getAdverts(): Collection
    {
        return $this->adverts;
    }

    public function addAdvert(Advert $advert): self
    {
        if (!$this->adverts->contains($advert)) {
            $this->adverts[] = $advert;
            $advert->setIdUser($this);
        }

        return $this;
    }

    public function removeAdvert(Advert $advert): self
    {
        if ($this->adverts->contains($advert)) {
            $this->adverts->removeElement($advert);
            // set the owning side to null (unless already changed)
            if ($advert->getIdUser() === $this) {
                $advert->setIdUser(null);
            }
        }

        return $this;
    }
   
    private $roles = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberRatings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tchat", mappedBy="user1", orphanRemoval=true)
     */
    private $tchats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="user", orphanRemoval=true)
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tchat", mappedBy="userAux", orphanRemoval=true)
     */
    private $TchatsAux;
    
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }


    public function getNumberRatings(): ?int
    {
        return $this->numberRatings;
    }

    public function setNumberRatings(int $numberRatings): self
    {
        $this->numberRatings = $numberRatings;

        return $this;
    }

    /**
     * @return Collection|Tchat[]
     */
    public function getTchats(): Collection
    {
        return $this->tchats;
    }

    public function addTchat(Tchat $tchat): self
    {
        if (!$this->tchats->contains($tchat)) {
            $this->tchats[] = $tchat;
            $tchat->setUser1($this);
        }

        return $this;
    }


    public function removeTchat(Tchat $tchat): self
    {
        if ($this->tchats->contains($tchat)) {
            $this->tchats->removeElement($tchat);
            // set the owning side to null (unless already changed)
            if ($tchat->getUser1() === $this) {
                $tchat->setUser1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tchat[]
     */
    public function getTchatsAux(): Collection
    {
        return $this->TchatsAux;
    }

    public function addTchatsAux(Tchat $tchatsAux): self
    {
        if (!$this->TchatsAux->contains($tchatsAux)) {
            $this->TchatsAux[] = $tchatsAux;
            $tchatsAux->setUserAux($this);
        }

        return $this;
    }

    public function removeTchatsAux(Tchat $tchatsAux): self
    {
        if ($this->TchatsAux->contains($tchatsAux)) {
            $this->TchatsAux->removeElement($tchatsAux);
            // set the owning side to null (unless already changed)
            if ($tchatsAux->getUserAux() === $this) {
                $tchatsAux->setUserAux(null);
            }
        }

        return $this;
    }

}
