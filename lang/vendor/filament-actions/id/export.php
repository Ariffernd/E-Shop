<?php

return [

    'label' => 'Export :label',

    'modal' => [

        'heading' => 'Export :label',

        'form' => [

            'columns' => [

                'label' => 'Columns',

                'form' => [

                    'is_enabled' => [
                        'label' => ':column enabled',
                    ],

                    'label' => [
                        'label' => ':column label',
                    ],

                ],

            ],

        ],

        'actions' => [

            'export' => [
                'label' => 'Export',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Export Berhasil!',

            'actions' => [

                'download_csv' => [
                    'label' => 'Download .csv',
                ],

                'download_xlsx' => [
                    'label' => 'Download .xlsx',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Data Export Terlalu Besar',
            'body' => 'You may not export more than 1 row at once.|You may not export more than :count rows at once.',
        ],

        'started' => [
            'title' => 'Memuat Proses Export',
            'body' => 'Your export has begun and 1 row will be processed in the background.|Your export has begun and :count rows will be processed in the background.',
        ],

    ],

    'file_name' => 'export-:export_id-:model',

];
