<?php

namespace app\models;

use yii\db\ActiveRecord;

class Route extends ActiveRecord
{
    // Week days
    const WD = ['пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'];

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

    public static function validateScheduleStr(string $input): bool
    {
        $exp = '/^([, ]*(' . implode('|', Route::WD) . '))*$/';
        return preg_match($exp, $input) === 1;
    }

    /*
     * Конвертирует число представляющее битовую маску в список дней недели.
     *     0b0010101 ---> 'пн, ср, пт'
     * 1 - день в списке, 0 - нет.
     * Младший бит - понедельник.
     * 7-й бит - воскресенье.
     */ 
    public static function scheduleIntToStr(int $input): string
    {
        $result = [];
        for ($i = 0; $i < count(Route::WD); $i++)
        {
            if ($input & (1 << $i)) {
                $result[] = Route::WD[$i];
            }
        }
        return implode(', ', $result);
    }

    /*
     * Конвертирует список дней недели в битовую маску.
     *     'пн, ср, пт' ---> 0b0010101
     */ 
    public static function scheduleStrToInt(string $input): int
    {
        $result = 0;
        foreach (explode(',', $input) as $day)
        {
            $i = array_search(trim($day), Route::WD);
            if (is_int($i))
            {
                $result |= 1 << $i;
            }
        }
        return $result;
    }

    /*
     * Вычисляем время прибытия на основе времени отправления и времени в пути.
     * Прибытие может выпасть на следующие дни после отправления, поэтому
     * используем остаток от деления.
     */ 
    public function getArrival(): ?int
    {
        if (is_int($this->departure) && is_int($this->longevity))
        {
            return ($this->departure + $this->longevity) % (24 * 60);
        }
        else
        {
            return null;
        }
    }

    /*
     * Для установки нового времени прибытия пытаемся установить время в пути
     * или время отправления, смотря - что заполненно.
     */ 
    public function setArrival(int $input): void
    {
        // Modulo (%) может возвращать отрицательные значения,
        // что в данном случае нежелательно.
        // Поэтому, формулы вышли немного мудрёные.
        if (is_int($this->departure))
        {
            $this->longevity = (24 * 60 + $input - $this->departure) % (24 * 60);
        }
        elseif (is_int($this->longevity))
        {
            $this->departure = (24 * 60 + $input - ($this->longevity % (24 * 60))) % (24 * 60);
        }
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
