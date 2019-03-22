<?php

namespace app\models;

use yii\db\ActiveRecord;

class Route extends ActiveRecord
{

    public static function tableName()
    {
        return '{{route}}';
    }

    public function fields()
    {
        return [
            'id',
            'origin',
            'destination',
            'price',
            'company',
            'schedule',
            'departureStr',
            'arrivalStr',
            'longevityStr',
        ];
    }

    public function extraFields()
    {
        return [
            'departure',
            'arrival',
            'longevity',
        ];
    }
    public function rules()
    {
        /*
         * Will define proper rules later
         * Stub rules allow us to use update and create
         * functions in RESTapi
         */
        return [
            [
                [
                    'origin',
                    'departure',
                    'destination',
                    'arrival',
                    'longevity',
                    'price',
                    'company',
                    'schedule',
                    'departureStr',
                    'arrivalStr',
                    'longevityStr',
                ],
                'safe'
            ],
        ];
    }

    public static function validateTimeStr(string $input): bool
    {
        return preg_match('/^\d+:[0-5]\d$/', $input) === 1;
    }

    /*
     * Конвертирует строковое представление времени - "hh:mm"
     * в целое число представляющее количество минут
     */
    public static function timeStrToInt(string $input): int
    {
        [ $hours, $minutes ] = array_map('intval', explode(':', $input, 2));
        return $hours * 60 + $minutes;
    }

    /*
     * Конвертирует число минут в строковое представление - 'hh:mm'
     */
    public static function timeIntToStr(int $input): string
    {
        return sprintf('%02d:%02d', intdiv($input, 60), $input % 60);
    }

    private function setTimeStrField(string $field, string $input): void
    {
        if ($this->validateTimeStr($input))
        {
            $this->$field = $this->timeStrToInt($input);
        }
    }

    private function getTimeStrField(string $field): string
    {
        if ($this->$field === null)
        {
            return '--:--';
        }
        else
        {
            return $this->timeIntToStr($this->$field);
        }
    }

    public function setDepartureStr(string $input): void
    {
        $this->setTimeStrField('departure', $input);
    }

    public function getDepartureStr(): string
    {
        return $this->getTimeStrField('departure');
    }

    public function setArrivalStr(string $input): void
    {
        $this->setTimeStrField('arrival', $input);
    }

    public function getArrivalStr(): string
    {
        return $this->getTimeStrField('arrival');
    }

    public function setLongevityStr(string $input): void
    {
        $this->setTimeStrField('longevity', $input);
    }

    public function getLongevityStr(): string
    {
        return $this->getTimeStrField('longevity');
    }
}
