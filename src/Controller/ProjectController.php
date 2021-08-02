<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProjectController
 * @Route("/project", name="app_project_")
 */
class ProjectController extends AbstractController
{

    /**
     * @Route("/", name="list")
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('project/list.html.twig', [
            "projects" => $projects,
        ]);
    }

    /**
     * @Route("/{name}", name="view")
     */
    public function view(Project $project): Response
    {
        return $this->render('project/view.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/new", name="new", priority="2")
     */
    public function new(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($project);
            $manager->flush();

            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.project.new.title',
                'message' => 'notification.project.new.message',
            ]);
            return $this->redirectToRoute('app_project_list');
        }

        return $this->render('project/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{name}", name="edit")
     */
    public function edit(Request $request, Project $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.project.edit.title',
                'message' => 'notification.project.edit.message',
            ]);
            return $this->redirectToRoute('app_project_list');
        }

        return $this->render('project/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }

    /**
     * @Route("/delete/{name}", name="delete")
     */
    public function delete(Request $request, Project $project): Response
    {
        $token = $request->request->get('delete-action');

        if ($this->isCsrfTokenValid('delete-action', $token)) {
            $manager = $this->getDoctrine()->getManager();

            $manager->remove($project);
            $manager->flush();

            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.project.delete.title',
                'message' => 'notification.project.delete.message',
            ]);

            return $this->redirectToRoute('app_project_list');
        }

        return $this->redirectToRoute('app_project_list');
    }
}
