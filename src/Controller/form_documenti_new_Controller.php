<?php

namespace App\Controller;

use App\Entity\Documenti;
use App\Form\Type\form_documenti_new;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class form_documenti_new_Controller extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    #[Route('/elenco','elenco')]
    function form_controller_documenti (Request $request, EntityManagerInterface $em)
    {
        $headers = ['titolo_documento', 'descrizione', 'data create', 'data update'];
        $items = $em->createQueryBuilder()
            ->select('tutti')
            ->from(Documenti::class, 'tutti')
            ->getQuery()
            ->getResult()
        ;
        $form = $this->createForm(form_documenti_new::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $document = new Documenti();

            $document->setTitolo($data["titolo"]);
            $document->setDescrizione($data["descrizione"]);

            $em->persist($document);
            $em->flush();

            return $this->redirectToRoute('elenco');
        }
        return $this->render('pagina_elenco.html.twig', [
            'variabile_pagina_elenco' => $form->createView(),
            'headers' => $headers,
            'items' => $items
        ]);
    }
}