<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductEdit extends AbstractController
{
    /**
     * @Route("/product/edit/$id", name="product_edit")
     */

    public function Edit(Request $request, $id)
    {
        // just setup a fresh $task object (remove the dummy data)
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($id);

        $form = $this->createFormBuilder($product)
            ->add('title', null, ['attr' => ['style' => 'width: 300px']])
            ->add('status', null, ['attr' => ['style' => 'width: 300px']])
            ->add('value', null, ['attr' => ['style' => 'width: 300px']])
            ->add('user', null, ['attr' => ['style' => 'width: 300px']])
            ->add('exchange', null, ['attr' => ['style' => 'width: 300px']])
            ->add('save', SubmitType::class, ['label' => 'Zapisz zmiany', 'attr' => ['style' => 'width: 350px']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}