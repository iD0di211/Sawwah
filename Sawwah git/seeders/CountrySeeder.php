<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [ 'name' => 'تركيا', 'cost' => 'low', 'weather' => 'cold', 'language' => 'turkish,arabic', 'type' => 'family', 'description' => 'وجهة عائلية ومناسبة للجميع. طبيعة جميلة وأسعار متوسطة.' ],
            [ 'name' => 'مصر', 'cost' => 'low', 'weather' => 'hot', 'language' => 'arabic,english', 'type' => 'family', 'description' => 'تاريخ عريق وأسعار سفر منخفضة. شعب مضياف وأماكن سياحية متعددة.' ],
            [ 'name' => 'جورجيا', 'cost' => 'low', 'weather' => 'cold', 'language' => 'english,russian', 'type' => 'friends', 'description' => 'بلد جبلي بطبيعة ساحرة وتكاليف منخفضة جداً، مناسب للأصدقاء.' ],
            [ 'name' => 'الإمارات', 'cost' => 'high', 'weather' => 'hot', 'language' => 'arabic,english', 'type' => 'family', 'description' => 'دبي وأبوظبي وجهات فاخرة وخيارات ترفيهية عالمية.' ],
            [ 'name' => 'إيطاليا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'italian,english', 'type' => 'family', 'description' => 'بلد الفن والتاريخ والمأكولات الإيطالية الشهيرة.' ],
            [ 'name' => 'فرنسا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'french,english', 'type' => 'single', 'description' => 'باريس مدينة الحب، والفن، والتسوق، والمطاعم الراقية.' ],
            [ 'name' => 'إندونيسيا', 'cost' => 'low', 'weather' => 'hot', 'language' => 'indonesian,english', 'type' => 'family', 'description' => 'جزر خلابة، مناظر طبيعية، وشعب ودود للغاية.' ],
            [ 'name' => 'ماليزيا', 'cost' => 'low', 'weather' => 'hot', 'language' => 'malay,english', 'type' => 'family', 'description' => 'أماكن سياحية متنوعة وأسواق شعبية عالمية.' ],
            [ 'name' => 'اليونان', 'cost' => 'medium', 'weather' => 'hot', 'language' => 'greek,english', 'type' => 'friends', 'description' => 'جزر بحر إيجة، وشواطئ ساحرة، وأجواء مثالية للراحة.' ],
            [ 'name' => 'سويسرا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'german,french,english', 'type' => 'family', 'description' => 'طبيعة جبال الألب الخلابة ومدن هادئة.' ],
            [ 'name' => 'ألمانيا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'german,english', 'type' => 'single', 'description' => 'تاريخ وحداثة، وأسواق عيد الميلاد الشهيرة.' ],
            [ 'name' => 'إسبانيا', 'cost' => 'medium', 'weather' => 'hot', 'language' => 'spanish,english', 'type' => 'friends', 'description' => 'مدن نابضة بالحياة، شواطئ، ومهرجانات موسيقية.' ],
            [ 'name' => 'تايلاند', 'cost' => 'low', 'weather' => 'hot', 'language' => 'thai,english', 'type' => 'single', 'description' => 'تكاليف منخفضة، شواطئ، وأسواق شعبية.' ],
            [ 'name' => 'أذربيجان', 'cost' => 'low', 'weather' => 'cold', 'language' => 'turkish,english', 'type' => 'family', 'description' => 'بلد جميل، شعب ودود، وطبيعة ساحرة.' ],
            [ 'name' => 'المغرب', 'cost' => 'low', 'weather' => 'hot', 'language' => 'arabic,french', 'type' => 'family', 'description' => 'أسواق شعبية، مدن تاريخية، ومغامرات صحراوية.' ],
            [ 'name' => 'السعودية', 'cost' => 'medium', 'weather' => 'hot', 'language' => 'arabic', 'type' => 'family', 'description' => 'وجهات دينية وتاريخية ومناطق طبيعية متنوعة.' ],
            [ 'name' => 'البوسنة', 'cost' => 'low', 'weather' => 'cold', 'language' => 'bosnian,english', 'type' => 'family', 'description' => 'أنهار، جبال، ومدن تاريخية أوروبية بأسعار منخفضة.' ],
            [ 'name' => 'بريطانيا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'english', 'type' => 'single', 'description' => 'عراقة لندن وحدائقها ومعالمها التاريخية.' ],
            [ 'name' => 'النمسا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'german,english', 'type' => 'family', 'description' => 'جبال الألب والقلاع والمدن الهادئة.' ],
            [ 'name' => 'أمريكا', 'cost' => 'high', 'weather' => 'hot', 'language' => 'english,spanish', 'type' => 'friends', 'description' => 'تجارب متنوعة في القارة الأمريكية من نيويورك إلى لوس أنجلوس.' ],
            [ 'name' => 'اليابان', 'cost' => 'high', 'weather' => 'cold', 'language' => 'japanese,english', 'type' => 'single', 'description' => 'حضارة عريقة، تقنيات متطورة، وطبيعة جبلية خلابة.' ],
            [ 'name' => 'الهند', 'cost' => 'low', 'weather' => 'hot', 'language' => 'hindi,english', 'type' => 'family', 'description' => 'ثقافة متنوعة، طعام لذيذ، وتكاليف منخفضة للسفر.' ],
            [ 'name' => 'البرازيل', 'cost' => 'low', 'weather' => 'hot', 'language' => 'portuguese,english', 'type' => 'friends', 'description' => 'شواطئ خلابة، مهرجانات، وطبيعة استوائية.' ],
            [ 'name' => 'روسيا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'russian,english', 'type' => 'family', 'description' => 'مدن تاريخية، طقس بارد، وتجارب ثقافية مميزة.' ],
            [ 'name' => 'أستراليا', 'cost' => 'high', 'weather' => 'hot', 'language' => 'english', 'type' => 'single', 'description' => 'طبيعة متنوعة، حياة برية، ومدن حديثة.' ],
            [ 'name' => 'جنوب أفريقيا', 'cost' => 'low', 'weather' => 'hot', 'language' => 'english,afrikaans', 'type' => 'friends', 'description' => 'سفاري، محميات طبيعية، ومغامرات لا تنسى.' ],
            [ 'name' => 'الأرجنتين', 'cost' => 'low', 'weather' => 'cold', 'language' => 'spanish,english', 'type' => 'family', 'description' => 'طبيعة متنوعة، شلالات، وتقاليد لاتينية.' ],
            [ 'name' => 'كندا', 'cost' => 'high', 'weather' => 'cold', 'language' => 'english,french', 'type' => 'family', 'description' => 'جبال، بحيرات، ومدن عصرية.' ],
            [ 'name' => 'كوريا الجنوبية', 'cost' => 'high', 'weather' => 'cold', 'language' => 'korean,english', 'type' => 'single', 'description' => 'تقنية، ثقافة بوب، وطعام شهي.' ],
            [ 'name' => 'الأردن', 'cost' => 'low', 'weather' => 'hot', 'language' => 'arabic', 'type' => 'family', 'description' => 'البحر الميت، البتراء، وتاريخ عريق.' ],
            [ 'name' => 'تونس', 'cost' => 'low', 'weather' => 'hot', 'language' => 'arabic,french', 'type' => 'family', 'description' => 'أسواق شعبية، شواطئ رائعة، وثقافة متوسطية.' ],
            [ 'name' => 'سنغافورة', 'cost' => 'high', 'weather' => 'hot', 'language' => 'english,malay', 'type' => 'single', 'description' => 'مدينة حديثة، حدائق خلابة، ونظام نقل متطور.' ],
            [ 'name' => 'الفلبين', 'cost' => 'low', 'weather' => 'hot', 'language' => 'filipino,english', 'type' => 'friends', 'description' => 'جزر استوائية، شواطئ بيضاء، وناس ودودون.' ],
            [ 'name' => 'سريلانكا', 'cost' => 'low', 'weather' => 'hot', 'language' => 'sinhala,english', 'type' => 'family', 'description' => 'شواطئ، مزارع شاي، وطبيعة خضراء.' ],
            [ 'name' => 'البرتغال', 'cost' => 'low', 'weather' => 'hot', 'language' => 'portuguese,english', 'type' => 'friends', 'description' => 'شواطئ أطلنطية، مطبخ بحري، ومدن تاريخية.' ],
            [ 'name' => 'الصين', 'cost' => 'low', 'weather' => 'cold', 'language' => 'chinese,english', 'type' => 'family', 'description' => 'سور الصين، حضارة، وأكلات مميزة.' ]
        ];

        foreach ($countries as $country) {
            if (isset($country['cost']) && !in_array($country['cost'], ['high','low','medium'])) {
                $country['cost'] = 'low';
            }
            if (isset($country['weather']) && !in_array($country['weather'], ['hot','cold'])) {
                $country['weather'] = 'hot';
            }
            Country::create($country);
        }
    }
}
