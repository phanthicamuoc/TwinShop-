<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
use App\Form\AddCustomerType;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }

#[Route('customer/all/asc', name: 'app_customer_asc')]
public function getallCustomerorderbyascending(CustomerRepository $customerRepository): Response
{
    $customer = $customerRepository->customer();
    return $this->render('Customer/index.html.twig',[
        'customer' =>$customer
        ]);
}
#[Route('customer/add', name:'app_customer_add')]
public function addSupplierAction(Request $request, CustomerRepository $customerRepository): Response
{
     $customer = new Customer();
     $form = $this->createForm(AddCustomerType::class,$customer);
     $form->handleRequest($request);
    if($form->isSubmitted()&&$form->isValid()){
       $customer = $form->getData();
       $customerRepository->save($customer,true);
       $this->addFlash('success','adding customer successfully!');
       return $this->redirectToRoute('app_customer_add');
    }
    return $this->render('customer/add.html.twig',[
        'form'=>$form
    ]);
}
#[Route('/customer/update/{id}', name: 'app_customer_update')]
public function updateAction(Request $request ,CustomerRepository $customerRepository,Customer $customer): Response
{
    $form = $this->createForm(AddCustomerType::class,$customer);
    $form->handleRequest($request);

    if($form->isSubmitted()&&$form->isValid()){
        $customer = $form->getData();
        $customerRepository->save($customer,true);
        $this->addFlash('success','updated customer successfully!');
        return $this->redirectToRoute('app_customer_add');
    }
    return  $this->render('customer/update.html.twig',[
        'form'=>$form->createView()
    ]);

}
#[Route('customer/delete/{id}',name: 'app_customer_delete')]
public function deleteAction(Customer $customer, CustomerRepository $customerRepository):Response
{
    $customerRepository->remove($customer,true);
    return $this->redirectToRoute('app_customer_all');

}
#[Route('customer/details/{id}',name: 'app_customer_details')]
public function customerDetails(Customer $customer):Response
{
    return $this->render('customer/details.html.twig',[
        'customer'=>$customer]);
}
   }

