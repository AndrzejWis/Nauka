<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Aukcje;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class AukcjaController extends Controller
{
    /**
     * @Route("/start", name="Aukcja_list")
     */
    public function listAction(){
        $aukcja = $this->getDoctrine()
                ->getRepository('AppBundle:Aukcje')
                ->findAll();
    
        return $this->render('aukcja/index.html.twig', array(
    
         'aukcja' => $aukcja
        ));
    }
    /**
     * @Route("/start/create", name="Create")
     */
    public function createAction(Request $request){
        $aukcja = new Aukcje;
        $form = $this->createFormBuilder($aukcja)
            ->add('tytul', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom::15px')))
            ->add('opis', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom::15px')))
            ->add('cena', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom::15px')))
            ->add('koniec', DateTimeType::class, array('attr' => array('class' => 'formcontrol', 'style' => 'margin-bottom::15px')))
            ->add('zdjecie', FileType::class, array('label' => 'Zdjęcie (jpeg File)'))
            ->add('Dodaj', SubmitType::class, array('label' => 'Stwórz aukcje', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom::15px')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tytul = $form['tytul']->getData();
            $opis = $form['opis']->getData();
            $cena = $form['cena']->getData();
            $koniec = $form['koniec']->getData();
            $zdjecie = $form['zdjecie']->getData();
            
            $file = $aukcja->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
             $file->move(
                $this->getParameter('photo_directory'),
                $fileName
            );
            $now = new\DateTime('teraz');
            
                       
            $aukcja->setTytul($tytul);
            $aukcja->setOpis($opis);
            $aukcja->setCena($cena);
            $aukcja->setKoniec($koniec);
            $aukcja->setZdjecie($zdjecie);
            $aukcja->setCreateData($now);
            $product->setPhoto($fileName);
           
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($aukcja);
            $em->flush();
            
            $this->addFlash(
                'dodano aukcje'
            );
            return $this->redirectToRoute('Aukcja_list');
            
        }
        return $this->render('aukcja/create.html.twig', array(
            'form' => $form->createView()
        ));
    }/**
     * @Route("/start/edit/{id}", name="Edit")
     */
    public function editAction($id, Request $request){
         $aukcja = $this->getDoctrine()
                ->getRepository('AppBundle:Aukcje')
                ->find($id);
            
            $now = new\DateTime('now');
            
            $aukcja->setTytul($aukcja->getTytul());
            $aukcja->setOpis($aukcja->getOpis());
            $aukcja->setCena($aukcja->getCena());
            $aukcja->setKoniec($aukcja->getKoniec());
            $aukcja->setZdjecie($aukcja->getZdjecie());
            $aukcja->setCreateData($aukcja->now());
            $product->setPhoto($aukcja->getPhoto());
            
        $form = $this->createFormBuilder($aukcja)
            ->add('tytul', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom::15px')))
            ->add('opis', TextareaType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom::15px')))
            ->add('cena', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom::15px')))
            ->add('koniec', DateTimeType::class, array('attr' => array('class' => 'formcontrol', 'style' => 'margin-bottom::15px')))
            ->add('zdjecie', FileType::class, array('label' => 'Zdjęcie (jpeg File)'))
            ->add('Dodaj', SubmitType::class, array('label' => 'Edytuj aukcje', 'attr' => array('class' => 'btn btn-primary', 'style' => 'margin-bottom::15px')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tytul = $form['tytul']->getData();
            $opis = $form['opis']->getData();
            $cena = $form['cena']->getData();
            $koniec = $form['koniec']->getData();
            $zdjecie = $form['zdjecie']->getData();
            
            $file = $create->getPhoto();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
             $file->move(
                $this->getParameter('photo_directory'),
                $fileName
            );
            $now = new\DateTime('now');
            
            $em = $this->getDoctrine()->getManager();
            
            $aukcja = $em -> getRepository('AppBundle:Aukcje')->find($id);         
                       
            $aukcja->setTytul($tytul);
            $aukcja->setOpis($opis);
            $aukcja->setCena($cena);
            $aukcja->setKoniec($koniec);
            $aukcja->setZdjecie($zdjecie);
            $aukcja->setCreateData($now);
            $product->setPhoto($fileName);
           
            $em = $this->getDoctrine()->getManager();
            
            
            $em->flush();
            
            $this->addFlash(
                'Aukcja zedytowana'
            );
            return $this->redirectToRoute('Table');
            
        }
    
        return $this->render('aukcja/edit.html.twig', array(
         'aukcja' => $aukcja
         
         ));
    }/**
     * @Route("/start/delete/{id}", name="Delete")
     */
    public function deleteAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $aukcja = $em -> getRepository('AppBundle:Aukcje')->find($id); 
        $em->remove($aukcja);
        $em->flush();
        
        $this->addFlash (
            'Aukcja usunięta'
        );
        return $this->redirectToRoute('Aukcja_list');
        
     }
}
  