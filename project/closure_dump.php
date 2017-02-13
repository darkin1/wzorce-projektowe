<?php
function closure_dump(Closure $c)
{
    $str = 'function (';
    $r = new ReflectionFunction($c);
    $params = array();
    foreach ($r->getParameters() as $p) {
        $s = '';
        if ($p->isArray()) {
            $s .= 'array ';
        } else {
            if ($p->getClass()) {
                $s .= $p->getClass()->name . ' ';
            }
        }
        if ($p->isPassedByReference()) {
            $s .= '&';
        }
        $s .= '$' . $p->name;
        if ($p->isOptional()) {
            $s .= ' = ' . var_export($p->getDefaultValue(), true);
        }
        $params [] = $s;
    }
    $str .= implode(', ', $params);
    $str .= '){' . PHP_EOL;
    $lines = file($r->getFileName());
    for ($l = $r->getStartLine(); $l < $r->getEndLine(); $l++) {
        $str .= $lines[$l];
    }

    echo '<pre>';
    var_dump($str);
    echo '</pre>';
//    return $str;
}