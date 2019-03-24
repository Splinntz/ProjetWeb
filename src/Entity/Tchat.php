<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TchatRepository")
 */
class Tchat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user_id_1;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user_id_2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUserId1(): ?int
    {
        return $this->id_user_id_1;
    }

    public function setIdUserId1(int $id_user_id_1): self
    {
        $this->id_user_id_1 = $id_user_id_1;

        return $this;
    }

    public function getIdUserId2(): ?int
    {
        return $this->id_user_id_2;
    }

    public function setIdUserId2(int $id_user_id_2): self
    {
        $this->id_user_id_2 = $id_user_id_2;

        return $this;
    }
}
