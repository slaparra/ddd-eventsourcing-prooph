<?php

namespace Core\UInterface\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        return $this->render('playlists.html.twig', []);
    }
}
