<?php

namespace App\Controller;

use App\Model\AnnounceManager;

/**
 * Class AnnounceController
 *
 */
class AnnounceController extends AbstractController
{


    /**
     * Display announce listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $announceManager = new AnnounceManager();
        $announces = $announceManager->selectAll();

        return $this->twig->render('Announce/index.html.twig', [
            'announces' => $announces,
        ]);
    }




    /**
     * Display announce informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $announceManager = new AnnounceManager();
        $announce = $announceManager->selectOneById($id);

        if(!$id || !$announce)
        {
            header("Location: /announce");
        }

        return $this->twig->render('Announce/show.html.twig', ['announce' => $announce]);
    }


    /**
     * Display announce edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function edit(int $id): string
    {
        $announceManager = new AnnounceManager();
        $announce = $announceManager->selectOneById($id);

        if(!$id || !$announce)
        {
            header("Location: /announce");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $errorMessage = false;

            $file = $_FILES['picture'];
            $fileOnServer = $file['tmp_name'];

            
            if($fileOnServer)
            {
            $autorizedMime = [
            "image/jpeg", "image/jpg", "image/gif", "image/png"
            ];

            if($file)
            {
                //Test mime type
                $testMime = mime_content_type($fileOnServer);
                if(!in_array($testMime, $autorizedMime))
                {
                $errorMessage = "Le type du fichier n'est pas reconnu. Veuillez uploader une image.";
                }

                //Test if the file is uploaded
                if(!is_uploaded_file($fileOnServer))
                {
                $errorMessage = "Le fichier ne s'est pas upload correctement";
                }

                //Test the size of the file
                $fileSize = filesize($fileOnServer);
                if($fileSize > 1000000)
                {
                $errorMessage = "Le fichier est trop volumineux";
                }

                if(!$errorMessage)
                {
                    $originalFileName = basename($file['name']);
                    $ext = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $mainName = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $tmpCleanedName = preg_replace("/\s/", "-", $mainName);
                    $cleanedName = trim($tmpCleanedName, "-");
                    $finalName = $cleanedName . uniqid() . '.' . $ext;
                    $destination = UPLOADFOLDER . $finalName;
                    $sucessUpload = move_uploaded_file($fileOnServer, '.' . $destination);
                    if(!$sucessUpload)
                    {
                        $message = "Fichier uploadé avec succès!";
                    }
                    else
                    {
                        $message = "Echec de l'upload du fichier.";
                    }
                }
            }
            }
            

            $announce['id'] = $_POST['id'];
            $announce['title'] = $_POST['title'];
            $announce['registration_number'] = $_POST['registration_number'];
            $announce['brand'] = $_POST['brand'];
            $announce['model'] = $_POST['model'];
            $announce['color'] = $_POST['color'];
            $announce['power'] = $_POST['power'];
            $announce['city'] = $_POST['city'];
            $announce['km'] = $_POST['km'];
            $announce['daily_price'] = $_POST['daily_price'];
            if($fileOnServer)
            {
                $announce['picture'] = $destination;
            }
            $announce['year'] = $_POST['year'];
            
            
            if($announce['title'] && $announce['brand'] && $announce['model'] && $announce['daily_price'])
            {
                $id = $announceManager->update($announce);
                header("Location: /announce");
            }
        }

        return $this->twig->render('Announce/edit.html.twig', ['announce' => $announce]);
    }


    /**
     * Display announce creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        $userID=1;//$_SESSION['user']['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errorMessage = false;

            $file = $_FILES['picture'];
            $fileOnServer = $file['tmp_name'];
            $autorizedMime = [
            "image/jpeg", "image/jpg", "image/gif", "image/png"
            ];

            if($file)
            {
                //Test mime type
                $testMime = mime_content_type($fileOnServer);
                if(!in_array($testMime, $autorizedMime))
                {
                $errorMessage = "Le type du fichier n'est pas reconnu. Veuillez uploader une image.";
                }

                //Test if the file is uploaded
                if(!is_uploaded_file($fileOnServer))
                {
                $errorMessage = "Le fichier ne s'est pas upload correctement";
                }

                //Test the size of the file
                $fileSize = filesize($fileOnServer);
                if($fileSize > 1000000)
                {
                $errorMessage = "Le fichier est trop volumineux";
                }

                if(!$errorMessage)
                {
                    $originalFileName = basename($file['name']);
                    $ext = pathinfo($originalFileName, PATHINFO_EXTENSION);
                    $mainName = pathinfo($originalFileName, PATHINFO_FILENAME);
                    $tmpCleanedName = preg_replace("/\s/", "-", $mainName);
                    $cleanedName = trim($tmpCleanedName, "-");
                    $finalName = $cleanedName . uniqid() . '.' . $ext;
                    $destination = UPLOADFOLDER . $finalName;
                    $sucessUpload = move_uploaded_file($fileOnServer, '.' . $destination);
                    
                    if(!$sucessUpload)
                    {
                        $message = "Fichier uploadé avec succès!";
                    }
                    else
                    {
                        $message = "Echec de l'upload du fichier.";
                    }
                }
            }

            

            $announceManager = new AnnounceManager();
            $announce = [
                'user_id' => $userID,
                'title' => $_POST['title'],
                'registration_number' => $_POST['registration_number'],
                'brand' => $_POST['brand'],
                'model' => $_POST['model'],
                'color' => $_POST['color'],
                'power' => $_POST['power'],
                'city' => $_POST['city'],
                'km' => $_POST['km'],
                'daily_price' => $_POST['daily_price'],
                'picture' => $destination,
                'year' => $_POST['year'],
            ];

            if($announce['title'] && $announce['registration_number'] && $announce['daily_price'] && $announce['year'])
                {
                    $id = $announceManager->insert($announce);
                    header('Location:/announce/show/' . $id);
                }
        }

        return $this->twig->render('Announce/add.html.twig');
    }


    /**
     * Handle announce deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $announceManager = new AnnounceManager();
        $announceManager->delete($id);
        header('Location:/announce/index');
    }
}
