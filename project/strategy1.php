<?php

class Md5
{
    public function encode($secret)
    {
        return md5($secret);
    }
}

class Base64
{
    public function encode($secret)
    {
        return base64_encode($secret);
    }
}

class Sha1
{
    public function encode($secret)
    {
        return sha1($secret);
    }
}


class Hash
{
    private $hash;

    public function __construct($hash)
    {
        $this->hash = $hash;
    }

    public function encode($secret)
    {
        return $this->hash->encode($secret);
    }
}


$hash = new Hash(new Sha1());
var_dump($hash->encode('test'));