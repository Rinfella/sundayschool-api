<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LayoutSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        logger('in constructor');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        logger('hello');
        $items = [
            [
                'title' => 'Dashboard',
                'link' => '/admin',
                'icon' => 'fa-tachometer-alt',
            ],
            [
                'title' => 'Areas',
                'link' => '#',
                'icon' => 'fa-circle',
                'routeNameStart' => 'areas.',
                'children' => [
                    [
                        'title' => 'List',
                        'link' => 'areas',
                        'icon' => 'fa-list-ul',
                    ],
                    [
                        'title' => 'Create',
                        'link' => '/admin/areas/create',
                        'icon' => 'fa-plus',
                    ],
                ]
                ],
            ];

            foreach($items as &$item) {
                $item['isActive'] = false;

                if (isset($item['children']) && (strpos(request()->route()->getName(), $item['routeNameStart']) === 0)) {
                    $item['isActive'] = true;
                }

                if (!isset($item['children'])) {
                    $item['isActive'] = request()->route()->uri() == $item['link'];
                }

                if (isset($item['children'])) {
                    foreach($item['children'] as &$child) {
                        $child['isActive'] = request()->route()->uri() == $child['link'];
                    }
                }
            }

        return view('components.layout.sidebar', ['items' => $items]);
    }
}
