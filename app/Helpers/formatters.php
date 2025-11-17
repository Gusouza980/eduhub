<?php

if (!function_exists('clearString')) {
    function clearString(string $string): string
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $string);
    }
}

if (!function_exists('formatDocument')) {
    function formatDocument(string $document): string
    {
        $document = clearString($document);
        if (strlen($document) === 14) {
            return formatCnpj($document);
        }
        return formatCpf($document);
    }
}

if(!function_exists('formatPhone')) {
    function formatPhone(string $phone): string
    {
        return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $phone);
    }
}

if(!function_exists('formatCep')) {
    function formatCep(string $cep): string
    {
        return preg_replace('/(\d{5})(\d{3})/', '$1-$2', $cep);
    }
}

if (!function_exists('formatCnpj')) {
    function formatCnpj(string $cnpj): string
    {
        $cnpj = clearString($cnpj);
        return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $cnpj);
    }
}

if (!function_exists('formatCpf')) {
    function formatCpf(string $cpf): string
    {
        $cpf = clearString($cpf);
        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $cpf);
    }
}