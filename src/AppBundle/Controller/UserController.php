<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Form\Type\UserType;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * Выводим профиль пользователя
     *
     * @Route("/profile", name="view-profile")
     */
    public function viewAction(Request $request)
    {
        $user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();

        return $this->render('user/view.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * Выводим форму редактирования профиля
     *
     * @Route("/edit-profile", name="edit-profile")
     */
    public function editAction(Request $request)
    {
        $user = $this->get('security.token_storage')
            ->getToken()
            ->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('edit-profile');
        }

        return $this->render('user/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
