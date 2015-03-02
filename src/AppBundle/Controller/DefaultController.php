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
        // just a test again and again
        return $this->render('default/index.html.twig');
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
