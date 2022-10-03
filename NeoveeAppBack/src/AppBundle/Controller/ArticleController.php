<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class ArticleController extends Controller
{
    /**
     * @Route("/getArticle")
     */
    public function getArticleAction()
    {
        return $this->render('AppBundle:Article:get_article.html.twig', array(// ...
        ));
    }

    /**
     * @Route(path="/addArticle/", methods={"POST"})
     * @param Request $request
     */
    public function addArticleAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $content = $data['content'];
        $author = $data['author'];
        $update = new \DateTime();
        $updateDate = $update->format('d-m-Y H:i:s');
//        $updateDate=getdate($update2);
//        $updateDate=date('d/m/Y H:i:s',$update2);
        $article = new Article();
        $article->setContent($content);
        $article->setTitle($title);
        $article->setAuthor($author);
        $article->setUpdateDate($updateDate);
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $em->persist($article);
        $em->flush();
        $response = new JsonResponse([
            'title' => $title,
            'content' => $content,
            'author' => $author,
            'updateDate' => $updateDate,
        ]);
//        echo($response);
        return ($response);
    }

    /**
     * @Route("/editArticle")
     */
    public function editArticleAction()
    {
        return $this->render('AppBundle:Article:edit_article.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/deleteArticle")
     */
    public function deleteArticleAction()
    {
        return $this->render('AppBundle:Article:delete_article.html.twig', array(// ...
        ));
    }

    /**
     * @Route(path="/getAllArticles/" , methods={"GET"})
     * @param Request $request
     */
    public function getAllArticlesAction(Request $request)
    {
        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            'SELECT a
        FROM AppBundle:Article a'
        );
        $articles = $query->getArrayResult();
//        $articlesArray=json_decode($articles,true);
        $articlesResult = [];

//        foreach ($articles as $key => $value){
//            $id=$value['author'];
//            $user = $userRepository->findOneBy(array('id'=>$id));
//            //we can simply use $user->getPassword() instead of $userRepository->getUserPassword()
//            $username= $user->getUsername();
//            echo $username;
//            $value['author']=$username;
//        }
        $response = new JsonResponse($articles);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route(path="/getMyArticles/" , methods={"GET"})
     * @param Request $request
     */
    public function getMyArticlesAction(Request $request)
    {    $username= $request->query->get('username');

        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT a
        FROM AppBundle:Article a
        WHERE a.author = :name'
        );
        $query->setParameter('name', $username);
        $articles = $query->getArrayResult();
        $response = new JsonResponse($articles);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route(path="/getAuthor/:id" , methods={"GET"})
     * @param Request $request
     */
    public function getAuthorAction(Request $request)
    {
        $authorId = $request->params->get('id');
        $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepository->findOneBy(array('id' => $authorId));
        $authorname = $user->getUsername();
        $response = new JsonResponse($authorname);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

}
