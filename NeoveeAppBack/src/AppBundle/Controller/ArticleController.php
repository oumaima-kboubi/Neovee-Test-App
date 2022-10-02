<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use AppBundle\Entity\Article;
class ArticleController extends Controller
{
    /**
     * @Route("/getArticle")
     */
    public function getArticleAction()
    {
        return $this->render('AppBundle:Article:get_article.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route(path="/addArticle/", methods={"POST"})
     * @param Request $request
     */
    public function addArticleAction(Request $request)
    {
        $data=json_decode($request->getContent(),true);
        $title=$data['title'];
        $content=$data['content'];
        $author=$data['author'];
        $article= new Article();
        $article->setContent($content);
        $article->setTitle($title);
        $article->setAuthor($author);
        $doctrine = $this->getDoctrine();
        $em=$doctrine->getManager();
        $em->persist($article);
        $em->flush();
        $response= new JsonResponse([
            'title'=>$title,
            'content'=>$content,
            'author'=>$author
        ]);
        echo($response);
        return($response);
    }

    /**
     * @Route("/editArticle")
     */
    public function editArticleAction()
    {
        return $this->render('AppBundle:Article:edit_article.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deleteArticle")
     */
    public function deleteArticleAction()
    {
        return $this->render('AppBundle:Article:delete_article.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/getAllArticle")
     */
    public function getAllArticleAction()
    {
        return $this->render('AppBundle:Article:get_all_article.html.twig', array(
            // ...
        ));
    }

}
