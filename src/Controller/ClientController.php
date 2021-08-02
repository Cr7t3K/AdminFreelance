<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client", name="app_client_")
 * @IsGranted("ROLE_USER")
 */
class ClientController extends AbstractController
{

    /**
     * @Route("/", name="list")
     */
    public function list(ClientRepository $clientRepository): Response
    {
        $clients = $clientRepository->findAll();

        return $this->render('client/list.html.twig', [
            'clients' => $clients
        ]);
    }

    /**
     * @Route("/{name}", name="view")
     */
    public function view(Client $client): Response
    {
        return $this->render('client/view.html.twig', [
           'client' => $client,
        ]);
    }

    /**
     * @Route("/new", name="new", priority="2")
     */
    public function new(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($client);
            $manager->flush();

             $this->addFlash('toast', [
                 'style' => 'success',
                 'title' => 'notification.client.new.title',
                 'message' => 'notification.client.new.message',
             ]);
             return $this->redirectToRoute('app_client_list');
        }

        return $this->render('client/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{name}", name="edit")
     */
    public function edit(Request $request, Client $client): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.client.edit.title',
                'message' => 'notification.client.edit.message',
            ]);
            return $this->redirectToRoute('app_client_list');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
            'client' => $client,
        ]);
    }

    /**
     * @Route("/delete/{name}", name="delete")
     */
    public function delete(Request $request, Client $client): Response
    {
        $token = $request->request->get('delete-action');

        if ($this->isCsrfTokenValid('delete-action', $token)) {
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($client);
            $manager->flush();

            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.client.delete.title',
                'message' => 'notification.client.delete.message',
            ]);
            return $this->redirectToRoute('app_client_list');
        }

        return $this->redirectToRoute('app_client_list');
    }
}
