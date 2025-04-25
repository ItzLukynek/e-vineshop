<?php
namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'order_new', methods: ['GET'])]
    public function new(): Response
    {
        $user = $this->getUser(); // Získání přihlášeného uživatele

        $order = new Order();

        if ($user) {
            // Pokud uživatel existuje, předvyplníme údaje
            $order->setFirstName($user->getFirstName());
            $order->setLastName($user->getLastName());
            $order->setEmail($user->getEmail());

            // Pokud máš např. telefonní číslo v User entitě
            if (method_exists($user, 'getPhone')) {
                $order->setPhone($user->getPhone());
            }
        }

        $form = $this->createForm(OrderType::class, $order);

        return $this->render('/component/order/order.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/order', name: 'order_submit', methods: ['POST'])]
    public function submit(Request $request, EntityManagerInterface $em): Response
    {
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($order);
            $em->flush();

            $this->addFlash('success', 'Objednávka byla úspěšně odeslána! Bližší informace Vám přijdou SMS.');

            // Redirect to the success page (can be the same page or another page)
            return $this->redirectToRoute('homepage');

        }

        return $this->render('/component/order/order.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}
