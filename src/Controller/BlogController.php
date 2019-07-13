<?php

namespace App\Controller;

use App\Entity\Contact;

use App\Form\ContactType;
use App\Notification\ContactNotification;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class BlogController extends AbstractController
{
    /**
     * @Route("/Initiations", name="Initiations")
     */
    public function index()
    {
        return $this->render('blog/Initiations.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    /**
     * @Route("/legales", name="legales")
     */
    public function legales()
    {
        return $this->render('blog/legales.html.twig');
    }






    /**
     * Affichage du formulaire de contact
     *
     * @Route("/contact", name="contact")
     *
     * @param Request $request
     * @param ObjectManager $manager
     * @param ContactNotification $notification
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function ind(Request $request, ObjectManager $manager, ContactNotification $notification)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contact);
            $manager->flush();

            $notification->notify($contact);

            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('contact');
        }

        return $this->render('blog/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

