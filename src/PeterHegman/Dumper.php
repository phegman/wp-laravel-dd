<?php

namespace PeterHegman;

use Symfony\Component\VarDumper\Cloner\VarCloner;

class Dumper
{
    /**
     * Dump a value with elegance.
     *
     * @param  mixed  $value
     * @return void
     */
    public function dump($value)
    {
        $dumper = new HtmlDumper;
        $dumper->dump((new VarCloner)->cloneVar($value));
    }
}