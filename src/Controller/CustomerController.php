<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Order;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }

#[Route('Customer/all/ascending', name: 'app_Customer_ascending')]
public function getallCustomerorderbyascending(CustomerRepository $customerRepository): Response
{
    $customer = $customerRepository->findAll();
    return $this->render('Customer/$this->index.html.twig',[
        'Customer' =>$customer
        ]);
}


#[Route('/customer/{id}', name: 'app_customer_detail')]
public function CustomerDetail(CustomerRepository $customerRepository,Customer $customer):Response
{
    $Order = $customer->getName()->getValues();
    $total = 0;
    For($i=0; $i<count($Order);$i++){
        $Product = $Order[$i]->get
    }
}
}



