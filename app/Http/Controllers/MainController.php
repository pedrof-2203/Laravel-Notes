<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        echo 'Inside';
    }

    public function newNote() {
        echo "Creating new note";
    }
}
