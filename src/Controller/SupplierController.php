<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Repository\SupplierRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{
  #[Route('/supplier/add', name: 'app_supplier_add')]
  public function addSupplierAction(Request $request, SupplierRepository $supplierRepository):Response
  {
      $supplier = new Supplier();
      $form = $this->createForm(AddSupplierType::class, $supplier);
      $form->handleRequest($request);
      if ($form->isSubmitted()&&$form->isValid()){
          $supplier = $form->getData();
          $supplierRepository->save($supplier,true);
          $supplier
      }

  }
}
