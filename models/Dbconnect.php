<?php

    class DBconnect
    {
        static public function connect(){
            $link = new PDO(
                'mysql:host=localhost;dbname=pos', 'root', ''
            );

            $link ->exec('set names utf8');

            return $link;
        }
    }