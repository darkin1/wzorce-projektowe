<?php

class CompanyTransformer
{
    public function transform($value)
    {
        return strtoupper($value);
    }
}

class CompanyController
{
    protected $transformer;

    public function __construct($transformer)
    {
        $this->transformer = $transformer;
    }


    public function show()
    {
        $name = 'acme';
        return $this->transformer->transform($name);
    }
}

$company = new CompanyController(new CompanyTransformer());
var_dump($company->show());