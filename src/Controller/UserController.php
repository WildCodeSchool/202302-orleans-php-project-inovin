<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Mime\Email;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/user', name: 'user_profile_')]
class UserController extends AbstractController
{
    #[Route('/profil/{id}', name: 'show', methods: ['GET', 'POST'])]
    public function showProfile(
        Request $request,
        User $user,
        UserRepository $userRepository,
    ): Response {
        $currentUser = $this->getUser();
        if ($currentUser !== $user) {
            throw $this->createAccessDeniedException("Accès refusé. Vous n'êtes pas autorisé à accéder à ce profil.");
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            $this->addFlash("success", "Vos informations ont été modifiées !");

            return $this->redirectToRoute('user_profile_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user_profile/userProfile.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/profil/{id}/desactivation', name: 'desable', methods: ['GET', 'POST'])]
    public function desableAccount(MailerInterface $mailer, User $user): Response
    {
        $email = (new Email())
            ->from($user->getEmail())
            ->to($this->getParameter('mailer_from'))
            ->subject('Désactivation compte utilisateur')
            ->html($this->renderView('user_profile/email.html.twig', ['user' => $user]));

        $mailer->send($email);
        $this->addFlash("success", "Votre demande sera traitée dans les plus brefs délais");

        return $this->redirectToRoute('user_profile_show', ['id' => $user->getId()], Response::HTTP_SEE_OTHER);
    }
}
