<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    /**
     * @Route("/comments", name="comments")
     */
    public function index(): Response
    {
        return $this->render('comments/index.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }

    /**
     * @Route("/quack/list", name="list_quack")
     */
    public function quackComments(Request $request, EntityManagerInterface $manager)
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
            'form' => $form->createView(),

        ]);
    }
}
