<?php
namespace App\Controller;
use App\Entity\Reserver;
use App\Form\ReserverType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class FormulaireController extends AbstractController
{
    /**
     * @Route("/Albums", name="Albums")
     */
    public function legales()
    {
        return $this->render('blog/Albums.html.twig');
    }
    /**
     * @Route("/reservations", name="reservations")
     */
    public function reserver(Request $request,ObjectManager $manager)
    {
        $Reserver= new Reserver();
        $form = $this->createForm(ReserverType::class,$Reserver);
        $form->handleRequest($request); // reception de la requete (apres clic sur bouton envoyé)
        if ($form->isSubmitted()&& $form ->isValid()) {
            $manager ->persist($Reserver);
            $manager->flush();
            $this->addFlash('success','votre reservations a bien etais pris en compte');
            return $this->redirectToRoute('reservations');
        }
        return $this->render('blog/reservations.html.twig',[
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/confi", name="confi")
     */
    public function confidenatialit()
    {
        return $this->render('blog/confi.html.twig');
    }
}


