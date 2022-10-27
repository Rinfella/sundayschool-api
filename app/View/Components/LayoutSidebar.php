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
                            'link' => '/admin/areas',
                            'icon' => 'fa-list-ul',
                        ],
                        [
                            'title' => 'Create',
                            'link' => '/admin/areas/create',
                            'icon' => 'fa-plus',
                        ],
                ]
                ],
                [
                    'title' => 'Sessions',
                    'link' => '#',
                    'icon' => 'fa-stopwatch',
                    'routeNameStart' => 'sessions.',
                    'children' => [
                        [
                            'title' => 'SessionsList',
                            'link' => '/admin/sessions',
                            'icon' => 'fa-list-ul',
                        ],
                        [
                            'title' => 'Create',
                            'link' => '/admin/sessions/create',
                            'icon' => 'fa-plus',
                        ],
                    ]
                ],

                [
                    'title' => 'Departments',
                    'link' => '#',
                    'icon' => 'fa-stopwatch',
                    'routeNameStart' => 'departments.',
                    'children' => [
                        [
                            'title' => 'departmentsList',
                            'link' => '/admin/departments',
                            'icon' => 'fa-list-ul',
                        ],
                        [
                            'title' => 'Create',
                            'link' => '/admin/departments/create',
                            'icon' => 'fa-plus',
                        ],
                    ]
                ],

                [
                    'title' => 'Groups',
                    'link' => '#',
                    'icon' => 'fa-stopwatch',
                    'routeNameStart' => 'groups.',
                    'children' => [
                        [
                            'title' => 'groupsList',
                            'link' => '/admin/groups',
                            'icon' => 'fa-list-ul',
                        ],
                        [
                            'title' => 'Create',
                            'link' => '/admin/groups/create',
                            'icon' => 'fa-plus',
                        ],
                    ]
                ]
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
