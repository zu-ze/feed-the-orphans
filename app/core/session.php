<?php

class Session 
{
    protected const FLASH_KEY = 'flash_messages';
    protected const USER_KEY = 'current_user';
    protected const ORPHANAGE_KEY = 'current_orphanage';

    public function __construct()
    {
        session_start();
        $_SESSION[self::USER_KEY] ?? [];
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['removed'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;

    }

    public function setUser($user)
    {
        $_SESSION[self::USER_KEY] = $user;
    }

    public function setOrphanage($orphanage)
    {
        $_SESSION[self::ORPHANAGE_KEY] = $orphanage;
    }

    public function getOrphanage()
    {
        return $_SESSION[self::ORPHANAGE_KEY] ?? false;
    }

    public function getUser()
    {
        return $_SESSION[self::USER_KEY] ?? new User;
    }

    public function userLogout()
    {
        $_SESSION[self::USER_KEY] = new User;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'removed' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['removed']) {
                unset($flashMessages[$key]);
            }
        }
        
        $_SESSION[self::FLASH_KEY] = $flashMessages;

    }
}