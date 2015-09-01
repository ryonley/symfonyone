<?php
namespace Acme\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


class User extends BaseUser
{

    protected $id;

    private $posts;

    public function __construct()
    {
        parent::__construct();
        // your own logic

        $this->posts = new ArrayCollection();
    }
}