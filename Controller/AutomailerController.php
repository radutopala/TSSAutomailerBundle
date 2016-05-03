<?php

namespace TSS\AutomailerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use TSS\AutomailerBundle\Entity\Automailer;
use TSS\AutomailerBundle\Form\AutomailerType;

/**
 * Automailer controller.
 *
 * @Route("/automailer")
 */
class AutomailerController extends Controller
{
    private function getRepository()
    {
        return $this
            ->getDoctrine()
            ->getRepository(
                $this->container->getParameter('tss_automailer.class')
            )
        ;
    }

    /**
     * Lists all Automailer entities.
     *
     * @Route("/", name="automailer")
     * @Template()
     */
    public function indexAction()
    {
        $entities = $this->getRepository()->findAll();

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
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Automailer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
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
        $class = $this->container->getParameter('tss_automailer.class');
        $entity = new $class();
        $form = $this->createForm(\TSS\AutomailerBundle\Form\AutomailerType::class, $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Automailer entity.
     *
     * @Route("/create", name="automailer_create")
     * @Method("post")
     * @Template("TSSAutomailerBundle:Automailer:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $class = $this->container->getParameter('tss_automailer.class');
        $entity = new $class();
        $form = $this->createForm(\TSS\AutomailerBundle\Form\AutomailerType::class, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message = new \Swift_Message();
            $message->setFrom($entity->getFromEmail(), $entity->getFromName());
            $message->setTo($entity->getToEmail());
            $message->setBody($entity->getBody());
            $entity->setSwiftMessage($message);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('automailer_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
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
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Automailer entity.');
        }

        $editForm = $this->createForm(AutomailerType::class, $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
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
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Automailer entity.');
        }

        $editForm = $this->createForm(AutomailerType::class, $entity);
        $deleteForm = $this->createDeleteForm($id);

        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $message = new \Swift_Message();
            $message->setFrom($entity->getFromEmail(), $entity->getFromName());
            $message->setTo($entity->getToEmail());
            $message->setBody($entity->getBody());
            $entity->setSwiftMessage($message);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('automailer_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Automailer entity.
     *
     * @Route("/{id}/delete", name="automailer_delete")
     * @Method("post")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getRepository()->find($id);

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
            ->add('id', HiddenType::class)
            ->getForm()
        ;
    }
}
