<?php

namespace App\Security;

use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class Md5PasswordEncoder extends BasePasswordEncoder implements PasswordEncoderInterface
{
    public function encodePassword($raw, $salt)
    {
        return md5($raw);
    }
    
    protected function comparePasswords($pass1, $pass2)
    {
        return $pass1 === $pass2;
    }

    public function isPasswordValid($encoded, $raw, $salt)
    {
        try {
            $rawEncoded = $this->encodePassword($raw, $salt);
        } catch (BadCredentialsException $e) {
            return false;
        }

        return $this->comparePasswords($encoded, $rawEncoded);
    }
}