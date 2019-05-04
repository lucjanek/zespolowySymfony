<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductDelete extends AbstractController
{
    /**
     * @Route("/product/delete/$id", name="product_delete")
     */

    public function Delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);

        if (!$product) {
            return new Response('Produkt o id '. $id . ' nie istnieje.' );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_list');
        //return new Response('Usunięto produkt o id '. $id);
    }
}
