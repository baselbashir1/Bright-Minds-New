<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            'الطفل يعرف:  أ',
            'الطفل يعرف الحروف : ب ت ث',
            'الطفل يعرف الحروف : ج ح خ',
            'الطفل يعرف الحروف : د ذ ر ز',
            'الطفل يعرف الحروف: س ش ص ض',
            'الطفل يعرف الحروف: ط ظ ع غ',
            'الطفل يعرف الحروف: ف ق ك ل',
            'الطفل يعرف الحروف: م ن ه',
            'الطفل يعرف الحروف: و ي',
            'الطفل يعرف الأرقام  ١_٣',
            'الطفل يعرف الأرقام ٣_٦',
            'الطفل يعرف الأرقام ٣_٦',
            'الطفل يعرف الأرقام ٦_٩',
            'الطفل يعرف الألوان',
            'الطفل يعرف أعضاء الوجه',
            'الطفل يعرف أعضاء الجسم',
            'الطفل يعرف المفاهيم الرياضية',
            'الطفل يعرف الفصول',
        ];

        foreach ($questions as $question) {
            Question::create([
                'question' => $question
            ]);
        }
    }
}
