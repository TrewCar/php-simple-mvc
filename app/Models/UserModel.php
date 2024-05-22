<?php namespace App\Models;
use Core\Database\Database;

class UserModel{
    public function __construct(public int $id) { }
    public function getInfo(){
        // Выполнение запроса к базе данных
        $user = (new Database())->query(
            "SELECT
                id,
                username,
                email
            FROM users
            WHERE id = {$this->id}"
        );

        // Если пользователь не найден, возвращаем сообщение об ошибке
        if (!$user || count($user) == 0) {
            return "Not found user by ID = {$this->id}";
        }

        // Возвращаем информацию о пользователе
        return [
            'id' => $user[0]['id'],
            'name' => $user[0]['username'],
            'email' => $user[0]['email']
        ];
    }
}