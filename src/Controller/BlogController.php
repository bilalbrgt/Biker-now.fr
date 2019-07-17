<?php

namespace App\Controller;

use App\Entity\Contact;

use App\Form\ContactType;
use Swift_Mailer;
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
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function ind(Request $request,  Swift_Mailer  $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();


            $mail = (new \Swift_Message('Contact'))
                ->setFrom($contact->getEmail())
                ->setTo('bouakimbilel93@gmail.com')
                ->setBody($contact->getMessage());

            $mailer->send($mail);
            return $this->redirectToRoute('contact');
        }
        return $this->render('blog/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


