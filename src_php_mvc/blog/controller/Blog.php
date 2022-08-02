<?php

namespace blog\controller;

use blog\model\Entry;
use LogicException;
use mvc\Controller;
use RuntimeException;

class Blog extends Controller
{
    /**
     * Index page
     * @throws RuntimeException
     */
    public function index()
    {
        echo $this->getViewWithLayout('index', ['lastEntries' => Entry::getLastEntries()]);
    }

    /**
     * Detail page
     * @throws LogicException
     * @throws RuntimeException
     */
    public function entry()
    {
        $id = $_GET['id'] ?? 0;
        $entry = Entry::getById($id);
        if (!$entry) {
            throw new LogicException('404 Not found');
        }

        echo $this->getViewWithLayout('entry', ['entry' => $entry]);
    }
}