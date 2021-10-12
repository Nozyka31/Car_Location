<?php

namespace App\Controller;

use App\Model\AnnounceManager;
use App\Model\AccountManager;
use App\Model\BookingManager;


class BookingController extends AbstractController
{    

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        return $this->twig->render('Booking/index.html.twig');
    }

    public function show(int $id)
    {
        $announceManager = new AnnounceManager();
        $accountManager = new AccountManager();
        $announce = $announceManager->selectOneById($id);
        $user = $accountManager->selectOneById($announce['user_id']);

        if(!$id || !$announce)
        {
            header("Location: /announce");
        }

        return $this->twig->render('Booking/index.html.twig', [
            'announce' => $announce,
            'user' => $user,
            'days' => 0,
        ]);
    }

    public function add(int $id, int $days)
    {
        
        $announceManager = new AnnounceManager();
        $accountManager = new AccountManager();
        $announce = $announceManager->selectOneById($id);
        $user = $accountManager->selectOneById($announce['user_id']);

        $days++;
        $price = $announce['daily_price'] * $days;

        return $this->twig->render('Booking/index.html.twig', [
            'announce' => $announce,
            'user' => $user,
            'price' => $price,
            'days' => $days,
        ]);
    }

    public function book(int $id, int $days)
    {
        if(!$_SESSION)
        {
            var_dump($_SESSION);
        }
        else
        {
            $announceManager = new AnnounceManager();
            $announce = $announceManager->selectOneById($id);

            $userID = $_SESSION['user']['id'];
            $renterID = $announce['user_id'];
                $bookingManager = new BookingManager();
                $booking = [
                    'user_id' => $userID,
                    'renter_id' => $renterID,
                    'announce_id' => $id,
                    'duration' => $days,
                    'price' => $days * $announce['daily_price'],
                ];

                $id = $bookingManager->insert($booking);
                header('Location:/account/show/' . $userID);

            return $this->twig->render('Booking/index.html.twig', [
                'announce' => $announce,
                'user' => $_SESSION['user'],
                'price' => $announce['daily_price'] * $days,
                'days' => $days,
            ]);
        }
    }
}
