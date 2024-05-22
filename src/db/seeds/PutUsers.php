<?php


use Phinx\Seed\AbstractSeed;

class PutUsers extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'username' => 'user' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'password' => password_hash('password' . ($i + 1), PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }

        $this->table('users')->insert($data)->save();
    }
}
