<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Quack;
use App\Form\CommentsType;
use App\Form\QuackType;

use App\Repository\QuackRepository;
use Doctrine\ORM\EntityManagerInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QuackController extends AbstractController
{
    /**
     * @Route("/test", name="quack")
     */

    public function index(): Response
    {
        return $this->render('quack/index.html.twig', [

            'controller_name' => 'QuackController',
        ]);
    }

    /**
     * @Route("/quack/list", name="list_quack")
     * @param Quack $quack
     * @return Response
     */
    public function renderInfo(QuackRepository $quack, Request $request, EntityManagerInterface $manager)
    {
        $comment = new Comments();
        $form = $this->createForm(CommentsType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('list_quack');
        }
        return $this->render('quack/listQuack.html.twig', [
            'quacks' => $quack->findAll(),
            'form' => $form->createView(),


        ]);

    }

    /**
     * @Route("/quack/create", name="create")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function createQuack(Request $request, EntityManagerInterface $manager)
    {

        $quack = new Quack();
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quack->setDucks($this->getUser());
            $quack->setCreatedAt(new \DateTime());
            $manager->persist($quack);
            $manager->flush();

            return $this->redirectToRoute('list_quack');
        }
        dump($quack);


        return $this->render('quack/createQuack.html.twig', [
            'controller_name' => 'QuackController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/quack/modif/{id}", name="edit_Quack")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function modificateQuack(Quack $quack, Request $request, EntityManagerInterface $manager)
    {

        $manager = $this->getDoctrine()->getManager();
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quack->setDucks($this->getUser());
            $quack->setCreatedAt(new \DateTime());
            $manager->flush();
            return $this->redirectToRoute('list_quack');
        }
        return $this->render('quack/modifQuack.html.twig', [
            'controller_name' => 'QuackController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/quack/delete/{id}", name="delete")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function deleteQuack(Quack $quack)
    {

        $entityManager = $this->getDoctrine()->getManager();
        if (!$quack) {
            throw $this->createNotFoundException(
                'No quack found for id ' . $quack
            );
        }
        $entityManager->remove($quack);
        $entityManager->flush();
        return $this->redirectToRoute('list_quack', [
            'id' => $quack->getId(),

        ]);

    }


}
