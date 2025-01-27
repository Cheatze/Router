<?php

class BookController
{
    public static function index()
    {
        if (isset($_SESSION['books'])) {
            $books = $_SESSION['books'];
        } else {
            $books = [];
        }
        include_once 'html/index.html';
    }

    

}