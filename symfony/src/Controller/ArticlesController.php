<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/articles")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="articles_index", methods={"GET"})
     * @param ArticlesRepository $articlesRepository
     * @return Response
     */
    public function index(ArticlesRepository $articlesRepository): Response
    {
        return $this->render(
            'articles/index.html.twig',
            [
                'articles' => $articlesRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="articles_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render(
            'articles/new.html.twig',
            [
                'article' => $article,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="articles_show", methods={"GET"})
     * @param Articles $article
     * @return Response
     */
    public function show(Articles $article): Response
    {
        return $this->render(
            'articles/show.html.twig',
            [
                'article' => $article,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="articles_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Articles $article
     * @return Response
     */
    public function edit(Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('articles_index');
        }

        return $this->render(
            'articles/edit.html.twig',
            [
                'article' => $article,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="articles_delete", methods={"DELETE"})
     * @param Request $request
     * @param Articles $article
     * @return Response
     */
    public function delete(Request $request, Articles $article): Response
    {
        if ($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('articles_index');
    }
}
