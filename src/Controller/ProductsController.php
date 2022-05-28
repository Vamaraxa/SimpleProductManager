<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\Type\ProductForm;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends AbstractController
{
    public function index (ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $products = $repository->findBy(['published' => true]);
        
        return $this->render(
            'products/index.html.twig',
            [
                'products' => $products
            ]
        );
    }

    public function manage(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Product::class);
        $products = $repository->findAll();
        
        return $this->render(
            'products/manage.html.twig',
            [
                'products' => $products
            ]
        );
    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $product = new Product();

        $form = $this->createForm(ProductForm::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('products.edit', ['id' => $product->getId()]);
        }

        return $this->render('products/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function edit(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $id = $request->attributes->get('id');
        $repository = $doctrine->getRepository(Product::class);
        $product = $repository->find($id);
        if (!$product) {
            return $this->redirectToRoute('products.manage');
        }

        $form = $this->createForm(ProductForm::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();
            $entityManager->persist($product);
            $entityManager->flush();
            return $this->redirectToRoute('products.edit', ['id' => $product->getId()]);
        }

        return $this->render('products/form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function delete(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $id = $request->attributes->get('id');
        $repository = $doctrine->getRepository(Product::class);
        $product = $repository->find($id);
        if (!$product) {
            return $this->redirectToRoute('products.manage');
        }
        $entityManager->persist($product);
        $entityManager->remove($product);
        $entityManager->flush();
        return $this->redirectToRoute('products.manage');
    }

    public function publish(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        $id = $request->attributes->get('id');
        $repository = $doctrine->getRepository(Product::class);
        $product = $repository->find($id);
        if (!$product) {
            return $this->redirectToRoute('products.manage');
        }
        $product->setPublished($request->attributes->get('publish') ?? true);
        $entityManager->persist($product);
        $entityManager->flush();
        return $this->redirectToRoute('products.manage');
    }

}