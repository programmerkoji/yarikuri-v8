<?php
namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PaginationHelper
{
    /**
     * ページネーションのカスタムリンクを作成
     */
    public static function generatePaginationLinks(LengthAwarePaginator $paginator, int $displayCount = 5): Collection
    {
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();

        // 5ページ以上ある場合のページネーション制御
        if ($lastPage > $displayCount) {
            if ($currentPage <= 3) {
                $start = 1;
                $end = $displayCount;
            } elseif ($currentPage >= $lastPage - 2) {
                $start = $lastPage - ($displayCount - 1);
                $end = $lastPage;
            } else {
                $start = $currentPage - 2;
                $end = $currentPage + 2;
            }
        } else {
            $start = 1;
            $end = $lastPage;
        }
        return collect(range($start, $end))->map(function ($page) use ($paginator) {
            return [
                'url' => $paginator->url($page),
                'label' => (string)$page,
                'active' => $page == $paginator->currentPage()
            ];
        });
    }
}
