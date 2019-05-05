<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductAdd extends AbstractController
{
    /**
     * @Route("/product/add", name="product_add")
     */

    public function Add(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('title', null, ['attr' => ['style' => 'width: 300px']])
            ->add('status', null, ['attr' => ['style' => 'width: 300px']])
            ->add('value', null, ['attr' => ['style' => 'width: 300px']])
            ->add('imageFile', VichFileType::class)
            ->add('user', null, ['attr' => ['style' => 'width: 300px']])
            ->add('exchange', null, ['attr' => ['style' => 'width: 300px']])
            ->add('save', SubmitType::class, ['label' => 'Dodaj produkt', 'attr' => ['style' => 'width: 350px']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
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