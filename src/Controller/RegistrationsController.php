<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class RegistrationsController extends AbstractController


{
    /**
     * @Route("/register", name="user_registration")
     */
    public function register(Request $request,ObjectManager $manager,UserPasswordEncoderInterface $encoder)
    {
        $User = new User();
        $form = $this->createForm(UserType::class, $User);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash =$encoder->encodePassword($User, $User->getPassword());
            $User->setPassword($hash);
            $manager ->persist($User);
            $manager->flush();

            return $this->redirectToRoute('user_registration');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );


     }
}




