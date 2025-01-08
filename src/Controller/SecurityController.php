<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request): Response
    {
        // If the user is already logged in, redirect them to the home page
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // Handling the login logic here (this would typically be handled by Symfony security)
        if ($request->isMethod('POST')) {
            // Get login credentials from POST data
            $username = $request->get('_username');
            $password = $request->get('_password');

            // You can handle your authentication here (custom logic or rely on Symfony Security)
            // For now, let's just simulate that with a simple response
            if ($username && $password) {
                return $this->redirectToRoute($this->getUser()->getRoles() === ["ROLE_USER"] ? 'app_home': 'app_home_admin');
            }

            // If no credentials or invalid credentials, show the login form
            return $this->render('SignUp.html.twig', ['error' => 'Invalid credentials']);
        }

        return $this->render('SignUp.html.twig');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Symfony handles logout automatically
    }

    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager
    ): Response {
        // If the user is already logged in, redirect them to the home page
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // Handle the registration logic manually
        if ($request->isMethod('POST')) {
            // Get the data from the request
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');

            // Basic validation (you may want to add more robust validation here)
            if (!$name || !$email || !$password) {
                return $this->render('Signin.html.twig', ['error' => 'All fields are required']);
            }

            // Create a new user entity
            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setRoles(["ROLE_USER"]);

            // Hash the password
            $hashedPassword = $passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);

            // Save the user to the database
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirect to the login page after successful registration
            return $this->redirectToRoute('app_login');
        }

        // If it's a GET request, display the registration form
        return $this->render('Signin.html.twig');
    }
}
