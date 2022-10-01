<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AuthController extends Controller
{
    /**
     *
     * @Route(path="/login",methods={"GET"})
     *@param Request $request
     */
    public function loginAction(Request $request): JsonResponse
    {
        $data=json_decode($request->getContent(),true);
        $username=$data['username'];
        $password=$data['password'];

        $userRepository=$this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepository->findOneBy(array('username'=>$username));
        //we can simply use $user->getPassword() instead of $userRepository->getUserPassword()
        $test= password_verify($password,$userRepository->getUserPassword($username));
        //TODO generate the JWT and send it in the response
        if ($test = true){
            return new JsonResponse([
                'username'=>$username,
                'id'=>$user->getId()
            ]);
        }else{
            return new JsonResponse(['error'=>'problem de verify mdp']);
        }

    }

    /**
     * @Route(path="/register", methods={"POST"})
     * @param Request $request
     */
    public function registerAction(Request $request)
    {
        $data=json_decode($request->getContent(),true);
        $username=$data['username'];
        $password=$data['password'];
        $email=$data['email'];

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword(password_hash($password,PASSWORD_BCRYPT));

        $doctrine = $this->getDoctrine();
        $em=$doctrine->getManager();
        $em->persist($user);
        $em->flush();
        return(new JsonResponse([
            'email'=>$email,
            'username'=>$username
        ]));
    }

    /**
     * @Route("/profile")
     */
    public function profileAction()
    {
        //TODO ......
    }

}
