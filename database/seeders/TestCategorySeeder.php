<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TestCategory;
use App\Models\ExamType;
use App\Models\ExamSubject;
use App\Models\ExamQuestion;
use App\Models\ExamAnswer;

class TestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'AKPOL',
            ],
            [
                'name' => 'BINTARA',
            ],
            [
                'name' => 'TAMTAMA'
            ]
        ];

        $testTypes = [
            // AKPOL (id: 1)
            [
                'test_category_id' => 1,
                'section' => 'AKADEMIK',
                'name' => 'PRETEST',
                'status' => 'inactive',
                'token' => 'akpol_pretest_123'
            ],
            [
                'test_category_id' => 1,
                'section' => 'AKADEMIK',
                'name' => 'MIDTEST',
                'status' => 'inactive',
                'token' => 'akpol_midtest_123'
            ],
            [
                'test_category_id' => 1,
                'section' => 'AKADEMIK',
                'name' => 'POSTTEST',
                'status' => 'inactive',
                'token' => 'akpol_posttest_123'
            ],
            [
                'test_category_id' => 1,
                'section' => 'AKADEMIK',
                'name' => 'TRYOUT',
                'status' => 'inactive',
                'token' => 'akpol_tryout_123'
            ],
            // BINTARA (id: 2)
            [
                'test_category_id' => 2,
                'section' => 'AKADEMIK',
                'name' => 'PRETEST',
                'status' => 'inactive',
                'token' => 'bintara_pretest_123'
            ],
            [
                'test_category_id' => 2,
                'section' => 'AKADEMIK',
                'name' => 'MIDTEST',
                'status' => 'inactive',
                'token' => 'bintara_midtest_123'
            ],
            [
                'test_category_id' => 2,
                'section' => 'AKADEMIK',
                'name' => 'POSTTEST',
                'status' => 'inactive',
                'token' => 'bintara_posttest_123'
            ],
            [
                'test_category_id' => 2,
                'section' => 'AKADEMIK',
                'name' => 'TRYOUT',
                'status' => 'inactive',
                'token' => 'bintara_tryout_123'
            ],
            // TAMTAMA (id: 3)
            [
                'test_category_id' => 3,
                'section' => 'AKADEMIK',
                'name' => 'PRETEST',
                'status' => 'inactive',
                'token' => 'tamtama_pretest_123'
            ],
            [
                'test_category_id' => 3,
                'section' => 'AKADEMIK',
                'name' => 'MIDTEST',
                'status' => 'inactive',
                'token' => 'tamtama_midtest_123'
            ],
            [
                'test_category_id' => 3,
                'section' => 'AKADEMIK',
                'name' => 'POSTTEST',
                'status' => 'inactive',
                'token' => 'tamtama_posttest_123'
            ],
            [
                'test_category_id' => 3,
                'section' => 'AKADEMIK',
                'name' => 'TRYOUT',
                'status' => 'inactive',
                'token' => 'tamtama_tryout_123'
            ],
            // KECERMATAN Section - AKPOL (id: 13-16)
            [
                'test_category_id' => 1,
                'section' => 'KECERMATAN',
                'name' => 'PRETEST',
                'status' => 'inactive',
                'token' => 'akpol_kecermatan_pretest_123'
            ],
            [
                'test_category_id' => 1,
                'section' => 'KECERMATAN',
                'name' => 'MIDTEST',
                'status' => 'inactive',
                'token' => 'akpol_kecermatan_midtest_123'
            ],
            [
                'test_category_id' => 1,
                'section' => 'KECERMATAN',
                'name' => 'POSTTEST',
                'status' => 'inactive',
                'token' => 'akpol_kecermatan_posttest_123'
            ],
            [
                'test_category_id' => 1,
                'section' => 'KECERMATAN',
                'name' => 'TRYOUT',
                'status' => 'inactive',
                'token' => 'akpol_kecermatan_tryout_123'
            ],
            // KECERMATAN Section - BINTARA (id: 17-20)
            [
                'test_category_id' => 2,
                'section' => 'KECERMATAN',
                'name' => 'PRETEST',
                'status' => 'inactive',
                'token' => 'bintara_kecermatan_pretest_123'
            ],
            [
                'test_category_id' => 2,
                'section' => 'KECERMATAN',
                'name' => 'MIDTEST',
                'status' => 'inactive',
                'token' => 'bintara_kecermatan_midtest_123'
            ],
            [
                'test_category_id' => 2,
                'section' => 'KECERMATAN',
                'name' => 'POSTTEST',
                'status' => 'inactive',
                'token' => 'bintara_kecermatan_posttest_123'
            ],
            [
                'test_category_id' => 2,
                'section' => 'KECERMATAN',
                'name' => 'TRYOUT',
                'status' => 'inactive',
                'token' => 'bintara_kecermatan_tryout_123'
            ],
            // KECERMATAN Section - TAMTAMA (id: 21-24)
            [
                'test_category_id' => 3,
                'section' => 'KECERMATAN',
                'name' => 'PRETEST',
                'status' => 'inactive',
                'token' => 'tamtama_kecermatan_pretest_123'
            ],
            [
                'test_category_id' => 3,
                'section' => 'KECERMATAN',
                'name' => 'MIDTEST',
                'status' => 'inactive',
                'token' => 'tamtama_kecermatan_midtest_123'
            ],
            [
                'test_category_id' => 3,
                'section' => 'KECERMATAN',
                'name' => 'POSTTEST',
                'status' => 'inactive',
                'token' => 'tamtama_kecermatan_posttest_123'
            ],
            [
                'test_category_id' => 3,
                'section' => 'KECERMATAN',
                'name' => 'TRYOUT',
                'status' => 'inactive',
                'token' => 'tamtama_kecermatan_tryout_123'
            ]
        ];

        $examSubjects = [
            // AKPOL Test Types (id: 1-4)
            ['exam_type_id' => 1, 'name' => 'B.IND'],
            ['exam_type_id' => 1, 'name' => 'PN'],
            ['exam_type_id' => 1, 'name' => 'BING'],
            ['exam_type_id' => 1, 'name' => 'PU'],
            ['exam_type_id' => 1, 'name' => 'TWK'],

            ['exam_type_id' => 2, 'name' => 'B.IND'],
            ['exam_type_id' => 2, 'name' => 'PN'],
            ['exam_type_id' => 2, 'name' => 'BING'],
            ['exam_type_id' => 2, 'name' => 'PU'],
            ['exam_type_id' => 2, 'name' => 'TWK'],

            ['exam_type_id' => 3, 'name' => 'B.IND'],
            ['exam_type_id' => 3, 'name' => 'PN'],
            ['exam_type_id' => 3, 'name' => 'BING'],
            ['exam_type_id' => 3, 'name' => 'PU'],
            ['exam_type_id' => 3, 'name' => 'TWK'],

            ['exam_type_id' => 4, 'name' => 'B.IND'],
            ['exam_type_id' => 4, 'name' => 'PN'],
            ['exam_type_id' => 4, 'name' => 'BING'],
            ['exam_type_id' => 4, 'name' => 'PU'],
            ['exam_type_id' => 4, 'name' => 'TWK'],

            // BINTARA Test Types (id: 5-8)
            ['exam_type_id' => 5, 'name' => 'B.IND'],
            ['exam_type_id' => 5, 'name' => 'PN'],
            ['exam_type_id' => 5, 'name' => 'BING'],
            ['exam_type_id' => 5, 'name' => 'PU'],
            ['exam_type_id' => 5, 'name' => 'TWK'],

            ['exam_type_id' => 6, 'name' => 'B.IND'],
            ['exam_type_id' => 6, 'name' => 'PN'],
            ['exam_type_id' => 6, 'name' => 'BING'],
            ['exam_type_id' => 6, 'name' => 'PU'],
            ['exam_type_id' => 6, 'name' => 'TWK'],

            ['exam_type_id' => 7, 'name' => 'B.IND'],
            ['exam_type_id' => 7, 'name' => 'PN'],
            ['exam_type_id' => 7, 'name' => 'BING'],
            ['exam_type_id' => 7, 'name' => 'PU'],
            ['exam_type_id' => 7, 'name' => 'TWK'],

            ['exam_type_id' => 8, 'name' => 'B.IND'],
            ['exam_type_id' => 8, 'name' => 'PN'],
            ['exam_type_id' => 8, 'name' => 'BING'],
            ['exam_type_id' => 8, 'name' => 'PU'],
            ['exam_type_id' => 8, 'name' => 'TWK'],

            // TAMTAMA Test Types (id: 9-12)
            ['exam_type_id' => 9, 'name' => 'B.IND'],
            ['exam_type_id' => 9, 'name' => 'PN'],
            ['exam_type_id' => 9, 'name' => 'BING'],
            ['exam_type_id' => 9, 'name' => 'PU'],
            ['exam_type_id' => 9, 'name' => 'TWK'],

            ['exam_type_id' => 10, 'name' => 'B.IND'],
            ['exam_type_id' => 10, 'name' => 'PN'],
            ['exam_type_id' => 10, 'name' => 'BING'],
            ['exam_type_id' => 10, 'name' => 'PU'],
            ['exam_type_id' => 10, 'name' => 'TWK'],

            ['exam_type_id' => 11, 'name' => 'B.IND'],
            ['exam_type_id' => 11, 'name' => 'PN'],
            ['exam_type_id' => 11, 'name' => 'BING'],
            ['exam_type_id' => 11, 'name' => 'PU'],
            ['exam_type_id' => 11, 'name' => 'TWK'],

            ['exam_type_id' => 12, 'name' => 'B.IND'],
            ['exam_type_id' => 12, 'name' => 'PN'],
            ['exam_type_id' => 12, 'name' => 'BING'],
            ['exam_type_id' => 12, 'name' => 'PU'],
            ['exam_type_id' => 12, 'name' => 'TWK'],

            // KECERMATAN Section - AKPOL (id: 13-16)
            ['exam_type_id' => 13, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 14, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 15, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 16, 'name' => 'KECERMATAN'],

            // KECERMATAN Section - BINTARA (id: 17-20)
            ['exam_type_id' => 17, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 18, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 19, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 20, 'name' => 'KECERMATAN'],

            // KECERMATAN Section - TAMTAMA (id: 21-24)
            ['exam_type_id' => 21, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 22, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 23, 'name' => 'KECERMATAN'],
            ['exam_type_id' => 24, 'name' => 'KECERMATAN']
        ];

        $examQuestions = [
            // B.IND - exam_subject_id 1 (5 questions)
            [
                'exam_subject_id' => 1,
                'question' => 'Kata yang memiliki makna sama dengan "komprehensif" adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 1,
                'question' => 'Antonim dari kata "optimis" adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 1,
                'question' => 'Kalimat yang menggunakan ejaan yang benar adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 1,
                'question' => 'Kata baku dari "praktek" adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 1,
                'question' => 'Imbuhan yang tepat untuk melengkapi kata "...didik" adalah...',
                'image' => null
            ],

            // PN - exam_subject_id 2 (5 questions)
            [
                'exam_subject_id' => 2,
                'question' => 'Jika semua A adalah B, dan semua B adalah C, maka...',
                'image' => null
            ],
            [
                'exam_subject_id' => 2,
                'question' => 'Deret angka: 2, 4, 8, 16, ... Angka selanjutnya adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 2,
                'question' => 'Jika hari ini Senin, 100 hari lagi adalah hari...',
                'image' => null
            ],
            [
                'exam_subject_id' => 2,
                'question' => 'BUKU : HALAMAN = RUMAH : ...',
                'image' => null
            ],
            [
                'exam_subject_id' => 2,
                'question' => 'Jika A > B dan B > C, maka...',
                'image' => null
            ],

            // BING - exam_subject_id 3 (5 questions)
            [
                'exam_subject_id' => 3,
                'question' => 'Choose the correct sentence:',
                'image' => null
            ],
            [
                'exam_subject_id' => 3,
                'question' => 'The synonym of "difficult" is...',
                'image' => null
            ],
            [
                'exam_subject_id' => 3,
                'question' => 'I ... to Bali last month.',
                'image' => null
            ],
            [
                'exam_subject_id' => 3,
                'question' => 'She is ... student in the class.',
                'image' => null
            ],
            [
                'exam_subject_id' => 3,
                'question' => 'They ... football when it started to rain.',
                'image' => null
            ],

            // PU - exam_subject_id 4 (5 questions)
            [
                'exam_subject_id' => 4,
                'question' => 'Berapa hasil dari 25 x 16?',
                'image' => null
            ],
            [
                'exam_subject_id' => 4,
                'question' => 'Ibukota negara Jepang adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 4,
                'question' => '30% dari 200 adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 4,
                'question' => 'Berapa jumlah provinsi di Indonesia saat ini?',
                'image' => null
            ],
            [
                'exam_subject_id' => 4,
                'question' => 'Planet terdekat dengan matahari adalah...',
                'image' => null
            ],

            // TWK - exam_subject_id 5 (5 questions)
            [
                'exam_subject_id' => 5,
                'question' => 'Pancasila sebagai dasar negara Indonesia ditetapkan pada tanggal...',
                'image' => null
            ],
            [
                'exam_subject_id' => 5,
                'question' => 'Proklamasi kemerdekaan Indonesia dibacakan oleh...',
                'image' => null
            ],
            [
                'exam_subject_id' => 5,
                'question' => 'Sila pertama Pancasila adalah...',
                'image' => null
            ],
            [
                'exam_subject_id' => 5,
                'question' => 'UUD 1945 disahkan pada tanggal...',
                'image' => null
            ],
            [
                'exam_subject_id' => 5,
                'question' => 'Lambang negara Indonesia adalah...',
                'image' => null
            ]
        ];

        $examAnswers = [
            // Question 1 (B.IND) - 4 answers
            ['exam_question_id' => 1, 'answer' => 'Menyeluruh', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 1, 'answer' => 'Sederhana', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 1, 'answer' => 'Terbatas', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 1, 'answer' => 'Parsial', 'is_correct' => false, 'image' => null],

            // Question 2 (B.IND) - 4 answers
            ['exam_question_id' => 2, 'answer' => 'Pesimis', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 2, 'answer' => 'Senang', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 2, 'answer' => 'Gembira', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 2, 'answer' => 'Bahagia', 'is_correct' => false, 'image' => null],

            // Question 3 (B.IND) - 4 answers
            ['exam_question_id' => 3, 'answer' => 'Di mana kamu tinggal?', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 3, 'answer' => 'Dimana kamu tinggal?', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 3, 'answer' => 'Di mana kamu tinggal.', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 3, 'answer' => 'Dimana kamu tinggal.', 'is_correct' => false, 'image' => null],

            // Question 4 (B.IND) - 4 answers
            ['exam_question_id' => 4, 'answer' => 'Praktik', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 4, 'answer' => 'Praktek', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 4, 'answer' => 'Praktiek', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 4, 'answer' => 'Praktis', 'is_correct' => false, 'image' => null],

            // Question 5 (B.IND) - 4 answers
            ['exam_question_id' => 5, 'answer' => 'pen-', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 5, 'answer' => 'per-', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 5, 'answer' => 'di-', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 5, 'answer' => 'ter-', 'is_correct' => false, 'image' => null],

            // Question 6 (PN) - 4 answers
            ['exam_question_id' => 6, 'answer' => 'Semua A adalah C', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 6, 'answer' => 'Semua C adalah A', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 6, 'answer' => 'Tidak ada A yang C', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 6, 'answer' => 'Tidak dapat disimpulkan', 'is_correct' => false, 'image' => null],

            // Question 7 (PN) - 4 answers
            ['exam_question_id' => 7, 'answer' => '32', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 7, 'answer' => '24', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 7, 'answer' => '28', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 7, 'answer' => '20', 'is_correct' => false, 'image' => null],

            // Question 8 (PN) - 4 answers
            ['exam_question_id' => 8, 'answer' => 'Rabu', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 8, 'answer' => 'Selasa', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 8, 'answer' => 'Kamis', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 8, 'answer' => 'Jumat', 'is_correct' => false, 'image' => null],

            // Question 9 (PN) - 4 answers
            ['exam_question_id' => 9, 'answer' => 'Kamar', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 9, 'answer' => 'Atap', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 9, 'answer' => 'Pintu', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 9, 'answer' => 'Jendela', 'is_correct' => false, 'image' => null],

            // Question 10 (PN) - 4 answers
            ['exam_question_id' => 10, 'answer' => 'A > C', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 10, 'answer' => 'C > A', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 10, 'answer' => 'A = C', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 10, 'answer' => 'Tidak dapat disimpulkan', 'is_correct' => false, 'image' => null],

            // Question 11 (BING) - 4 answers
            ['exam_question_id' => 11, 'answer' => 'She has been working here since 2020', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 11, 'answer' => 'She have been working here since 2020', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 11, 'answer' => 'She has been work here since 2020', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 11, 'answer' => 'She has working here since 2020', 'is_correct' => false, 'image' => null],

            // Question 12 (BING) - 4 answers
            ['exam_question_id' => 12, 'answer' => 'Hard', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 12, 'answer' => 'Easy', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 12, 'answer' => 'Simple', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 12, 'answer' => 'Happy', 'is_correct' => false, 'image' => null],

            // Question 13 (BING) - 4 answers
            ['exam_question_id' => 13, 'answer' => 'went', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 13, 'answer' => 'go', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 13, 'answer' => 'going', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 13, 'answer' => 'gone', 'is_correct' => false, 'image' => null],

            // Question 14 (BING) - 4 answers
            ['exam_question_id' => 14, 'answer' => 'the smartest', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 14, 'answer' => 'smarter', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 14, 'answer' => 'smart', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 14, 'answer' => 'more smart', 'is_correct' => false, 'image' => null],

            // Question 15 (BING) - 4 answers
            ['exam_question_id' => 15, 'answer' => 'were playing', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 15, 'answer' => 'played', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 15, 'answer' => 'playing', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 15, 'answer' => 'play', 'is_correct' => false, 'image' => null],

            // Question 16 (PU) - 4 answers
            ['exam_question_id' => 16, 'answer' => '400', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 16, 'answer' => '350', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 16, 'answer' => '450', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 16, 'answer' => '500', 'is_correct' => false, 'image' => null],

            // Question 17 (PU) - 4 answers
            ['exam_question_id' => 17, 'answer' => 'Tokyo', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 17, 'answer' => 'Osaka', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 17, 'answer' => 'Kyoto', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 17, 'answer' => 'Hiroshima', 'is_correct' => false, 'image' => null],

            // Question 18 (PU) - 4 answers
            ['exam_question_id' => 18, 'answer' => '60', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 18, 'answer' => '50', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 18, 'answer' => '70', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 18, 'answer' => '80', 'is_correct' => false, 'image' => null],

            // Question 19 (PU) - 4 answers
            ['exam_question_id' => 19, 'answer' => '38', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 19, 'answer' => '34', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 19, 'answer' => '36', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 19, 'answer' => '37', 'is_correct' => false, 'image' => null],

            // Question 20 (PU) - 4 answers
            ['exam_question_id' => 20, 'answer' => 'Merkurius', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 20, 'answer' => 'Venus', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 20, 'answer' => 'Mars', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 20, 'answer' => 'Bumi', 'is_correct' => false, 'image' => null],

            // Question 21 (TWK) - 4 answers
            ['exam_question_id' => 21, 'answer' => '18 Agustus 1945', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 21, 'answer' => '17 Agustus 1945', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 21, 'answer' => '1 Juni 1945', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 21, 'answer' => '22 Juni 1945', 'is_correct' => false, 'image' => null],

            // Question 22 (TWK) - 4 answers
            ['exam_question_id' => 22, 'answer' => 'Ir. Soekarno', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 22, 'answer' => 'Moh. Hatta', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 22, 'answer' => 'Soekarno-Hatta', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 22, 'answer' => 'Soeharto', 'is_correct' => false, 'image' => null],

            // Question 23 (TWK) - 4 answers
            ['exam_question_id' => 23, 'answer' => 'Ketuhanan Yang Maha Esa', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 23, 'answer' => 'Kemanusiaan yang Adil dan Beradab', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 23, 'answer' => 'Persatuan Indonesia', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 23, 'answer' => 'Kerakyatan', 'is_correct' => false, 'image' => null],

            // Question 24 (TWK) - 4 answers
            ['exam_question_id' => 24, 'answer' => '18 Agustus 1945', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 24, 'answer' => '17 Agustus 1945', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 24, 'answer' => '5 Juli 1945', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 24, 'answer' => '1 Juni 1945', 'is_correct' => false, 'image' => null],

            // Question 25 (TWK) - 4 answers
            ['exam_question_id' => 25, 'answer' => 'Garuda Pancasila', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 25, 'answer' => 'Elang Pancasila', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 25, 'answer' => 'Burung Garuda', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 25, 'answer' => 'Rajawali', 'is_correct' => false, 'image' => null]
        ];

        // KECERMATAN Questions - exam_subject_id 61 (KECERMATAN1 - AKPOL PRETEST)
        $kecermatanQuestions = [
            // KECERMATAN1 - 10 questions (exam_subject_id 61)
            ['exam_subject_id' => 61, 'question' => 'kolom 1', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 2', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 3', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 4', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 5', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 6', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 7', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 8', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 9', 'image' => null],
            ['exam_subject_id' => 61, 'question' => 'kolom 10', 'image' => null],

            // KECERMATAN2 - 10 questions (exam_subject_id 62)
            ['exam_subject_id' => 62, 'question' => 'kolom 1', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 2', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 3', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 4', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 5', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 6', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 7', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 8', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 9', 'image' => null],
            ['exam_subject_id' => 62, 'question' => 'kolom 10', 'image' => null],

            // KECERMATAN3 - 10 questions (exam_subject_id 63)
            ['exam_subject_id' => 63, 'question' => 'kolom 1', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 2', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 3', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 4', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 5', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 6', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 7', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 8', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 9', 'image' => null],
            ['exam_subject_id' => 63, 'question' => 'kolom 10', 'image' => null],
        ];

        // KECERMATAN Answers - Pola A B C D E (5 jawaban per soal)
        // Question 26-35 (KECERMATAN1 - exam_subject_id 61)
        $kecermatanAnswers = [
            // Question 26 (kolom 1) - Pola: A B C D E
            ['exam_question_id' => 26, 'answer' => 'A', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 26, 'answer' => 'B', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 26, 'answer' => 'C', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 26, 'answer' => 'D', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 26, 'answer' => 'E', 'is_correct' => false, 'image' => null],

            // Question 27 (kolom 2) - Pola: X Y Z W V
            ['exam_question_id' => 27, 'answer' => 'X', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 27, 'answer' => 'Y', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 27, 'answer' => 'Z', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 27, 'answer' => 'W', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 27, 'answer' => 'V', 'is_correct' => false, 'image' => null],

            // Question 28 (kolom 3) - Pola: 1 2 3 4 5
            ['exam_question_id' => 28, 'answer' => '1', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 28, 'answer' => '2', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 28, 'answer' => '3', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 28, 'answer' => '4', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 28, 'answer' => '5', 'is_correct' => false, 'image' => null],

            // Question 29 (kolom 4) - Pola: P Q R S T
            ['exam_question_id' => 29, 'answer' => 'P', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 29, 'answer' => 'Q', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 29, 'answer' => 'R', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 29, 'answer' => 'S', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 29, 'answer' => 'T', 'is_correct' => false, 'image' => null],

            // Question 30 (kolom 5) - Pola: 10 20 30 40 50
            ['exam_question_id' => 30, 'answer' => '10', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 30, 'answer' => '20', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 30, 'answer' => '30', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 30, 'answer' => '40', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 30, 'answer' => '50', 'is_correct' => true, 'image' => null],

            // Question 31 (kolom 6) - Pola: M N O P Q
            ['exam_question_id' => 31, 'answer' => 'M', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 31, 'answer' => 'N', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 31, 'answer' => 'O', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 31, 'answer' => 'P', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 31, 'answer' => 'Q', 'is_correct' => false, 'image' => null],

            // Question 32 (kolom 7) - Pola: 5 10 15 20 25
            ['exam_question_id' => 32, 'answer' => '5', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 32, 'answer' => '10', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 32, 'answer' => '15', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 32, 'answer' => '20', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 32, 'answer' => '25', 'is_correct' => false, 'image' => null],

            // Question 33 (kolom 8) - Pola: F G H I J
            ['exam_question_id' => 33, 'answer' => 'F', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 33, 'answer' => 'G', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 33, 'answer' => 'H', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 33, 'answer' => 'I', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 33, 'answer' => 'J', 'is_correct' => true, 'image' => null],

            // Question 34 (kolom 9) - Pola: 2 4 6 8 10
            ['exam_question_id' => 34, 'answer' => '2', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 34, 'answer' => '4', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 34, 'answer' => '6', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 34, 'answer' => '8', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 34, 'answer' => '10', 'is_correct' => false, 'image' => null],

            // Question 35 (kolom 10) - Pola: K L M N O
            ['exam_question_id' => 35, 'answer' => 'K', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 35, 'answer' => 'L', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 35, 'answer' => 'M', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 35, 'answer' => 'N', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 35, 'answer' => 'O', 'is_correct' => false, 'image' => null],

            // Question 36-45 (KECERMATAN2 - exam_subject_id 62)
            // Question 36 (kolom 1)
            ['exam_question_id' => 36, 'answer' => '◯', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 36, 'answer' => '△', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 36, 'answer' => '□', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 36, 'answer' => '◇', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 36, 'answer' => '☆', 'is_correct' => false, 'image' => null],

            // Question 37 (kolom 2)
            ['exam_question_id' => 37, 'answer' => '100', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 37, 'answer' => '200', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 37, 'answer' => '300', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 37, 'answer' => '400', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 37, 'answer' => '500', 'is_correct' => false, 'image' => null],

            // Question 38 (kolom 3)
            ['exam_question_id' => 38, 'answer' => 'α', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 38, 'answer' => 'β', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 38, 'answer' => 'γ', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 38, 'answer' => 'δ', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 38, 'answer' => 'ε', 'is_correct' => false, 'image' => null],

            // Question 39 (kolom 4)
            ['exam_question_id' => 39, 'answer' => '11', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 39, 'answer' => '22', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 39, 'answer' => '33', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 39, 'answer' => '44', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 39, 'answer' => '55', 'is_correct' => true, 'image' => null],

            // Question 40 (kolom 5)
            ['exam_question_id' => 40, 'answer' => 'AA', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 40, 'answer' => 'BB', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 40, 'answer' => 'CC', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 40, 'answer' => 'DD', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 40, 'answer' => 'EE', 'is_correct' => false, 'image' => null],

            // Question 41 (kolom 6)
            ['exam_question_id' => 41, 'answer' => '3', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 41, 'answer' => '6', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 41, 'answer' => '9', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 41, 'answer' => '12', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 41, 'answer' => '15', 'is_correct' => false, 'image' => null],

            // Question 42 (kolom 7)
            ['exam_question_id' => 42, 'answer' => 'U', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 42, 'answer' => 'V', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 42, 'answer' => 'W', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 42, 'answer' => 'X', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 42, 'answer' => 'Y', 'is_correct' => false, 'image' => null],

            // Question 43 (kolom 8)
            ['exam_question_id' => 43, 'answer' => '7', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 43, 'answer' => '14', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 43, 'answer' => '21', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 43, 'answer' => '28', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 43, 'answer' => '35', 'is_correct' => true, 'image' => null],

            // Question 44 (kolom 9)
            ['exam_question_id' => 44, 'answer' => 'I', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 44, 'answer' => 'II', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 44, 'answer' => 'III', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 44, 'answer' => 'IV', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 44, 'answer' => 'V', 'is_correct' => false, 'image' => null],

            // Question 45 (kolom 10)
            ['exam_question_id' => 45, 'answer' => '1A', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 45, 'answer' => '2B', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 45, 'answer' => '3C', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 45, 'answer' => '4D', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 45, 'answer' => '5E', 'is_correct' => false, 'image' => null],

            // Question 46-55 (KECERMATAN3 - exam_subject_id 63)
            // Question 46 (kolom 1)
            ['exam_question_id' => 46, 'answer' => 'AB', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 46, 'answer' => 'CD', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 46, 'answer' => 'EF', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 46, 'answer' => 'GH', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 46, 'answer' => 'IJ', 'is_correct' => false, 'image' => null],

            // Question 47 (kolom 2)
            ['exam_question_id' => 47, 'answer' => '12', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 47, 'answer' => '24', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 47, 'answer' => '36', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 47, 'answer' => '48', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 47, 'answer' => '60', 'is_correct' => false, 'image' => null],

            // Question 48 (kolom 3)
            ['exam_question_id' => 48, 'answer' => 'QR', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 48, 'answer' => 'ST', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 48, 'answer' => 'UV', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 48, 'answer' => 'WX', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 48, 'answer' => 'YZ', 'is_correct' => true, 'image' => null],

            // Question 49 (kolom 4)
            ['exam_question_id' => 49, 'answer' => '50', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 49, 'answer' => '75', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 49, 'answer' => '100', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 49, 'answer' => '125', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 49, 'answer' => '150', 'is_correct' => false, 'image' => null],

            // Question 50 (kolom 5)
            ['exam_question_id' => 50, 'answer' => 'A1', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 50, 'answer' => 'B2', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 50, 'answer' => 'C3', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 50, 'answer' => 'D4', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 50, 'answer' => 'E5', 'is_correct' => false, 'image' => null],

            // Question 51 (kolom 6)
            ['exam_question_id' => 51, 'answer' => '●', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 51, 'answer' => '■', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 51, 'answer' => '▲', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 51, 'answer' => '◆', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 51, 'answer' => '★', 'is_correct' => false, 'image' => null],

            // Question 52 (kolom 7)
            ['exam_question_id' => 52, 'answer' => '8', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 52, 'answer' => '16', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 52, 'answer' => '24', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 52, 'answer' => '32', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 52, 'answer' => '40', 'is_correct' => false, 'image' => null],

            // Question 53 (kolom 8)
            ['exam_question_id' => 53, 'answer' => 'MN', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 53, 'answer' => 'OP', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 53, 'answer' => 'QR', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 53, 'answer' => 'ST', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 53, 'answer' => 'UV', 'is_correct' => false, 'image' => null],

            // Question 54 (kolom 9)
            ['exam_question_id' => 54, 'answer' => '99', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 54, 'answer' => '88', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 54, 'answer' => '77', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 54, 'answer' => '66', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 54, 'answer' => '55', 'is_correct' => true, 'image' => null],

            // Question 55 (kolom 10)
            ['exam_question_id' => 55, 'answer' => 'ABC', 'is_correct' => true, 'image' => null],
            ['exam_question_id' => 55, 'answer' => 'DEF', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 55, 'answer' => 'GHI', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 55, 'answer' => 'JKL', 'is_correct' => false, 'image' => null],
            ['exam_question_id' => 55, 'answer' => 'MNO', 'is_correct' => false, 'image' => null],
        ];

        // Merge arrays
        $examQuestions = array_merge($examQuestions, $kecermatanQuestions);
        $examAnswers = array_merge($examAnswers, $kecermatanAnswers);


        foreach ($categories as $category) {
            TestCategory::create($category);
        }

        foreach ($testTypes as $testType) {
            ExamType::create($testType);
        }

        foreach ($examSubjects as $examSubject) {
            ExamSubject::create($examSubject);
        }

        foreach ($examQuestions as $examQuestion) {
            ExamQuestion::create($examQuestion);
        }

        foreach ($examAnswers as $examAnswer) {
            ExamAnswer::create($examAnswer);
        }
    }
}
