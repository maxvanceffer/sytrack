<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Issue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Issue controller.
 *
 * @Route("/admin/issue")
 */
class IssueController extends Controller
{
    /**
     * Lists all issue entities.
     *
     * @Route("/", name="issue_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getManager();

        $issues = $em->getRepository('AppBundle:Issue')->findAll();

        return $this->render('AppBundle:issue:index.html.twig', array(
            'issues' => $issues,
        ));
    }

    /**
     * Creates a new issue entity.
     *
     * @Route("/new", name="issue_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $issue = new Issue();
        $form = $this->createForm('AppBundle\Form\IssueType', $issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getManager();
            $em->persist($issue);
            $em->flush($issue);

            return $this->redirectToRoute('issue_show', array('id' => $issue->getId()));
        }

        return $this->render('issue/new.html.twig', array(
            'issue' => $issue,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a issue entity.
     *
     * @Route("/{id}", name="issue_show")
     * @Method("GET")
     */
    public function showAction(Issue $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);

        return $this->render('issue/show.html.twig', array(
            'issue' => $issue,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing issue entity.
     *
     * @Route("/{id}/edit", name="issue_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Issue   $issue
     *
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Issue $issue)
    {
        $deleteForm = $this->createDeleteForm($issue);
        $editForm = $this->createForm('AppBundle\Form\IssueType', $issue);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getManager()->flush();

            return $this->redirectToRoute('issue_edit', array('id' => $issue->getId()));
        }

        return $this->render('issue/edit.html.twig', array(
            'issue' => $issue,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a issue entity.
     *
     * @Route("/{id}", name="issue_delete")
     * @Method("DELETE")
     * @param Request $request
     * @param Issue   $issue
     *
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Issue $issue)
    {
        $form = $this->createDeleteForm($issue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getManager();
            $em->remove($issue);
            $em->flush($issue);
        }

        return $this->redirectToRoute('issue_index');
    }

    /**
     * Creates a form to delete a issue entity.
     *
     * @param Issue $issue The issue entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Issue $issue)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('issue_delete', array('id' => $issue->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @return ObjectManager
     */
    private function getManager()
    {
        try {
            return $this->getManager();
        }
        catch(\Exception $e) {
            $this->get('logger')->error('Error ' . $e->getMessage() . ' ' . $e->getFile());
            return NULL;
        }
    }
}
