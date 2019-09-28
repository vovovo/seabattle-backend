<?php
/**
 * Created by PhpStorm.
 * User: vovovo
 * Date: 28.09.19
 * Time: 21:00
 */

namespace App\Services;


final class ArticleService
{

    /**
     * @var ArticleRepositoryInterface
     */
    private $articleRepository;


    public function __construct(ArticleRepositoryInterface $articleRepository){
        $this->articleRepository = $articleRepository;
    }

    public function getArticle(int $articleId): ?Article
    {
        return $this->articleRepository->findById($articleId);
    }

    public function getAllArticles(): ?array
    {
        return $this->articleRepository->findAll();
    }

    public function addArticle(string $title, string $content): Article
    {
        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);
        $this->articleRepository->save($article);

        return $article;
    }

    public function updateArticle(int $articleId, string $title, string $content): ?Article
    {
        $article = $this->articleRepository->findById($articleId);
        if (!$article) {
            return null;
        }
        $article->setTitle($title);
        $article->setContent($content);
        $this->articleRepository->save($article);

        return $article;
    }

    public function deleteArticle(int $articleId): void
    {
        $article = $this->articleRepository->findById($articleId);
        if ($article) {
            $this->articleRepository->delete($article);
        }
    }

}
