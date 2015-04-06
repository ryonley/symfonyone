<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{


    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        // all new original comment

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/test")
     */
    public function testAction()
    {
        /*
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        */

        $user = $this->getUser();

        //$roles = $user->getRoles();
        //var_dump($roles);

        if($this->get('security.context')->isGranted('ROLE_USER'))
        {
            echo "User is logged in";
        }




        echo "<br/>";


        echo "<pre>";
        var_dump($user);
        echo "</pre>";

        return new Response('test page');
    }

    /**
     * @Route("/admin")
     */
    public function adminAction()
    {
       /* echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";*/
        /*
        $user_manager = $this->container->get('fos_user.user_manager');
        $user = $user_manager->getUser();
        $roles = $user->getRoles();*/

        $user = $this->getUser();
        $roles = $user->getRoles();
        var_dump($roles);
        return new Response('Admin page!');
    }

    /**
     * @Route("/app/createproduct")
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem Ipsum');

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }

    /**

     *
     * @Route("/app/showproduct/{id}")
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        if(!$product)
        {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        return new Response('Retrieved product name '.$product->getName());
    }

    /**
     * @Route("/app/showall")
     */
    public function showallAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')
            ->findAllOrderedByName();

        var_dump($products);
        exit;
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @Route("/app/updateproduct/{id}")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        if(!$product)
        {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setName('New product name');
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));
    }
}
