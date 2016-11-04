<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\WebsiteConfig;
use AppBundle\Form\ProjectType;
use AppBundle\Form\WebsiteConfigType;
use AppBundle\Entity\Version;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AdminController
 *
 * @package AppBundle\Controller
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/dashboard")
     */
    public function dashboardAction()
    {
        $configure = $this
            ->getManager()
            ->getRepository('AppBundle:WebsiteConfig')
            ->findOneBy(array('current' => 1));

        if(null === $configure)
            $configure = new WebsiteConfig();

        return $this->render('AppBundle:Admin:dashboard.html.twig', compact('configure'));
    }

    /**
     * @Route("/initial/configure/step/one", name="website_setup_step_one")
     */
    public function initialConfigureStepOneAction()
    {
        $manager = $this->getManager();
        /** @var Version $version */
        $version = $manager
            ->getRepository('AppBundle:Version')
            ->findInitialVersion();

        if(!$version->getId()) {
            $manager->persist($version);
            $manager->flush();
        }

        $project = new Project();
        $project->setCurrentVersion($version);
//        $project->addVersion($version);

        $form   = $this->createForm(ProjectType::class, new Project());
        $view   = $form->createView();

        return $this->render('AppBundle:Admin:step_one.html.twig', compact('view'));
    }

    /**
     * @Route("/initial/configure/step/save/one", name="website_setup_step_one_save")
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function saveStepOneAction(Request $request)
    {
        $form = $this->createForm(ProjectType::class, new Project());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getManager();
            $em->persist($form->getData());
            $em->flush();

            $id = $form->getData()->getId();
            return JsonResponse::create(['next_step' => $this->generateUrl('website_setup_step_two',compact('id'))]);
        }
        else {
            $errors = $this->get('app.form.error_serialize')->serializeFormErrors($form);
            return JsonResponse::create($errors, 400);
        }
    }

    /**
     * @Route("/initial/configure/step/two/{id}", name="website_setup_step_two")
     * @param Project $project
     */
    public function initialConfigureStepTwoAction(Project $project)
    {
        $webconfig = new WebsiteConfig();
        $webconfig->setProject($project);
        $webconfig->setCurrent(1);

        $em = $this->getManager();
        $em->persist($webconfig);
        $em->flush();

        return $this->render('AppBundle:Admin:step_two.html.twig');
    }

    public function getManager()
    {
        try {
            return $this->getDoctrine()->getManager();
        }
        catch(\Exception $e) {
            $this->get('logger')->err('Ooops! Can not get Doctrine manager');
        }

        return null;
    }
}
