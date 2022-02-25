<?php
declare(strict_types=1);

namespace App;

use PDO;

/***
 * @mixin PDO
 */
class DB
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $defOpt = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->pdo = new PDO(
                'mysql:host='.$config['host'].';dbname='.$config['database'],
                $config['user'],
                $config['password'],
                $config['options'] ?? $defOpt
            );
        }catch (\PDOException $exception){
            throw new \PDOException($exception->getMessage(), $exception->getCode());
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }

}