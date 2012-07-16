<?php

namespace TSS\AutomailerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use TSS\AutomailerBundle\Entity\Automailer;
use TSS\AutomailerBundle\Form\AutomailerType;

/**
 * Automailer controller.
 *
 * @Route("/automailer")
 */
class AutomailerController extends Controller
{
    /**
     * Lists all Automailer entities.
     *
     * @Route("/", name="automailer")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TSSAutomailerBundle:Automailer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Automailer entity.
     *
     * @Route("/{id}/show", name="automailer_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TSSAutomailerBundle:Automailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Automailer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Automailer entity.
     *
     * @Route("/new", name="automailer_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Automailer();
        $form   = $this->createForm(new AutomailerType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Automailer entity.
     *
     * @Route("/create", name="automailer_create")
     * @Method("post")
     * @Template("TSSAutomailerBundle:Automailer:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Automailer();
        $request = $this->getRequest();
        $form    = $this->createForm(new AutomailerType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('automailer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Automailer entity.
     *
     * @Route("/{id}/edit", name="automailer_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TSSAutomailerBundle:Automailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Automailer entity.');
        }

        $editForm = $this->createForm(new AutomailerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Automailer entity.
     *
     * @Route("/{id}/update", name="automailer_update")
     * @Method("post")
     * @Template("TSSAutomailerBundle:Automailer:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TSSAutomailerBundle:Automailer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Automailer entity.');
        }

        $editForm   = $this->createForm(new AutomailerType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('automailer_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Automailer entity.
     *
     * @Route("/{id}/delete", name="automailer_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TSSAutomailerBundle:Automailer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Automailer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('automailer'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
