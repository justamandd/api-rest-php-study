<?php

    namespace App\Models;

    class User
    {
        private static $table = 'user';

        public static function select(int $id){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Nenhum usuário encontrado!");
                
            }
        }

        public static function selectAll(){
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            $sql = 'SELECT * FROM '.self::$table;
            $stmt = $connPdo->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }else{
                throw new \Exception("Nenhum usuário encontrado!");
                
            }
        }

        public static function insert($data)
        {   
            //em um caso de uso real, tratar os dados que vem do $data e retornar um erro caso sejam nulos
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME,DBUSER,DBPASS);

            $sql = 'INSERT INTO '.self::$table. ' VALUES (NULL,:email,:password,:name)';
            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':email', $data['email']);
            $stmt->bindValue(':password', $data['password']);
            $stmt->bindValue(':name', $data['name']);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return 'Success user insert!';
            }else{
                throw new \Exception("Failure on user insert!");
                
            }
        }
    }