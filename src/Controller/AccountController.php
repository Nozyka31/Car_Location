<?php

namespace App\Controller;

use App\Model\AccountManager;

/**
 * Class AccountController
 *
 */
class AccountController extends AbstractController
{


    /**
     * Display account listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $accountManager = new AccountManager();
        $accounts = $accountManager->selectAll();

        return $this->twig->render('Account/index.html.twig', ['accounts' => $accounts]);
    }


    /**
     * Display account informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $accountManager = new AccountManager();
        $account = $accountManager->selectOneById($id);

        return $this->twig->render('Account/show.html.twig', ['account' => $account]);
    }


    /**
     * Display account edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $accountManager = new AccountManager();
        $account = $accountManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account['title'] = $_POST['title'];
            $accountManager->update($account);
        }

        return $this->twig->render('Account/edit.html.twig', ['account' => $account]);
    }


    /**
     * Display account creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accountManager = new AccountManager();
            $account = [
                'title' => $_POST['title'],
            ];
            $id = $accountManager->insert($account);
            header('Location:/account/show/' . $id);
        }

        return $this->twig->render('Account/add.html.twig');
    }


    /**
     * Handle account deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $accountManager = new AccountManager();
        $accountManager->delete($id);
        header('Location:/account/index');
    }
}
