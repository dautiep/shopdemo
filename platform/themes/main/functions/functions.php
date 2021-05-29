<?php

register_page_template([
    'default' => 'Default'
]);

register_sidebar([
    'id'          => 'second_sidebar',
    'name'        => 'Second sidebar',
    'description' => 'This is a sample sidebar for main theme',
]);
add_shortcode('Contact-form', 'Contact Form', 'Contact form my custom', function ($shortCode) {
    return Theme::partial('short-codes.contact-form');
});
RvMedia::addSize('new_post', 360, 225)
->addSize('midle',550,255)
->addSize('product',370,370)
->addSize('product-homepage', 280, 240)
->addSize('post-recent', 115, 95);
theme_option()
    ->setField([
        'id'         => 'copyright',
        'section_id' => 'opt-text-subsection-general',
        'type'       => 'text',
        'label'      => __('Copyright'),
        'attributes' => [
            'name'    => 'copyright',
            'value'   => '© 2020 Laravel Technologies. All right reserved.',
            'options' => [
                'class'        => 'form-control',
                'placeholder'  => __('Change copyright'),
                'data-counter' => 250,
            ]
        ],
        'helper' => __('Copyright on footer of site'),
    ])
    ->setSection([ // Set section with some fields
        'title' => __('Về chúng Tôi'),
        'desc' => __(''),
        'id' => 'opt-text-subsection-content',
        'subsection' => true,
        'icon' => 'fas fa-address-card',
        'fields' => [
            [
                'id' => 'name_about',
                'type' => 'text',
                'label' => __('Tên Layout'),
                'attributes' => [
                    'name' => 'name_about',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_about',
                'type' => 'textarea',
                'label' => __('Nội Dung Layout'),
                'attributes' => [
                    'name' => 'content_about',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính '),
                'attributes' => [
                    'name' => 'name_title',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính '),
                'attributes' => [
                    'name' => 'content_title',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title_2',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính 2 '),
                'attributes' => [
                    'name' => 'name_title_2',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title_2',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính 2 '),
                'attributes' => [
                    'name' => 'content_title_2',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title_3',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính 3 '),
                'attributes' => [
                    'name' => 'name_title_3',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title_3',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính 3 '),
                'attributes' => [
                    'name' => 'content_title_3',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title_4',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính 4 '),
                'attributes' => [
                    'name' => 'name_title_4',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title_4',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính 4 '),
                'attributes' => [
                    'name' => 'content_title_4',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title_5',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính 5 '),
                'attributes' => [
                    'name' => 'name_title_5',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title_5',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính 5 '),
                'attributes' => [
                    'name' => 'content_title_5',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title_6',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính 6 '),
                'attributes' => [
                    'name' => 'name_title_6',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title_6',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính 6 '),
                'attributes' => [
                    'name' => 'content_title_6',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'name_title_8',
                'type' => 'text',
                'label' => __('Tên Thuộc Tính 8 '),
                'attributes' => [
                    'name' => 'name_title_8',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'content_title_8',
                'type' => 'textarea',
                'label' => __('Nội Dung Thuộc Tính 8 '),
                'attributes' => [
                    'name' => 'content_title_8',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
        ],
    ])
    ->setSection([ // Set section with some fields
        'title' => __('Đường dẫn Theo dõi'),
        'desc' => __(''),
        'id' => 'opt-text-subsection-link-follow',
        'subsection' => true,
        'icon' => 'fas fa-link',
        'fields' => [
            [
                'id' => 'link_FB',
                'type' => 'text',
                'label' => __('Đường Dẫn FaceBook'),
                'attributes' => [
                    'name' => 'link_FB',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'link_instagram',
                'type' => 'text',
                'label' => __('Đường Dẫn Instagram'),
                'attributes' => [
                    'name' => 'link_instagram',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'link_linkedin',
                'type' => 'text',
                'label' => __('Đường Dẫn Linkedin'),
                'attributes' => [
                    'name' => 'link_linkedin',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'link_twitter',
                'type' => 'text',
                'label' => __('Đường Dẫn Twitter'),
                'attributes' => [
                    'name' => 'link_twitter',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'link_gmail',
                'type' => 'text',
                'label' => __('Đường Dẫn Gmail'),
                'attributes' => [
                    'name' => 'link_gmail',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'link_youtobe',
                'type' => 'text',
                'label' => __('Đường Dẫn Youtobe'),
                'attributes' => [
                    'name' => 'link_youtobe',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'gmail',
                'type' => 'text',
                'label' => __('Nhập Gmail'),
                'attributes' => [
                    'name' => 'gmail',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
            [
                'id' => 'phone_number',
                'type' => 'text',
                'label' => __('Nhập Số Điện Thoại'),
                'attributes' => [
                    'name' => 'phone_number',
                    'value' => null,
                    'options' => [
                        'class' => 'form-control',
                    ],
                ],
            ],
        ],
    ])
    ;

add_action('init', function () {
    config(['filesystems.disks.public.root' => public_path('storage')]);
}, 124);
