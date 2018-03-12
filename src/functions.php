<?php declare(strict_types=1);

function maskString(string $value, string $pattern) : string
{
    $masked = '';
    $k = 0;

    for ($i = 0; $i < strlen($pattern); $i++) {
        if ($pattern[$i] == '#') {
            if (isset($value[$k])) {
                $masked .= $value[$k++];
            }
        } else {
            if (isset($pattern[$i])) {
                $masked .= $pattern[$i];
            }
        }
    }

    return $masked;
}

function cleanDocument(string $value) : string
{
    return str_replace(['.', '-', '/'], '', $value);
}

