<?php

namespace App\Http\Controllers;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('contact.index');
    }
}
