<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;



class InterfaceController extends AbstractController
{
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/bienvenu", name="bienvenu")
     */
    public function bienvenu()
    {
        return $this->render('interface/Bienvenu.html.twig');
    }
    /**
     * @Route("/paiement/{type}", name="paiement")
     */
    public function paiement(Request $request)
    {
        
        // get the passed emplacement parameter
        $type = $request->attributes->get('type');
        $type_emplacement = "Sur place";
        // set and get session attributes
        if ($type == "emporter") {
            $type_emplacement = "A emporter";
        }

        $this->session->set('emplacement', $type_emplacement);
        return $this->render('interface/paiement.html.twig');
    }

     /**
     * @Route("/choisirpaiement/{type}", name="choisirpaiement")
     */
    public function choisir_paiement(Request $request)
    {
        
        // get the passed emplacement parameter
        $type = $request->attributes->get('type');
        $type_paiement = "Carte bancaire";
        // set and get session attributes
        if ($type == "caisse") {
            $type_paiement = "Paiement a la caisee";
        }

        else if ($type == "ticket") {
            $type_paiement = "Ticket restaurant";
        }

        $this->session->set('paiement', $type_paiement);

        $response = $this->redirectToRoute('produit');
    

        return $response;
    }
     /**
     * @Route("/emplacement", name="emplacement")
     */
    public function emplacement(Request $request)
    {
        return $this->render('interface/emplacement.html.twig');
    }
}
