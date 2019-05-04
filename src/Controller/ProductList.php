<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductList extends AbstractController
{
    /**
     * @Route("/product/list", name="product_list")
     */

    public function List()
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('product/list.html.twig', [
            'product' => $product
        ]);
    }
}
