<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/comments')]
class AdminCommentController extends AbstractController
{
    #[Route('/', name: 'admin_comment_index')]
    public function index(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('admin/comments/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/approve/{id}', name: 'admin_comment_approve')]
    public function approve(int $id, CommentRepository $commentRepository, EntityManagerInterface $entityManager): Response
    {
        $comment = $commentRepository->find($id);
        if ($comment) {
            $comment->setStatus('approved');
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_comment_index');
    }

    #[Route('/reject/{id}', name: 'admin_comment_reject')]
    public function reject(int $id, CommentRepository $commentRepository, EntityManagerInterface $entityManager): Response
    {
        $comment = $commentRepository->find($id);
        if ($comment) {
            $comment->setStatus('rejected');
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_comment_index');
    }
}
