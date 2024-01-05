<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private CommentRepository $commentRepository;

    public function __construct(EntityManagerInterface $entityManager, CommentRepository $commentRepository)
    {
        $this->entityManager = $entityManager;
        $this->commentRepository = $commentRepository;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $comments = $this->commentRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'comments' => $comments,
        ]);
    }

    #[Route('/admin/approve-comment/{id}', name: 'admin_approve_comment')]
    public function approveComment(Comment $comment): Response
    {
        $comment->setStatus('approved');
        $this->entityManager->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/admin/reject-comment/{id}', name: 'admin_reject_comment')]
    public function rejectComment(Comment $comment): Response
    {
        $comment->setStatus('rejected');
        $this->entityManager->flush();

        return $this->redirectToRoute('app_admin');
    }

    #[Route('/admin/delete-comment/{id}', name: 'admin_delete_comment')]
    public function deleteComment(Comment $comment): Response
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_admin');
    }
}