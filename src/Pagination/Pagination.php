<?php

namespace Monii\Specification\Pagination;

class Pagination
{
    /**
     * @var int|null
     */
    private $perPage;

    /**
     * @var int|null
     */
    private $page;

    /**
     * @param int|null $perPage
     * @param int|null $page
     */
    public function __construct($perPage = null, $page = null)
    {
        $this->perPage = $perPage;
        $this->page = $page;
    }

    /**
     * @return int|null
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }

    public static function createWithoutPagingInformation()
    {
        return new self();
    }

    public static function createWithPerPageOnly($perPage)
    {
        return new self($perPage);
    }

    public static function createWithPageOnly($page)
    {
        return new self(null, $page);
    }

    public static function createWithPerPageAndPage($perPage, $page)
    {
        return new self($perPage, $page);
    }
}
