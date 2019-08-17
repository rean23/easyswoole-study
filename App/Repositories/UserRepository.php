<?php


namespace App\Repositories;


class UserRepository extends Repository
{

    public function test() {
        $user = $this->db->getOne('users');
        var_dump($user);
    }
}