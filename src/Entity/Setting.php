<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * @ORM\Entity(repositoryClass="App\Entity\Repositories\SettingRepository")
 * @ORM\Table(name="settings")
 */
class Setting
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", name="name")
     */
    private $name;
    
    /**
     * getter for id
     * 
     * @return mixed return value for 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }
    
    /**
     * @var string
     * @ORM\Column(name="value", type="string", length=100, nullable=true)
     */
    protected $value;
    
    /**
     * setter for value
     *
     * @param mixed 
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
    
    /**
     * getter for value
     * 
     * @return mixed return value for 
     */
    public function getValue()
    {
        return $this->value;
    }
    
    private static $ftpdConfigs = [
        // networking
        'IPV4Only' => '-4',
        'IPV6Only' => '-6',
        'PassivePortRange' => '-p',
        'ForcePassiveIP' => '-P',
        'TLS' => '-Y',
        'TLSCipherSuite' => '-J',
        
        // environemnt
        'Bind' => '-S',
        'Daemonize' => '-B',
        'TrustedGID' => '-a',
        'ChrootEveryone' => '-A',
        'FSCharset' => '-8',
        
        // log
        'LogPID' => '-1',
        'AltLog' => '-O',
        'VerboseLog' => '-d',

        // misc
        'NoTruncate' => '-0',

        // clients and communication
        'BrokenClientsCompatibility' => '-b',
        'MaxClientsNumber' => '-c',
        'MaxClientsPerIP' => '-C',
        'ClientCharset' => '-9',
        'NoChmod' => '-R',
        'NoRename' => '-G',
        'Quota' => '-n',



        'AllowDotFiles' => '-z',
        'AllowUserFXP' => '-w',
        'AnonymousBandwidth' => '-t',
        'AnonymousCanCreateDirs' => '-M',
        'AnonymousCantUpload' => '-i',
        'AnonymousOnly' => '-e',
        'AnonymousRatio' => '-q',
        'AntiWarez' => '-s',
        'AutoRename' => '-r',
        'CallUploadScript' => '-o',
        'CreateHomeDir' => '-j',
        'CustomerProof' => '-Z',
        'DisplayDotFiles' => '-D',
        'DontResolve' => '-H',
        'FortunesFile' => '-F',
        'KeepAllFiles' => '-K',
        'LimitRecursion' => '-L',
        'MaxDiskUsage' => '-k',
        'MaxIdleTime' => '-I',
        'MaxLoad' => '-m',
        'MinUID' => '-u',
        'NATmode' => '-N',
        'NoAnonymous' => '-E',
        'PerUserLimits' => '-y',
        'ProhibitDotFilesRead' => '-X',
        'ProhibitDotFilesWrite' => '-x',
        'SyslogFacility' => '-f',
        'TrustedIP' => '-V',
        'Umask' => '-U',
        'UserBandwidth' => '-T',
        'UserRatio' => '-Q',
    ];
    
    private static $ftpduiConfigs = [
        'FTPDUIDefaultDir' => '',
        'FTPDUIDefaultUploadSpeed' => '',
        'FTPDUIDefaultDownloadSpeed' => '',
        'FTPDUIDefaultQuotaSize' => '',
        'FTPDUIDefaultQuotaFiles' => '',
        'FTPDUIDefaultPermittedIP' => '',
    ];
    
    public function isFTPDSetting()
    {
        return isset(self::$ftpdConfigs[$this->name]);
    }
    
    public function getShortArgument()
    {
        if (!$this->isFTPDSetting()) {
            return;
        }
        
        return self::$ftpdConfigs[$this->name];
    }
    
    public static function getFTPDSettingKeys()
    {
        return array_keys(self::$ftpdConfigs);
    }
    
    public static function getFTPDUISettingKeys()
    {
        return array_keys(self::$ftpduiConfigs);
    }
    
    public static function getDefaultValueForKey($key)
    {
        if (isset(self::$ftpdConfigs[$key])) {
            return self::$ftpdConfigs[$key];
        }

        if (isset(self::$ftpduiConfigs[$key])) {
            return self::$ftpduiConfigs[$key];
        }
        
        return null;
    }
    
    public function getLabel()
    {
        return '';
    }
}