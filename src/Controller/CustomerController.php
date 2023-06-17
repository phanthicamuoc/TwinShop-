<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
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

#[Route('Customer/all/asc', name: 'app_customer_asc')]
public function getallCustomerorderbyascending(CustomerRepository $customerRepository): Response
{
    $customer = $customerRepository->customer();
    return $this->render('Customer/index.html.twig',[
        'customer' =>$customer
        ]);
}


//#[Route('/customer/add/{id}', name: 'app_customer_addd', priority: 1)]
//public function CustomerDetail(CustomerRepository $customerRepository,Customer $customer):Response
//{
//    $Order = $customer->getName()->getValues();
//    $total = 0;
//    For($i=0; $i<count($Order);$i++){
//        $Product = $Order[$i]->getCustomer()->getProduct()->getValues();
//        for ($j=0; $j<count($Order);$j++) {
//        }
//        }
//            return $this->render('Customer/detail.html.twig',[
//                'Customer'=>$customer,
//                'total'=>$total
//            ]);
//
//        }
#[Route( '/Customer/add',name: 'app_Customer_add',priority: 1)]
public function addAction (Request $request, CustomerRepository $customerRepository,SluggerInterface$slugger) :Response
{
    $form=$this->createForm(CustomerType :: Class, new Customer());
    $form->handleRequest($request);
if ($form->isSubmitted()&& $form-> isvalue());
    $Customer = $form->getdata();
    $customerRepository->save($Customer, true);
    $this->addFlash('success','Adding Customer is successfully');
    return $this->redirectToRoute('app_Customer_add');

}
}











