<?php

namespace App\Controller;

use App\Entity\Quack;
use App\Repository\QuackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
    public function listQuack(QuackRepository $quack)
    {

        return $this->render('quack/listQuack.html.twig', [
            'quacks' => $quack->findAll(),
            'controller_name' => 'QuackController',

        ]);

    }

    /**
     * @Route("/quack/create", name="create")
     */
    public function createQuack(Request $request, EntityManagerInterface $manager)
    {
        $quack = new Quack();
        $form = $this->createFormBuilder($quack)
            ->add('content', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route("/quack/modif", name="modif")
     */
    public function modificateQuack()
    {
        return $this->render('quack/modifQuack.html.twig', [
            'controller_name' => 'QuackController',
        ]);
    }

    /**
     * @Route("/quack/delete", name="delete")
     */
    public function deleteQuack()
    {
        return $this->render('quack/deleteQuack.html.twig', [
            'controller_name' => 'QuackController',
        ]);
    }
}
