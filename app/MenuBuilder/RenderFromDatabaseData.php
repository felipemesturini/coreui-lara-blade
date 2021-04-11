<?php
/*
*   08.11.2019
*   RenderFromDatabaseData
*/

namespace App\MenuBuilder;

use App\MenuBuilder\MenuBuilder;

class RenderFromDatabaseData
{

    private $mb; // MenuBuilder
    private $data;

    public function __construct()
    {
        $this->mb = new MenuBuilder();
    }

    private function addTitle($data)
    {
        $this->mb->addTitle($data->id, $data->name, false, 'coreui', $data->sequence);
    }

    private function addLink($data)
    {
        if ($data->parent_id === NULL) {
            $this->mb->addLink($data->id, $data->name, $data->href, $data->icon, 'coreui', $data->sequence);
        }
    }

    private function dropdownLoop($id)
    {
        foreach ($this->data as $item) {
            if ($item->parent_id == $id) {
                if ($item->slug === 'dropdown') {
                    $this->addDropdown($item);
                } elseif ($item->slug === 'link') {
                    $this->mb->addLink($item->id, $item->name, $item->href, $item->icon, 'coreui', $item->sequence);
                } else {
                    $this->addTitle($item);
                }
            }
        }
    }

    private function addDropdown($data)
    {
        $this->mb->beginDropdown($data->id, $data->name, $data->icon, 'coreui', $data->sequence);
        $this->dropdownLoop($data->id);
        $this->mb->endDropdown();
    }

    private function mainLoop()
    {
        foreach ($this->data as $item) {
            switch ($item->slug) {
                case 'title':
                    $this->addTitle($item);
                    break;
                case 'link':
                    $this->addLink($item);
                    break;
                case 'dropdown':
                    if ($item->parent_id == null) {
                        $this->addDropdown($item);
                    }
                    break;
            }
        }
    }

    /***
     * $data - array
     * return - array
     */
    public function render($data)
    {
        if (!empty($data)) {
            $this->data = $data;
            $this->mainLoop();
        }
        return $this->mb->getResult();
    }

}
