<?php
use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations = [
            ['en'=> 'Arabic', 'ar'=> 'لغة عربية'],
            ['en'=> 'English', 'ar'=> 'لغة انجليزي'],
            ['en'=> 'French', 'ar'=> 'لغة فرنسية'],
            ['en'=> 'Sciences', 'ar'=> 'علوم'],
            ['en'=> 'Computer', 'ar'=> 'حاسب الي'],
            ['en'=> 'Mathematics', 'ar'=> 'رياضيات'],
            ['en'=> 'Activities', 'ar'=> 'انشطة'],
            ['en'=> 'Physics', 'ar'=> 'فيزياء'],
            ['en'=> 'Chemistry', 'ar'=> 'كيمياء'],
            ['en'=> 'Biology', 'ar'=> 'احياء'],
            ['en'=> 'Social Studies', 'ar'=> 'دراسات اجتماعية'],
            ['en'=> 'History', 'ar'=> 'تاريخ'],
            ['en'=> 'Geography', 'ar'=> 'جغرافيا'],
            ['en'=> 'Philosophy', 'ar'=> 'فلسفة'],
            ['en'=> 'Islam Religion', 'ar'=> 'الدين الإسلامى'],
            ['en'=> 'Christianity Religion', 'ar'=> 'الدين المسيحى'],
            ['en'=> 'Painting', 'ar'=> 'رسم'],
            ['en'=> 'Music', 'ar'=> 'موسيقى'],
        ];
        foreach ($specializations as $S) {
            Specialization::create(['Name' => $S]);
        }
    }
}
