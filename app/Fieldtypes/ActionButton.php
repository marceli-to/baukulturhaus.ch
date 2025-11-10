<?php

namespace App\Fieldtypes;

use Statamic\Fields\Fieldtype;

class ActionButton extends Fieldtype
{
    /**
     * The fieldtype icon.
     *
     * @var string
     */
    protected $icon = 'hyperlink';

    /**
     * The fieldtype categories.
     *
     * @var array
     */
    protected $categories = ['special'];

    /**
     * Configuration fields for the fieldtype.
     *
     * @return array
     */
    protected function configFieldItems(): array
    {
        return [
            [
                'display' => 'Appearance',
                'fields' => [
                    'button_text' => [
                        'display' => 'Button Text',
                        'instructions' => 'The text to display on the button',
                        'type' => 'text',
                        'default' => 'Download',
                        'width' => 50,
                    ],
                    'new_tab' => [
                        'display' => 'Open in New Tab',
                        'instructions' => 'Open the link in a new browser tab',
                        'type' => 'toggle',
                        'default' => true,
                        'width' => 50,
                    ],
                ],
            ],
        ];
    }

    /**
     * The blank/default value.
     *
     * @return array
     */
    public function defaultValue()
    {
        return null;
    }

    /**
     * Pre-process the data before it gets sent to the publish page.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        return $data;
    }

    /**
     * Process the data before it gets saved.
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function process($data)
    {
        return $data;
    }
}
