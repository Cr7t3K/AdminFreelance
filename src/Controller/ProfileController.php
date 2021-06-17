<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfileController
 * @Route(name="app_")
 */
class ProfileController extends AbstractController
{

    /**
     * @Route("/profile", name="profile")
     * @IsGranted("ROLE_USER")
     */
    public function profile(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $company = new Company();
        if (null !== $user->getCompany()) {
            $company = $user->getCompany();
        }

        $companyForm = $this->createForm(CompanyType::class, $company);
        $profileForm = $this->createForm(UserType::class, $user);
        $profileForm->handleRequest($request);
        $companyForm->handleRequest($request);

        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.profile.update.title',
                'message' => 'notification.profile.update.message',
            ]);
            return $this->redirectToRoute('app_profile');
        }

        if ($companyForm->isSubmitted() && $companyForm->isValid()) {
            if (null === $company->getUser()) {
                $company->setUser($user);
            }
            $this->addFlash('toast', [
                'style' => 'success',
                'title' => 'notification.company.update.title',
                'message' => 'notification.company.update.message',
            ]);
            $this->getDoctrine()->getManager()->persist($company);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile.html.twig', [
            'profileForm' => $profileForm->createView(),
            'companyForm' => $companyForm->createView(),
        ]);
    }
}
