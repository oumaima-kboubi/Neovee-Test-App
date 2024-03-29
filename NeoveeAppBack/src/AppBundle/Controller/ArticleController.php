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
     * @Route(path="/editArticle/", methods={"PUT"})
     * @param Request $request
     */
    public function editArticleAction(Request $request)
    {
        echo $request;
        $data = json_decode($request->getContent(), true);
        $title = $data['title'];
        $content = $data['content'];
        $author = $data['author'];
        $id = $data['id'];
        $update = new \DateTime();
        $updateDate = $update->format('d-m-Y H:i:s');
//        $data['updatedDate']=$updateDate;
        $article = new Article();
        $article->setContent($content);
        $article->setId($id);
        $article->setTitle($title);
        $article->setAuthor($author);
        $article->setUpdateDate($updateDate);
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $em->merge($article);
        $em->flush();
        $response = new JsonResponse([
            'title' => $title,
            'content' => $content,
            'author' => $author,
            'updateDate' => $updateDate,
        ]);
        return ($response);
    }

 /**
     * @Route(path="/addLikeArticle/", methods={"PUT"})
     * @param Request $request
     */
    public function addLikeArticleAction(Request $request)
    {
        echo $request;
        $data = json_decode($request->getContent(), true);
//        $title = $data['title'];
//        $content = $data['content'];
//        $author = $data['author'];
//        $id = $data['id'];
//        $update = new \DateTime();
//        $updateDate = $update->format('d-m-Y H:i:s');
////        $data['updatedDate']=$updateDate;
//        $article = new Article();
//        $article->setContent($content);
//        $article->setId($id);
//        $article->setTitle($title);
//        $article->setAuthor($author);
//        $article->setUpdateDate($updateDate);
//        $article->setLikes($);
        $articleId = $request->query->get('id');
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
//        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $query = $em->createQuery(
            'SELECT a
        FROM AppBundle:Article a
        WHERE a.id = :articleId'
        );
//        $query->setParameter('like', $username);
        $article = $query->getArrayResult();

        $em->merge($article);
        $em->flush();
        $response = new JsonResponse([
            'title' => $title,
            'content' => $content,
            'author' => $author,
            'updateDate' => $updateDate,
        ]);
        return ($response);
    }



    /**
     * @Route(path="/deleteArticle/",methods={"DELETE"})
     * @param Request $requeste
     */
    public function deleteArticleAction(Request $request)
    {
        $idArticle = $request->query->get('id');

        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'DELETE 
        FROM AppBundle:Article a
        WHERE a.id = :idArticle'
        );
        $query->setParameter('idArticle', $idArticle);
        $result = $query->getResult();
        $response = new JsonResponse($result);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
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
    {
        $username = $request->query->get('username');

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
     * @Route(path="/getArticle/" , methods={"GET"})
     * @param Request $request
     */
    public function getArticleAction(Request $request)
    {
        $articleId = $request->query->get('id');

        $articleRepository = $this->getDoctrine()->getRepository('AppBundle:Article');
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT a
        FROM AppBundle:Article a
        WHERE a.id = :articleId'
        );
        $query->setParameter('articleId', $articleId);
        $article = $query->getArrayResult();
        $response = new JsonResponse($article);
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
