<?php

namespace app\models;

use PhpOffice\PhpSpreadsheet\IOFactory;
use yii\base\Model;
use yii\web\UploadedFile;

class ImportForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $importFile;

    public function rules()
    {
        return [
            [
                ['importFile'], 'file', 'skipOnEmpty' => false,
                'extensions' => 'xlsx'
            ]
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->importFile->saveAs('uploads/import.' . $this->importFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'importFile' => 'Файл для импорта',
            'clearAll' => 'Очистить БД от предыдущих записей>'
        ];
    }

    public static function importRaw()
    {
        $count = 0;
        $savedCount = 0;
        $end = "";
        $row = 11;
        $sFile = 'uploads/import.xlsx';
        $oSpreadsheet = IOFactory::load($sFile);
        $oCells = $oSpreadsheet->getActiveSheet()->getCellCollection();
        while ($end != "Итого") {
            $nameCell = $oCells->get('D' . $row);
            $inventory_numberCell = $oCells->get('K' . $row);
            $date_accountingCell = $oCells->get('O' . $row);
            $date_manufactureCell = $oCells->get('S' . $row);
            $serial_numberCell = $oCells->get('U' . $row);
            if ($nameCell) {
                $name = $nameCell->getValue();
            } else {
                $name = "";
            }
            if ($inventory_numberCell) {
                $inventory_number = $inventory_numberCell->getValue();
            } else {
                $inventory_number = "";
            }
            if ($date_accountingCell) {
                $date_accounting = strtotime($date_accountingCell->getValue());
            } else {
                $date_accounting = "";
            }


            if ($date_manufactureCell) {
                $date_manufactureValue = $date_manufactureCell->getValue();
                if ($date_manufactureValue === "") {
                    $date_manufacture = NULL;
                } else {
                    $date_manufacture = strtotime($date_manufactureCell->getValue());
                }
            } else {
                $date_manufacture = NULL;
            }


            if ($serial_numberCell) {
                $serial_number = $serial_numberCell->getValue();
            } else {
                $serial_number = "";
            }
            $count++;
            $row++;
            $end = $oCells->get('A' . $row);

            $rawTechnics = new RawTechnics();
            $rawTechnics->name = $name;
            $rawTechnics->inventory_number = $inventory_number;
            $rawTechnics->date_accounting = $date_accounting;
            $rawTechnics->date_manufacture = $date_manufacture;
            $rawTechnics->serial_number = $serial_number;
            if ($rawTechnics->save()) {
                $savedCount++;
            }
            if ($count == 30000) {
                return
                    "Успешно сохранено " . $savedCount . " записей, пройдено в файле " . $count . " записей, остановка прохода файла по максимальному количеству записей (30К)";
            }
        }
        return
            "Успешно сохранено " . $savedCount . " записей, пройдено в файле " . $count . " записей, если количество не совпадает, то обратитесь к разработчику.";
        //isNull($date_manufactureCell) . " " . $serial_number;
    }


}
