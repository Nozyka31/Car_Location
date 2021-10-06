<?php

namespace App\Controller;

use App\Model\SearchManager;

/**
 * Class rechercheController
 *
 */
class SearchController extends AbstractController
{


    /**
     * Displayrecherche listing
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


    /**
     * Display recherche informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $searchManager = new SearchManager();
        $search = $searchManager->selectOneById($id);

        return $this->twig->render('Search/show.html.twig', ['recherche' => $search]);
    }


    /**
     * Display recherche edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $searchManager = new SearchManager();
        $search= $searchManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search['firstname'] = $_POST['firstname'];
            $searchManager->update($search);
        }

        return $this->twig->render('Search/edit.html.twig', ['search' => $search]);
    }


    /**
     * Display recherchecreation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $searchManager = new SearchManager();
            $search = [
                'firstname' => $_POST['firstname'],
            ];
            $id = $searchManager->insert($search);
            header('Location:/search/show/' . $id);
        }

        return $this->twig->render('Search/add.html.twig');
    }


    /**
     * Handle recherche deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $searchManager = new SearchManager();
        $searchManager->delete($id);
        header('Location:/search/index');
    }
}
