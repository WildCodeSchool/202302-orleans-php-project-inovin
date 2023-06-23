<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/seance', name: 'app_session_')]
class SessionController extends AbstractController
{
    #[Route('/etats/all', name: 'all_states', methods: ['GET'])]
    public function states(SessionRepository $sessionRepository): Response
    {
        $sessionsOpened = $sessionRepository->findBy(['closed' => '0'], ['openingDate' => 'desc']);

        return $this->render('session/sessions_states_html.twig', [
            'sessionsOpened' => $sessionsOpened
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/start/{session}', requirements: ['session' => '\d+'], methods: ['GET'], name: 'start_new')]
    public function startSession(Session $session, SessionRepository $sessionRepository): Response
    {

        return $this->render('tasting_sheet/index.html.twig', [
            'session' => $session,
        ]);
    }
}
