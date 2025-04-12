<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Service\NoteFormatter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/note')]
final class NoteController extends AbstractController
{
    #[Route('/', name: 'note_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $notes = $em->getRepository(Note::class)->findAll();

        return $this->render('note/index.html.twig', [
            'notes' => $notes,
        ]);
    }

    #[Route('/{id}', name: 'note_show', requirements: ['id' => '\d+'])]
    public function show(Note $note, NoteFormatter $noteFormatter): Response
    {
        $formattedNote = $noteFormatter->format($note);

        return $this->render('note/show.html.twig', [
            'note' => $note,
            'formatted' => $formattedNote
        ]);
    }

    #[Route('/new', name: 'note_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $note = new Note();
        $note->setCreatedAt(new \DateTime());

        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('note_index');
        }

        return $this->render('note/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'note_edit')]
    public function edit(Request $request, Note $note, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('note_index');
        }

        return $this->render('note/edit.html.twig', [
            'form' => $form->createView(),
            'note' => $note,
        ]);
    }

    #[Route('/{id}/delete', name: 'note_delete', methods: ['POST'])]
    public function delete(Request $request, Note $note, EntityManagerInterface $em): Response
    {
        $em->remove($note);
        $em->flush();
        return $this->redirectToRoute('note_index');    
    }
}