<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Supplier;
use App\Repository\ProductRepository;
use App\Repository\SupplierRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{
    #[Route('/supplier', name: 'app_supplier')]
    public function index(): Response
    {
        return $this->render('supplier/index.html.twig', [
            'controller_name' => 'SupplierController',
        ]);
    }
   #[Route('Supplier/all/asc', name: 'all_supplier_asc')]
   public function getAllCustomer(SupplierRepository $supplierRepository): Response
   {
       $suppliers = $supplierRepository->findAll();
       return $this->render('supplier/all.html.twig', [
           'suppliers' => $suppliers
       ]);
   }
   #[Route('Supplier/{name}', name: 'app_supplier_by_name')]
   public function getlipstickByname(SupplierRepository $supplierRepository, string $name): Response
   {
       $suppliers = $supplierRepository->getSupplierByName($name);
       return $this->render('supplier/all.html.twig', [
           'suppliers' => $suppliers
       ]);
   }
   #[Route('/Supplier/delete/{id}', name:'app_Supplier_delete')]
   public function deleteFuntion(SupplierRepository $supplierRepository, Supplier $supplier):Response
   {
       $supplierRepository->remove($supplier,true);
       return $this->redirectToRoute('app_supplier_all');
   }
    #[Route('/supplier/update/{id}', name: 'app_supplier_update')]
    public function updateFunAction(SupplierRepository $supplierRepository, Supplier $supplier, Request $request): Response
    {
        $form = $this->createForm(AddSupplieType::class, $supplier);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $supplier = $form->getData();
            $supplierRepository->save($supplier,true);
          $this->addFlash('success','upplier information have been edit');
          return $this->render('App_Supplier_Update');
        }
        return $this->render('supplier/update.html.twig', [
            'form' =>$form
        ]);
    }
    #[Route('suppkier/detail/{id}', name: 'app_Supplier_detail')]
    public function supplierDetail(Supplier $supplier): Response
    {
        return $this->render('supplier/details.html.twig', [
            'supplier' => $supplier
        ]);
    }
}
