<?php

namespace App\Controller;

use App\Model\UserManager;
use App\Model\AccountManager;

/**
 * Class userController
 *
 */
class UserController extends AbstractController
{


    /**
     * Display user listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $accountManager = new AccountManager();
        $users = $accountManager->selectAll();

        return $this->twig->render('User/index.html.twig', ['users' => $users]);
    }


    /**
     * Display user informations specified by $id
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
        $user = $accountManager->selectOneById($id);

        return $this->twig->render('User/show.html.twig', ['user' => $user]);
    }


    /**
     * Display user edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id=0): string
    {
        $accountManager = new AccountManager();
        $user = $accountManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user['title'] = $_POST['title'];
            $accountManager->update($user);
        }

        return $this->twig->render('User/edit.html.twig', ['user' => $user]);
    }


    /**
     * Display user creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function login()
    {
        /*var_dump($_POST);
        die;*/
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $accountManager = new AccountManager();
            $user = $accountManager->selectOneByEmail($_POST["email"]);
            if ($user && isset($user["password"])) 
            {
                $connect = password_verify($_POST["password"], $user["password"]);
            }
            else
            {
                $connect=false;
            } 
            
            if (!$connect){
                $errorMessage = "There is an issue with your e-mail or password. Please try again";
                return $this->twig->render('user/login.html.twig', [
                    'errormessage' => $errorMessage,
                ]);
                   
            } else{

                    $_SESSION["user"] = [
                        "id" => $user["id"],
                        "firstname" => $user["firstname"],
                        "lastname" => $user["lastname"],
                        "email" => $user["email"],
                        "phone" => $user["phone"],
                        "role" => $user["role"],
                    ];
                    
            header('Location:/');
        }
    }
        return $this->twig->render('user/login.html.twig');
    }

 /**
     * Display user logout page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function logout()
    {  
        unset($_SESSION["user"]);
        header("Location: /");
        exit;
    }

    public function checkLogin()
    {
        header("Location: /");  
    }

}