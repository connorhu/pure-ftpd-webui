<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="ftpd")
 */
class FtpUser
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
     * @ORM\Column(name="User", type="string", length=16, nullable=false)
     */
    protected $login;
    
    /**
     * setter for login
     *
     * @param mixed 
     * @return self
     */
    public function setLogin($value)
    {
        $this->login = $value;
        return $this;
    }
    
    /**
     * getter for login
     * 
     * @return mixed return value for 
     */
    public function getLogin()
    {
        return $this->login;
    }
    
    /**
     * @var string
     * @ORM\Column(name="status", type="boolean")
     */
    protected $active = false;
    
    /**
     * setter for active
     *
     * @param mixed 
     * @return self
     */
    public function setActive($value)
    {
        $this->active = $value;
        return $this;
    }
    
    /**
     * getter for active
     * 
     * @return mixed return value for 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    public function isActive()
    {
        return $this->active;
    }
    
    /**
     * @var string
     * @ORM\Column(name="Password", type="string", length=64, nullable=true)
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
     * @ORM\Column(name="Uid", type="string", length=11, nullable=true)
     */
    protected $uid = 2001;
    
    /**
     * setter for uid
     *
     * @param mixed 
     * @return self
     */
    public function setUid($value)
    {
        $this->uid = $value;
        return $this;
    }
    
    /**
     * getter for uid
     * 
     * @return mixed return value for 
     */
    public function getUid()
    {
        return $this->uid;
    }
    
    /**
     * @var string
     * @ORM\Column(name="Gid", type="string", length=11, nullable=true)
     */
    protected $gid = 2001;
    
    /**
     * setter for gid
     *
     * @param mixed 
     * @return self
     */
    public function setGid($value)
    {
        $this->gid = $value;
        return $this;
    }
    
    /**
     * getter for gid
     * 
     * @return mixed return value for 
     */
    public function getGid()
    {
        return $this->gid;
    }
    
    /**
     * @var string
     * @ORM\Column(name="Dir", type="string", length=128, nullable=true)
     */
    protected $uploadDirectory;
    
    /**
     * setter for uploadDirectory
     *
     * @param mixed 
     * @return self
     */
    public function setUploadDirectory($value)
    {
        $this->uploadDirectory = $value;
        return $this;
    }
    
    /**
     * getter for uploadDirectory
     * 
     * @return mixed return value for 
     */
    public function getUploadDirectory()
    {
        return $this->uploadDirectory;
    }
    
    /**
     * @var integer
     * @ORM\Column(name="ULBandwidth", type="integer", nullable=true)
     */
    protected $uploadBandwidth;
    
    /**
     * setter for uploadBandwidth
     *
     * @param mixed 
     * @return self
     */
    public function setUploadBandwidth($value)
    {
        $this->uploadBandwidth = $value;
        return $this;
    }
    
    /**
     * getter for uploadBandwidth
     * 
     * @return mixed return value for 
     */
    public function getUploadBandwidth()
    {
        return $this->uploadBandwidth;
    }
    
    /**
     * @var integer
     * @ORM\Column(name="DLBandwidth", type="integer", nullable=true)
     */
    protected $downloadBandwidth;
    
    /**
     * setter for downloadBandwidth
     *
     * @param mixed 
     * @return self
     */
    public function setDownloadBandwidth($value)
    {
        $this->downloadBandwidth = $value;
        return $this;
    }
    
    /**
     * getter for downloadBandwidth
     * 
     * @return mixed return value for 
     */
    public function getDownloadBandwidth()
    {
        return $this->downloadBandwidth;
    }
    
    /**
     * @var string
     * @ORM\Column(name="ipaccess", type="string", length=10, nullable=true)
     */
    protected $ipaccess;
    
    /**
     * setter for ipaccess
     *
     * @param mixed 
     * @return self
     */
    public function setIpaccess($value)
    {
        $this->ipaccess = $value;
        return $this;
    }
    
    /**
     * getter for ipaccess
     * 
     * @return mixed return value for 
     */
    public function getIpaccess()
    {
        return $this->ipaccess;
    }
    
    /**
     * @var integer
     * @ORM\Column(name="QuotaSize", type="integer", nullable=true)
     */
    protected $quotaSize;
    
    /**
     * setter for quotaSize
     *
     * @param mixed 
     * @return self
     */
    public function setQuotaSize($value)
    {
        $this->quotaSize = $value;
        return $this;
    }
    
    /**
     * getter for quotaSize
     * 
     * @return mixed return value for 
     */
    public function getQuotaSize()
    {
        return $this->quotaSize;
    }
    
    /**
     * @var integer
     * @ORM\Column(name="QuotaFiles", type="integer", nullable=true)
     */
    protected $quotaFiles;
    
    /**
     * setter for quotaFiles
     *
     * @param mixed 
     * @return self
     */
    public function setQuotaFiles($value)
    {
        $this->quotaFiles = $value;
        return $this;
    }
    
    /**
     * getter for quotaFiles
     * 
     * @return mixed return value for 
     */
    public function getQuotaFiles()
    {
        return $this->quotaFiles;
    }
    
    /**
     * @var string
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;
    
    /**
     * setter for comment
     *
     * @param mixed 
     * @return self
     */
    public function setComment($value)
    {
        $this->comment = $value;
        return $this;
    }
    
    /**
     * getter for comment
     * 
     * @return mixed return value for 
     */
    public function getComment()
    {
        return $this->comment;
    }

}