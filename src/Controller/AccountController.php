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

        return $this->twig->render('Account/index.html.twig', [
            'accounts' => $accounts,
        ]);
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

        if(!$id || !$account)
        {
            header("Location: /account");
        }

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

        if(!$id || !$account)
        {
            header("Location: /account");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account['id'] = $_POST['id'];
            $account['firstname'] = $_POST['firstname'];
            $account['lastname'] = $_POST['lastname'];
            $account['username'] = $_POST['username'];
            $account['password'] = $_POST['password'];
            if(isset($_POST['role']))
            {
                $account['role'] = 'ADMIN';
            }
            else
            {
                $account['role'] = 'USER';
            }
            $account['birthday'] = $_POST['birthday'];
            $account['address'] = $_POST['address'];
            $account['city'] = $_POST['city'];
            $account['postal_code'] = $_POST['postal_code'];
            $account['phone'] = $_POST['phone'];
            
            
            if($account['firstname'] && $account['lastname'] && $account['username'] && $account['username'])
            {
                $id = $accountManager->update($account);
                header("Location: /account");
            }
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
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'birthday' => $_POST['birthday'],
                'address' => $_POST['address'],
                'city' => $_POST['city'],
                'postal_code' => $_POST['postal_code'],
                'phone' => $_POST['phone'],
            ];
            
            if(isset($_POST['role']))
            {
                $account['role'] = 'ADMIN';
            }
            else
            {
                $account['role'] = 'USER';
            }

            if($account['firstname'] && $account['lastname'] && $account['username'] && $account['username'])
                {
                    $id = $accountManager->insert($account);
                    header('Location:/account/show/' . $id);
                }
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
