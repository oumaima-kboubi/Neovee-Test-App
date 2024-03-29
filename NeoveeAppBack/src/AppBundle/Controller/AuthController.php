<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
//header('Access-Control-Allow-Origin: *');
class AuthController extends Controller
{
    /**
     *
     * @Route(path="/api/login",methods={"POST"})
     *@param Request $request
     */
    public function loginAction(Request $request, JWTTokenManagerInterface $JWTManager): JsonResponse
    {
        $data=json_decode($request->getContent(),true);
        $username=$data['username'];
        $password=$data['password'];
        $userRepository=$this->getDoctrine()->getRepository('AppBundle:User');
        $user = $userRepository->findOneBy(array('username'=>$username));
        //we can simply use $user->getPassword() instead of $userRepository->getUserPassword()
        $test= password_verify($password,$userRepository->getUserPassword($username));
        //TODO generate the JWT and send it in the response
        $userAuth = new User();

//        $userAuth->setEmail($user->getEmail());
//        $userAuth->setPassword($password);
//        $userAuth->setUsername($password);
//        $userAuth->setId($user->getId());
//        $userAuth->setEmail($userRepository->getUserEmail($username));
//        $jwt=$JWTManager->createFromPayload($userAuth,[
//            'username'=>$username,
//            'id'=>$user->getId(),
//            'password'=>$password,
//            'email'=> $userRepository->getUserEmail($username)
//            ]);
        if ($test = true){
            $response= new JsonResponse([
                'username'=>$username,
                'id'=>$user->getId(),
               // 'token'=>$JWTManager->create($userAuth)
           ]);
           // echo 'je suis reponse identified: '.$response;
            return($response);
        }else{
            $response = new JsonResponse(['error'=>'problem de verify mdp']);
           // echo 'je suis reponse not identified : '.$response;
            return($response);
        }

    }

    /**
     * @Route(path="/register/", methods={"POST"})
     * @param Request $request
     */
    public function registerAction(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $data=json_decode($request->getContent(),true);
        $username=$data['username'];
        $password=$data['password'];
        $email=$data['email'];

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $encoder->encodePassword($user,$password);
//        $user->setPassword(password_hash($password,PASSWORD_BCRYPT));
        $user->setPassword($encoder->encodePassword($user,$password));
//        $user->setPassword($password);

        $doctrine = $this->getDoctrine();
        $em=$doctrine->getManager();
        $em->persist($user);
        $em->flush();
        $response= new JsonResponse([
            'email'=>$email,
            'username'=>$username
        ]);
//        $response->headers->set('Access-Control-Allow-Methods','POST');
//        $response->headers->set('Access-Control-Allow-Credentials', 'true');
 //       $response->headers->set('Content-Type', 'application/json');
  //      $response->headers->set('Access-Control-Allow-Origin', '*');
        return($response);
        //return true;
    }

    /**
     * @Route("/profile")
     */
    public function profileAction()
    {
       return new JsonResponse([
            'testjwt'=>'testttt'
        ]);
    }

}
