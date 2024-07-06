<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
use kartik\typeahead\Typeahead;


echo '<label class="control-label">State</label>';
$data = [
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
    'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];
echo Typeahead::widget([
    'name' => 'country',
    'options' => ['placeholder' => 'Filter as you type ...'],
    'pluginOptions' => ['highlight'=>true],
    'dataset' => [
        [
            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
            'display' => 'value',
            //'prefetch' => $baseUrl . '/samples/countries.json',
            'remote' => [
                'url' => Url::to(['raw-technics/inventory-number-list']) . '?q=%QUERY',
                'wildcard' => '%QUERY'
            ]
        ],
        [
            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
            'display' => 'value',
            //'prefetch' => $baseUrl . '/samples/countries.json',
            'remote' => [
                'url' => Url::to(['raw-technics/serial-number-list']) . '?q=%QUERY',
                'wildcard' => '%QUERY'
            ]
        ]
    ]
]);
?>
<h1>Регистрация нового ремонта</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<h1>Журнал ремонтов</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
