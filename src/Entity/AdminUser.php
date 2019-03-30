<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="userlist")
 */
class AdminUser implements UserInterface, \Serializable, EquatableInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;
    
    /**
     * getter for id
     * 
     * @return mixed return value for 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @var string
     * @ORM\Column(name="user", type="string", length=16, nullable=false)
     */
    protected $username;
    
    /**
     * setter for username
     *
     * @param mixed 
     * @return self
     */
    public function setUsername($value)
    {
        $this->username = $value;
        return $this;
    }
    
    /**
     * getter for username
     * 
     * @return mixed return value for 
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @var string
     * @ORM\Column(name="pass", type="string", length=250, nullable=true)
     */
    protected $password;
    
    /**
     * setter for password
     *
     * @param mixed 
     * @return self
     */
    public function setPassword($value)
    {
        $this->password = $value;
        return $this;
    }
    
    /**
     * getter for password
     * 
     * @return mixed return value for 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @var string
     * @ORM\Column(name="language", type="string", length=2, nullable=true)
     */
    protected $language;
    
    /**
     * setter for language
     *
     * @param mixed 
     * @return self
     */
    public function setLanguage($value)
    {
        $this->language = $value;
        return $this;
    }
    
    /**
     * getter for language
     * 
     * @return mixed return value for 
     */
    public function getLanguage()
    {
        return $this->language;
    }
    
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }
    
    public function getSalt()
    {
        
    }
    
    public function eraseCredentials()
    {
        $this->password = '';
    }
    
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->language,
        ]);
    }
    
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->language,
        ) = unserialize($serialized);
    }
    
    public function isEqualTo(UserInterface $user)
    {
        if ($this->id !== $user->getId()) {
            return false;
        }
        
        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }
    
}