<?php

namespace App\Http\Handlers;

use App\Http\Handlers\HandlerInterface;
use App\Students\StudentsTableGateway;

use function App\Functions\getQueryParam;
use function App\Functions\view;

class IndexHandler implements HandlerInterface
{
    public function __construct(private StudentsTableGateway $studentsTableGateway)
    {
    }

    public function handle()
    {
        $currentPage = $this->getPageParam();

        $limit = 15;
        $offset = $limit * ($currentPage - 1);

        $students = $this->studentsTableGateway->getAll($limit, $offset);

        $totalCount = $this->studentsTableGateway->countAll();
        $pagesCount = (int)ceil($totalCount / $limit);

        http_response_code(200);
        return view('index', [
            'students' => $students,
            'currentPage' => $currentPage,
            'limit' => $limit,
            'pagesCount' => $pagesCount,
            'total' => $totalCount,
        ]);
    }

    private function getPageParam(): int
    {
        $page = (int)getQueryParam('page', 1);

        if ($page <= 0) {
            $page = 1;
        }

        return $page;
    }
}
