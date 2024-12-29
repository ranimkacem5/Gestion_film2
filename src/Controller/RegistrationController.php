<?php


namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration')]
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez la soumission du formulaire, enregistrez l'utilisateur, etc.

            return $this->redirectToRoute('app_home'); // Redirigez après inscription
        }

        return $this->render('registration/registration.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
