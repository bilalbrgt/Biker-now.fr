<?php
namespace App\Controller;
use App\Entity\Contatct;
use App\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    }  /**
     * @Route("/legales", name="legales")
     */
    public function legales()
    {
        return $this->render('blog/legales.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * Page pour envoyé un email de contact
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request); // reception de la requete (apres clic sur bouton envoyé)
        if ($form->isSubmitted() && $form->isValid()) { // vérification de si formulaire envoyé
            $this->addFlash('succes', 'votre, message a bien eatais envoyés');
            return $this->redirectToRoute('contact');
            $datas = $form->getData();
            // recuperation des données du formulaire
            $this->sendMail($datas, $mailer); // appel de la methode "sendMail"
        }
        return $this->render('blog/contatct.html.twig', [
            'form' => $form->createView()]);
        dump($datas);
    }

    public function sendMail(Contatct $datas, \Swift_Mailer $mailer)
    {
        $message = new \Swift_Message();
        $message->setSubject($datas->getName()); // Titre de l'email
        $message->setFrom('bouakimjawed@gmail.com'); // adresse du site
        $message->setTo($datas->getEmail('bouakimjawed@gmail.com')); // adresse de la personne qui envoie l'email
        $message->setBody( // corps de l'email
            $this->renderView('blog/tableau.html.twig', [
                'datas' => $datas
            ]),
            'text/html'
        );
        $mailer->send($message);
    }



}