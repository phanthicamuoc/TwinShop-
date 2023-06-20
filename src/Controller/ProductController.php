<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    #[Route('/product/add', name: 'app_product_add')]
public function addProductAction(Request $request, ProductRepository $productRepository):Response
    {
      $Product = new Product();
      $form = $this->createForm(addProductType::class,$Product);
      $form->handleRequest($request);
      if ($form->isSubmitted()&& $form->isValid()){
          $Product=$form->getData();
          $productRepository->save($Product,true);
          return $this->redirectToRoute('app_product_add');
      }
      return $this->render('product/add.html/twig',[
          'form'=>$form
      ]);
    }
    #[Route('/product/all/asc', name: 'app_product_asc')]
public function getAllProduct(ProductRepository $productRepository):Response
{
    $products= $productRepository->findAll();
    return $this->render('product/all.html.twig',[
     'products'=>$products
    ]);
}
#[Route('product/delete/{id}', name: 'app_product_delete')]
public function deleteAction(Product $product, ProductRepository $productRepository):Response
{
    $productRepository->remove($product,true);
    return $this->redirectToRoute('app_product_all');
}
    #[Route('/product/{name}', name: 'app_product_by_name')]
    public function getLipstickByName(ProductRepository $productRepository, string $name): Response
    {
        $products = $productRepository->getProductByName($name);
        return $this->render('product/all.html.twig', [
            'products' => $products
        ]);
    }
    #[Route('/product/update/{id}',name: 'app_product_update')]
    public function updateAction(Request $request, ProductRepository $productRepository, Product $product):Response
    {
        $form=$this->createForm(AddProdcutype::class,$product);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $product =$form->getData();
            $productRepository->save($product,true);
        $this->addFlash('success','Customer information has been successfully updated');
        return $this->redirectToRoute('app_product_all');
        }
        return $this->render('product/edit.html.twig', [
            'form' => $form->createView()
            ]);
    }
    #[Route('/product/detail/{id}', name:'app_product_detail')]
    public function productDetails(Product $product): Response
    {
        return $this->render('product/detail.html.twig', [
            'product' => $product
        ]);
    }
}