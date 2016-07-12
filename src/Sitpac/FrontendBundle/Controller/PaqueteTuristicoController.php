<?php

namespace Sitpac\FrontendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sitpac\FrontendBundle\Entity\PaqueteTuristico;
use Sitpac\FrontendBundle\Form\PaqueteTuristicoType;

/**
 * PaqueteTuristico controller.
 *
 */
class PaqueteTuristicoController extends Controller
{
    /**
     * Lists all PaqueteTuristico entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('FrontendBundle:PaqueteTuristico')->findAll();

        return $this->render('FrontendBundle:PaqueteTuristico:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a PaqueteTuristico entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontendBundle:PaqueteTuristico:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new PaqueteTuristico entity.
     *
     */
    public function newAction()
    {
        $entity = new PaqueteTuristico();
        $form   = $this->createForm(new PaqueteTuristicoType(), $entity);

        return $this->render('FrontendBundle:PaqueteTuristico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new PaqueteTuristico entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new PaqueteTuristico();
        $form = $this->createForm(new PaqueteTuristicoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paquete_show', array('id' => $entity->getId())));
        }

        return $this->render('FrontendBundle:PaqueteTuristico:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PaqueteTuristico entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
        }

        $editForm = $this->createForm(new PaqueteTuristicoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('FrontendBundle:PaqueteTuristico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing PaqueteTuristico entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PaqueteTuristicoType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('paquete_edit', array('id' => $id)));
        }

        return $this->render('FrontendBundle:PaqueteTuristico:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a PaqueteTuristico entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('FrontendBundle:PaqueteTuristico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PaqueteTuristico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('paquete'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
