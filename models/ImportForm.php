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


    public static function importMaterials()
    {
        $count = 0;
        $savedCount = 0;
        $updatedCount = 0;
        $errorMessage = "";
        $end = "";
        $row = 11;
        $sFile = 'uploads/import.xlsx';
        $oSpreadsheet = IOFactory::load($sFile);
        $oCells = $oSpreadsheet->getActiveSheet()->getCellCollection();
        $importDate = time();
        while ($end != "Итого") {
            $nameCell = $oCells->get('A' . $row);
            $countCell = $oCells->get('E' . $row);
            if ($nameCell) {
                $name = $nameCell->getValue();
            } else {
                $name = "";
            }
            if ($countCell) {
                $countMaterial = $countCell->getValue();
            } else {
                $countMaterial = 0;
            }
            $findedMaterials = Materials::find()
                ->where(['name' => $name])
                ->all();
            if (count($findedMaterials) == 1)
            {
                $materialUpdate = Materials::findOne($findedMaterials[0]->id);
                $materialUpdate->count = $countMaterial;
                $materialUpdate->date_add = $importDate;
                $materialUpdate->save();
                $updatedCount++;
            }
            elseif (count($findedMaterials) == 0)
            {
                $material = new Materials();
                $material->name =$name;
                $material->count = $countMaterial;
                $material->date_add = $importDate;
                $material->save();
                $savedCount++;
            }
            else
            {
                $errorMessage = $errorMessage . "$name имеет в базе более одного совпадения, обновите вручную!\r\n";
            }
            $row++;
            $count++;
            $end = $oCells->get('A' . $row);
            if ($count == 3000) {
                return
                    "Успешно сохранено " . $savedCount . " записей, обновлено "
                    . $updatedCount . " записей, пройдено в файле "
                    . $count . " записей, остановка прохода файла по максимальному количеству записей (3К). \r\n\r\nОтладочная информация:"
                    . $errorMessage;
            }
        }
        return
            "Успешно сохранено " . $savedCount . " записей, обновлено "
            . $updatedCount . " записей, пройдено в файле "
            . $count . " записей, если количество не совпадает, то обратитесь к разработчику. \r\n\r\nОтладочная информация: "
            . $errorMessage;

    }

    public static function importTechnics()
    {
        $count = 0;
        $savedCount = 0;
        $notChangedCount = 0;
        $errorMessage = "";
        $end = "_";
        $row = 13;
        $sFile = 'uploads/import.xlsx';
        $oSpreadsheet = IOFactory::load($sFile);
        $oCells = $oSpreadsheet->getActiveSheet()->getCellCollection();
        $importDate = time();
        while ($end != "") {
            $nameCell = $oCells->get('G' . $row);
            $inventCardCell = $oCells->get('B' . $row);
            $inventCardDateCell = $oCells->get('C' . $row);
            $serialNumberCell = $oCells->get('D' . $row);
            $inventNumberCell = $oCells->get('E' . $row);
            if ($nameCell) {
                $name = $nameCell->getValue();
            } else {
                $name = "";
            }
            if ($inventCardCell) {
                $inventCardNumber = (int)$inventCardCell->getValue();
            } else {
                $inventCardNumber = NULL;
            }
            if ($inventCardDateCell) {
                $inventCardDateValue = $inventCardDateCell->getValue();
                if ($inventCardDateValue === "") {
                    $inventCardDate = NULL;
                } else {
                    $inventCardDate = strtotime($inventCardDateCell->getValue());
                }
            } else {
                $inventCardDate = NULL;
            }
            if ($serialNumberCell) {
                $serialNumber = $serialNumberCell->getValue();
            } else {
                $serialNumber = "";
            }
            if ($inventNumberCell) {
                $inventNumber = $inventNumberCell->getValue();
            } else {
                $inventNumber = NULL;
            }


            $findedTechnics = Technics::find()
                ->where(['inventory_number' => $inventNumber])
                ->all();
            if (count($findedTechnics) == 1)
            {
                $technics = Technics::findOne($findedTechnics[0]->id);
                if ($technics->count != $findedTechnics[0]->id AND $technics->count == 0)
                {
                    $errorMessage = $errorMessage. "$inventNumber, $name  не списался по бухучету, проверьте!\r\n";
                }
                $notChangedCount++;
            }
            elseif (count($findedTechnics) == 0)
            {
                $technics = new Technics();
                $technics->name =$name;
                $technics->inventory_number = $inventNumber;
                $technics->invent_card = $inventCardNumber;
                $technics->date_accounting = $inventCardDate;
                $technics->count = 1;
                $technics->serial_number = $serialNumber;
                $technics->date_add = $importDate;
                $technics->save();
                $savedCount++;
            }
            else
            {
                $errorMessage = $errorMessage . "$name имеет в базе более одного совпадения, обновите вручную!\r\n";
            }
            $row++;
            $count++;
            $end = $oCells->get('G' . $row);
            if ($count == 3000) {
                return
                    "Успешно сохранено " . $savedCount . " записей, пропущено "
                    . $notChangedCount . " неизмененных записей, пройдено в файле "
                    . $count . " записей, остановка прохода файла по максимальному количеству записей (3К).\r\n\r\nОтладочная информация:"
                    . $errorMessage;
            }
        }
        return
            "Успешно сохранено " . $savedCount . " записей, пропущено "
            . $notChangedCount . " неизмененных записей, пройдено в файле "
            . $count . " записей, если количество не совпадает, то обратитесь к разработчику. \r\n\r\nОтладочная информация: "
            . $errorMessage;

    }

    public static function importTechnicsZ21()
    {
        $count = 0;
        $savedCount = 0;
        $updatedCount = 0;
        $errorMessage = "";
        $end = "";
        $row = 11;
        $sFile = 'uploads/import.xlsx';
        $oSpreadsheet = IOFactory::load($sFile);
        $oCells = $oSpreadsheet->getActiveSheet()->getCellCollection();
        $importDate = time();
        while ($end != "Итого") {
            $nameCell = $oCells->get('A' . $row);
            $countCell = $oCells->get('E' . $row);
            if ($nameCell) {
                $name = $nameCell->getValue();
            } else {
                $name = "";
            }
            if ($countCell) {
                $countTechnics = $countCell->getValue();
            } else {
                $countTechnics = 0;
            }
            $findedTechnics = Technics::find()
                ->where(['name' => $name])
                ->andWhere(['inventory_number' => 'з21'])
                ->all();
            if (count($findedTechnics) == 1)
            {
                $technicsUpdate = Technics::findOne($findedTechnics[0]->id);
                $technicsUpdate->count = $countTechnics;
                $technicsUpdate->date_add = $importDate;
                $technicsUpdate->save();
                $updatedCount++;
            }
            elseif (count($findedTechnics) == 0)
            {
                $technicsNew = new Technics();
                $technicsNew->name = $name;
                $technicsNew->inventory_number = 'з21';
                $technicsNew->invent_card = -1;
                $technicsNew->date_accounting = 0;
                $technicsNew->count = $countTechnics;
                $technicsNew->serial_number = '-';
                $technicsNew->date_add = $importDate;
                $technicsNew->save();
                $savedCount++;
            }
            else
            {
                $errorMessage = $errorMessage . "$name имеет в базе более одного совпадения, обновите вручную!\r\n";
            }
            $row++;
            $count++;
            $end = $oCells->get('A' . $row);
            if ($count == 3000) {
                return
                    "Успешно сохранено " . $savedCount . " записей, обновлено "
                    . $updatedCount . " записей, пройдено в файле "
                    . $count . " записей, остановка прохода файла по максимальному количеству записей (3К). \r\n\r\nОтладочная информация:"
                    . $errorMessage;
            }
        }
        return
            "Успешно сохранено " . $savedCount . " записей, обновлено "
            . $updatedCount . " записей, пройдено в файле "
            . $count . " записей, если количество не совпадает, то обратитесь к разработчику. \r\n\r\nОтладочная информация: "
            . $errorMessage;

    }

}
