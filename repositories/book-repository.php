<?php

declare(strict_types=1);

/**
 * Repository Buku
 *
 * Sumber data:
 *   config/bootstrap.php -> db()
 *
 * Format buku di library.json:
 *   id
 *   title
 *   isbn
 *   year
 *   stock
 *   category_id
 *   description
 *   author_ids
 */

/**
 * Mengambil semua buku dengan informasi kategori dan penulis.
 *
 * @param string $search  Pencarian berdasarkan judul / ISBN
 * @param int    $category Filter berdasarkan category_id, 0 = semua
 */
function getBooks(string $search = '', int $category = 0): array
{
    $data = db();

    $books = $data['books'] ?? [];
    $categories = $data['categories'] ?? [];
    $authors = $data['authors'] ?? [];

    $search = trim($search);

    $result = [];

    foreach ($books as $book) {
        $bookCategoryId = (int) ($book['category_id'] ?? 0);

        // Filter kategori
        if ($category > 0 && $bookCategoryId !== $category) {
            continue;
        }

        // Data dasar
        $title = (string) ($book['title'] ?? '');
        $isbn = (string) ($book['isbn'] ?? '');
        $year = (int) ($book['year'] ?? 0);

        // Filter pencarian
        if (
            $search !== '' &&
            stripos($title, $search) === false &&
            stripos($isbn, $search) === false
        ) {
            continue;
        }

        // Cari nama kategori
        $categoryName = '-';

        foreach ($categories as $cat) {
            if ((int) ($cat['id'] ?? 0) === $bookCategoryId) {
                $categoryName = (string) ($cat['name'] ?? '-');
                break;
            }
        }

        // Cari nama penulis
        $authorNames = [];

        foreach (($book['author_ids'] ?? []) as $authorId) {
            foreach ($authors as $author) {
                if ((int) ($author['id'] ?? 0) === (int) $authorId) {
                    $authorNames[] = (string) ($author['name'] ?? '');
                    break;
                }
            }
        }

        $result[] = [
            'id' => (int) ($book['id'] ?? 0),
            'title' => $title,
            'isbn' => $isbn,
            'year' => $year,
            'stock' => (int) ($book['stock'] ?? 0),
            'category_id' => $bookCategoryId,
            'category' => $categoryName,
            'description' => (string) ($book['description'] ?? ''),
            'authors' => $authorNames,
            'author_ids' => array_map('intval', $book['author_ids'] ?? []),
        ];
    }

    return $result;
}

/**
 * Mengambil satu buku berdasarkan ID.
 */
function getBook(int $id): ?array
{
    $data = db();

    $books = $data['books'] ?? [];
    $categories = $data['categories'] ?? [];
    $authors = $data['authors'] ?? [];

    foreach ($books as $book) {
        if ((int) ($book['id'] ?? 0) !== $id) {
            continue;
        }

        $categoryId = (int) ($book['category_id'] ?? 0);
        $categoryName = '-';

        foreach ($categories as $category) {
            if ((int) ($category['id'] ?? 0) === $categoryId) {
                $categoryName = (string) ($category['name'] ?? '-');
                break;
            }
        }

        $authorNames = [];

        foreach (($book['author_ids'] ?? []) as $authorId) {
            foreach ($authors as $author) {
                if ((int) ($author['id'] ?? 0) === (int) $authorId) {
                    $authorNames[] = (string) ($author['name'] ?? '');
                    break;
                }
            }
        }

        return [
            'id' => (int) ($book['id'] ?? 0),
            'title' => (string) ($book['title'] ?? ''),
            'isbn' => (string) ($book['isbn'] ?? ''),
            'year' => (int) ($book['year'] ?? 0),
            'stock' => (int) ($book['stock'] ?? 0),
            'category_id' => $categoryId,
            'category' => $categoryName,
            'description' => (string) ($book['description'] ?? ''),
            'authors' => $authorNames,
            'author_ids' => array_map('intval', $book['author_ids'] ?? []),
        ];
    }

    return null;
}