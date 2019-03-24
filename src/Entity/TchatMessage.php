<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TchatMessageRepository")
 */
class TchatMessage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_user_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_tchat_id;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNameUserName(): ?string
    {
        return $this->name_user_name;
    }

    public function setNameUserName(string $name_user_name): self
    {
        $this->name_user_name = $name_user_name;

        return $this;
    }

    public function getIdTchatId(): ?int
    {
        return $this->id_tchat_id;
    }

    public function setIdTchatId(int $id_tchat_id): self
    {
        $this->id_tchat_id = $id_tchat_id;

        return $this;
    }
}
