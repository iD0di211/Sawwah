<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name', 'cost', 'weather', 'language', 'type', 'description'
    ];

    // تصنيف تكلفة السفر (عالية/متوسطة/منخفضة)
    public function getCostLabelAttribute()
    {
        if ($this->cost === 'high') return 'عالية';
        if ($this->cost === 'medium') return 'متوسطة';
        return 'منخفضة';
    }

    // تصنيف الطقس
    public function getWeatherLabelAttribute()
    {
        return $this->weather === 'cold' ? 'بارد' : 'حار';
    }

    // ترجمة كل اللغات في السطر (تستخدم في كارد الدولة)
    public function getLanguageLabelAttribute()
    {
        $langs = [
            'arabic' => 'العربية',
            'english' => 'الإنجليزية',
            'turkish' => 'التركية',
            'french' => 'الفرنسية',
            'german' => 'الألمانية',
            'russian' => 'الروسية',
            'spanish' => 'الإسبانية',
            'korean' => 'الكورية',
            'italian' => 'الإيطالية',
            'portuguese' => 'البرتغالية',
            'malay' => 'الملايوية',
            'indonesian' => 'الإندونيسية',
            'bosnian' => 'البوسنية',
            'japanese' => 'اليابانية',
            'hindi' => 'الهندية',
            'afrikaans' => 'الأفريكانية',
            'norwegian' => 'النرويجية',
            'chinese' => 'الصينية',
            'swahili' => 'السواحيلية',
            'filipino' => 'الفلبينية',
            'sinhala' => 'السنهالية',
            'greek' => 'اليونانية',
        ];
        $arr = array_map('trim', explode(',', $this->language));
        $translated = array_map(fn($l) => $langs[$l] ?? $l, $arr);
        return implode('، ', $translated);
    }

    // ترجمة نوع الرحلة
    public function getTypeLabelAttribute()
    {
        $types = [
            'family' => 'عائلي',
            'single' => 'فردي',
            'friends' => 'أصدقاء',
        ];
        return $types[$this->type] ?? $this->type;
    }

    // دالة ترجمة كود لغة مفرد (تستخدم في فلتر الواجهة)
    public static function langName($code)
    {
        $langs = [
            'arabic' => 'العربية',
            'english' => 'الإنجليزية',
            'turkish' => 'التركية',
            'french' => 'الفرنسية',
            'german' => 'الألمانية',
            'russian' => 'الروسية',
            'spanish' => 'الإسبانية',
            'korean' => 'الكورية',
            'italian' => 'الإيطالية',
            'portuguese' => 'البرتغالية',
            'malay' => 'الملايوية',
            'indonesian' => 'الإندونيسية',
            'bosnian' => 'البوسنية',
            'japanese' => 'اليابانية',
            'hindi' => 'الهندية',
            'afrikaans' => 'الأفريكانية',
            'norwegian' => 'النرويجية',
            'chinese' => 'الصينية',
            'swahili' => 'السواحيلية',
            'filipino' => 'الفلبينية',
            'sinhala' => 'السنهالية',
            'greek' => 'اليونانية',
        ];
        return $langs[trim($code)] ?? $code;
    }
}
