<?php
namespace Modules\Contact\Blocks;

use Modules\Template\Blocks\BaseBlock;
use Modules\Location\Models\Location;
use Modules\Media\Helpers\FileHelper;

class Contact extends BaseBlock
{
    function __construct()
    {
        $this->setOptions([
            'settings' => [
                [
                    'id'        => 'class',
                    'type'      => 'input',
                    'inputType' => 'text',
                    'label'     => __('Experience Block')
                ],
            ],
            'category'=>__("Other Block")
        ]);
    }

    public function getName()
    {
        return __('Contact Block');
    }

    public function content($model = [])
    {
        return view('Contact::frontend.blocks.contact.index', $model);
    }
}
