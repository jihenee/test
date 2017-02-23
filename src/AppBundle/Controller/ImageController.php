<?php


namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Image;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Form\ImageType;


/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Route("/user")
 */
class ImageController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/edit/photo",
     * name="user_edit_photo")
     *
     * @Security("has_role('ROLE_USER')")
     */
    public function addImageAction(Request $request)
    {
        $image = new Image();
        $user = $this->getUser();

        $form = $this->createForm(ImageType::class, $image);

        if ($form->handleRequest($request)->isValid()) {
            if (null === $image->getFile()) {
                return;
            }
            $name = $image->getFile()->getClientOriginalName();
            if ($user->getImage() !== null) {
                $old_file = $user->getImage()->getUrl();
                $image->removeImg($old_file);
            }
            $image->setAlt($name);
            $image->setTitle($user->getUsername());

            $user->setImage($image);

            $um = $this->get('fos_user.user_manager');
            $um->updateUser($user);

            $em = $this->getDoctrine()->getManager();

            $em->persist($image);
            $this->getDoctrine()->getManager()->flush();
            $this->get('session')->getFlashBag()->add('info', 'Photo de profil modifiée');
            return $this->redirect($this->generateUrl('user_edit_profil'));
        }

        return $this->render('user/editPhoto.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }


}