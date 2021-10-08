<?php

namespace App\Controller;

use App\Model\SearchManager;

/**
 * Class search Controller
 *
 */
class SearchController extends AbstractController
{


    /**
     * Display search listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $searchManager = new SearchManager();
        $search = $searchManager->selectAll();

        return $this->twig->render('Search/index.html.twig', ['search' => $search]);
    }

    public function search()
    {
        $searchManager = new SearchManager();
        $allAnnounces = $searchManager->selectAllAnnouncesById();

        if(isset($_GET['s']) AND !empty($_GET['s']))
        {
            $recherche = htmlspecialchars($_GET['s']);
            $allAnnounces = $searchManager->search();
            if($allAnnounces->rowCount() > 0)
            {

            }
            else
            {
                $errorMessage = "Aucune annonce trouvée dans cette ville."
            }
        }
    }
}
