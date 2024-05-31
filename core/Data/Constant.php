<?php namespace Core\Data;

class Constant
{
    public static function SetError(string $msg) : void {
        global $error;
        $error = $msg;
    }
    public static function GetError() : string {
        global $error;
        return $error;
    }
    public static function IsDebug() : bool {
        return $_ENV['DEBUG'] == 'true';
    }
}