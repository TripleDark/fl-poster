<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\Type\BidType;
use AppBundle\Entity\Bid;

class BidController extends Controller
{
    /**
     * Выводим список заявок пользователя
     *
     * @Route("/panel", name="index-bid")
     */
    public function indexPanelAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Bid');
        $bids = $repository->findAll();

        return $this->render('bid/panel.html.twig', [
            'bids' => $bids
        ]);
    }


    /**
     * Выводим форму создания заявки
     *
     * @Route("/create-bid", name="create-bid")
     */
    public function createBidAction(Request $request)
    {
        $bid = new Bid();
        $form = $this->createForm(BidType::class, $bid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // По умолчанию задание активируется
            $bid->setStatus('Размещается');

            // Фиксируем кто создал задание
            $creator = $this->get('security.token_storage')
                ->getToken()
                ->getUser();
            $bid->setUser($creator);

            // Фиксируем дату создания и редактирования задания
            // TODO: Эту логику можно вынести в модель
            $bid->setCreatedAt(new \DateTime());
            $bid->setEditedAt(new \DateTime());

            // Записываем новое задание в базу данных
            $em = $this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();

            // Получаем актуальный список всех заданий
            $repository = $this->getDoctrine()->getRepository('AppBundle:Bid');
            $bids = $repository->findAll();

            // Направляем пользователя на страницу со списком заданий
            return $this->redirectToRoute('index-bid');
        }

        return $this->render('bid/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Удаляем заявку пользователя по её id
     *
     * @Route("/delete-bid/{id}", name="delete-bid")
     */
    public function deleteAction($id, Request $request)
    {
        $bid = $this->getDoctrine()
            ->getRepository('AppBundle:Bid')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($bid);
        $em->flush();

        return $this->redirectToRoute('index-bid');
    }

    /**
     * Выводим форму редактирования заявки по её id
     *
     * @Route("/edit-bid/{id}", name="edit-bid")
     */
    public function editAction($id, Request $request)
    {
        $bidRepository = $this->getDoctrine()->getRepository('AppBundle:Bid');
        $bid = $bidRepository->find($id);

        $form = $this->createForm(BidType::class, $bid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Фиксируем дату редактирования задачи
            $bid->setEditedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($bid);
            $em->flush();

            return $this->redirectToRoute('index-bid');
        }

        return $this->render('bid/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }



    /**
     * Выводим форму редактирования заявки по её id
     *
     * @Route("/toggle-bid/{id}", name="toggle-bid")
     */
    public function toggleAction($id, Request $request)
    {
        $bidRepository = $this->getDoctrine()->getRepository('AppBundle:Bid');
        $bid = $bidRepository->find($id);

        $newStatus = $bid->getStatus() === 'Не размещается' ? 'Размещается' : 'Не размещается';
        $bid->setStatus($newStatus);

        $em = $this->getDoctrine()->getManager();
        $em->persist($bid);
        $em->flush();

        return $this->redirectToRoute('index-bid');
    }

}
