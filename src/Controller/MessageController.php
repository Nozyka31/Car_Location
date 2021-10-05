<?php

namespace App\Controller;

class MessageController extends AbstractController
{

    /**
     * Display message page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Message/index.html.twig');
    }
}
